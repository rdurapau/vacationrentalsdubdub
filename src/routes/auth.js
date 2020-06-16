const { check, validationResult } = require('express-validator/check');
const { matchedData } = require('express-validator/filter');
const errorHandler = require('./../config/errorHandler');
const JWTCreator = require('./../config/JWTCreator');
const wrapper = require('./../config/wrapper');
const email = require('./../config/email');
const { User } = require('./../models');
const bcrypt = require('bcrypt-nodejs');
const { verify } = require('hcaptcha');
const Sequelize = require('sequelize');
const passport = require('passport');
const express = require('express');
const uuidv4 = require('uuid/v4');
const moment = require('moment');
const axios = require('axios');
const Op = Sequelize.Op;

var app = module.exports = express.Router();


/**
 * POST api/v1/auth/login
 * 
 * Login
 */
app.post('/auth/login', [
    check('email').exists(),
    check('password').exists(),
], (req, res) => {

    let errors = validationResult(req);
    if (!errors.isEmpty()) return res.status(422).json({ errors: errors.mapped() });

    passport.authenticate('local', { session: false }, (err, user) => {
        if (err) return errorHandler(err, res)
        if (!user) return res.status(401).json('Incorrect email or password');

        req.login(user, { session: false }, (err) => {
            if (err) return errorHandler(err, res)

            res.json(wrapper({
                access_token: JWTCreator(user, 'USER', [1, 'day'])
            }));

            User.update({
                last_login_at: moment(new Date()).format("YYYY-MM-DD HH:mm:ss"),
            }, {
                where: {
                    id: user.id
                }
            }).catch(err => errorHandler(err));
        });
    })(req, res);
});


/**
 * POST api/v1/auth/sign-up
 * 
 */
app.post('/auth/sign-up', [
    check('email', 'You must provide your email address').exists({ checkFalsy: true }).isEmail(),
    check('password', 'Your password must be atleast 7 characters long').isLength({ min: 7 }),
    check('email', 'This email address is taken').custom(async function (email) {
        var user = await User.findAll({
            where: { email },
            limit: 1,
        });
        return (user.length === 0);
    }),
    check('first_name', 'You must provide your first name').exists({ checkFalsy: true }),
    check('last_name'),
    check('tos', 'You must accept the VRWW Terms of Service to use this platform').exists({ checkFalsy: true }),
], (req, res) => {

    let errors = validationResult(req);
    if (!errors.isEmpty()) return res.status(422).json({ errors: errors.mapped() });
    var data = matchedData(req);

    var ucFirst = (string) => string.charAt(0).toUpperCase() + string.slice(1);
    if (!data.last_name) data.last_name = '';
    if (!data.group_name) data.group_name = data.first_name.concat("'s Team");
    if (data.city) data.city = data.city.toLowerCase();

    verify(process.env.H_CAPTCHA_SECRET, data.h_token)
        .then(() => User.create({
            id: uuidv4(),
            email: data.email,
            password: bcrypt.hashSync(data.password, bcrypt.genSaltSync(10)),
            type: 'user',
            first_name: ucFirst(data.first_name),
            last_name: ucFirst(data.last_name),
            tos: data.tos,
            validation_key: Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15),
            last_login_at: moment().format("YYYY-MM-DD HH:mm:ss"),
        }))
        .then(() => passport.authenticate('local', { session: false }, (err, user) => {
            if (err) return errorHandler(err, res)
            if (!user) return res.status(401).json('Error 04537');

            if (user) req.login(user, { session: false }, err => {
                if (err) return errorHandler(err, res);

                res.json(wrapper({
                    access_token: JWTCreator(user, 'USER', [1, 'day'])
                }));

                mailgun.messages().send({
                    from: 'VRWW <app@vrww.app>',
                    to: data.email,
                    subject: 'Please validate your email',
                    html: email.header() +
                        email.template('welcome.html', {
                            email_validation_link: process.env.APP_URL + '/api/v1/auth/validate/' + user.validation_key
                        }) + email.footer()
                });

                if (process.env.APP_ENV === 'production') {
                    axios.post('https://hooks.slack.com/services/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', {
                        text: ([
                            `New User *${user.first_name} ${user.last_name}*`,
                            `ID: ${user.id} `,
                            `Email: ${user.email}`,
                            `https://vrww.app/adomin/users/${user.id}`
                        ]).join("\n")
                    }).catch(err => errorHandler(err))
                }
            });
        })(req, res))
        .catch(err => errorHandler(err, res));
});


/**
 * POST api/v1/auth/forgot
 * 
 * Forgot Password
 */
app.post('/auth/forgot', [
    check('email', 'You must provide a valid email address').isEmail(),
    check('email', 'This email address does not exist').custom(async function (email) {
        var user = await User.findAll({
            where: { email: email },
            limit: 1,
        });
        return (user.length === 1);
    })
], (req, res) => {

    let errors = validationResult(req);
    if (!errors.isEmpty()) return res.status(422).json({ errors: errors.mapped() });
    var data = matchedData(req);
    var passportResetKey = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

    User.update({
        password_reset_key: passportResetKey
    }, {
        where: {
            email: data.email
        }
    }).then(user => {
        res.send(wrapper({ success: 'true' }));

        mailgun.messages().send({
            from: 'VRWW <app@VRWW.app>',
            to: data.email,
            subject: 'Reset Password',
            html: email.header() +
                email.template('reset-password.html', {
                    password_reset_link: (process.env.FRONTEND_URL + '/reset/' + passportResetKey)
                }) + email.footer(),
        }, (err, body) => {
            if (err) errorHandler(err, res)
        });
    }).catch(err => errorHandler(err, res));
});


/**
 * POST api/v1/auth/reset
 * 
 * Update User's Password
 */
app.post('/auth/reset', [
    check('email', 'You must provide a valid email address').isEmail(),
    check('email', 'This email address does not exist').custom(async function (email) {
        var user = await User.findAll({
            where: { email: email },
            limit: 1,
        });
        return (user.length === 1);
    }),
    check('password').exists(),
    check('password', 'Your password must be atleast 7 characters long').isLength({ min: 7 }),
    check('password_reset_key', 'This link has expired.').custom(async function (password_reset_key) {
        var user = await User.findAll({
            where: { password_reset_key: password_reset_key },
            limit: 1,
        });
        return (user.length === 1);
    })
], (req, res) => {

    let errors = validationResult(req);
    if (!errors.isEmpty()) return res.status(422).json({ errors: errors.mapped() });
    var data = matchedData(req);

    User.update({
        password: bcrypt.hashSync(data.password, bcrypt.genSaltSync(10)),
        password_reset_key: null
    }, {
        where: {
            email: data.email,
            password_reset_key: data.password_reset_key
        }
    }).then(user => {
        passport.authenticate('local', { session: false }, (err, user, info) => {
            if (err) return errorHandler(err, res)
            if (!user) return res.status(401).json('Error 04539');

            if (user) req.login(user, { session: false }, (err) => {
                if (err) return errorHandler(err, res);

                res.json(wrapper({
                    access_token: JWTCreator(user, 'USER', [1, 'day'])
                }));
            });
        })(req, res);
    }).catch(err => errorHandler(err, res));
});