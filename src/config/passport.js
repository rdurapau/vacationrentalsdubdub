const { User, Group, Permission, PartnerRole } = require('./../models');
const LocalStrategy = require('passport-local').Strategy;
const errorHandler = require('./errorHandler');
const passportJWT = require('passport-jwt');
const JWTStrategy = passportJWT.Strategy;
const ExtractJWT = passportJWT.ExtractJwt;
const bcrypt = require('bcrypt-nodejs');
const passport = require('passport');
const { Op } = require('sequelize');
const fs = require('fs');


passport.use(new LocalStrategy({
    usernameField: 'email',
    passwordField: 'password'
}, (email, password, cb) => {
    User.unscoped().findOne({
        where: { email },
        include: [Group, Permission, PartnerRole]
    }).then(user => {
        if (!user) return cb(null, false, { message: 'Incorrect email or password.' });
        if (user.invite_key !== null) return cb(null, false, { message: 'Account not activated' });

        return bcrypt.compare(password, user.password, (err, compare) => {
            if (compare) {
                return cb(null, user, { message: 'Logged In Successfully' });
            } else {
                return cb(null, false, { message: 'Incorrect email or password.' });
            }
        });
    }).catch(err => {
        errorHandler(err);
        cb(null, false, { message: 'Incorrect email or password.' });
    });
}));


passport.use(new JWTStrategy({
    jwtFromRequest: ExtractJWT.fromAuthHeaderAsBearerToken(),
    secretOrKey: fs.readFileSync(process.env.PUBLIC_KEY_PATH, 'utf8'),
}, (jwtPayload, cb) => cb(null, jwtPayload)));


module.exports = passport;