const { check, validationResult } = require('express-validator/check');
const { matchedData } = require('express-validator/filter');
const { User } = require('./../models');
const errorHandler = require('./../config/errorHandler');
const swagger = require('swagger-spec-express');
const wrapper = require('./../config/wrapper');
const email = require('./../config/email');
const middleware = require('./middleware');
const bcrypt = require('bcrypt-nodejs');
const passport = require('passport');
const express = require('express');
const _ = require('lodash');

var app = module.exports = express.Router();
swagger.swaggerize(app);


/**
 * GET api/v1/user/config
 * 
 * Get config object for frontend
 */
app.get('/user/config', [
    passport.authenticate('jwt', { session: false })
], (req, res) => {
    User.scope('mfa').findByPk(req.user.id, {
        include: [Group, Permission],
    })
        .then(user => res.json(wrapper({ user: user.get({ plain: true }) })))
        .catch(err => errorHandler(err, res));
})


/**
 * GET /api/v1/user
 * 
 */
app.get('/user', passport.authenticate('jwt', { session: false }), (req, res) => {
    User.findByPk(req.user.id, {
        include: (req.query.with === 'groups') ? [{ model: Group }] : [],
    })
        .then(user => res.json(wrapper(user)))
        .catch(err => errorHandler(err, res));
})


/**
 * POST api/v1/user
 * 
 */
app.post('/user', [
    passport.authenticate('jwt', { session: false }),
    check('first_name'),
    check('last_name'),
], (req, res) => {

    let errors = validationResult(req);
    if (!errors.isEmpty()) return res.status(422).json({ errors: errors.mapped() });
    var data = matchedData(req);
    if (data.city) data.city = data.city.toLowerCase();

    User.update(data, { where: { id: req.user.id } })
        .then(() => User.findByPk(req.user.id))
        .then(user => res.json(wrapper(user)))
        .catch(err => errorHandler(err));

})


/**
 * GET api/v1/user/by-invite-key/:invite_key
 * 
 * NOT Documented
 */
app.get('/user/by-invite-key/:invite_key', (req, res) => {
    User.unscoped().findAll({
        where: { invite_key: req.params.invite_key },
        limit: 1,
    }).then(users => {
        var user = users[0];
        if (!user) return res.status(401).send("Error 847348: Bad invite key");

        res.json(wrapper({
            first_name: user.first_name,
            last_name: user.last_name,
            email: user.email,
        }));
    }).catch(err => errorHandler(err));
});


/**
 * POST api/v1/user/update-password
 * 
 * Update Password
 */
app.post('/user/update-password', [
    passport.authenticate('jwt', { session: false }),
    middleware.checkPassword,
    check('password').exists(),
    check('new_password').exists(),
    check('new_password', 'Your password must be atleast 7 characters long').isLength({ min: 7 }),
], (req, res) => {

    let errors = validationResult(req);
    if (!errors.isEmpty()) return res.status(422).json({ errors: errors.mapped() });
    var data = matchedData(req);


    User.unscoped().update({
        password: bcrypt.hashSync(data.new_password, bcrypt.genSaltSync(10)),
    }, {
        where: {
            id: req.user.id,
        }
    })
        .then(() => res.json(wrapper({ success: 'true' })))
        .catch(err => errorHandler(err));
});
