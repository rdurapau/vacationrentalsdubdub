const jwt = require('jsonwebtoken');
const moment = require('moment');
const _ = require('lodash');
const fs = require('fs');

module.exports = (user, JWTtype, expires) => {

    var payload = {
        // Required
        id: user.id,
        type: user.type || 'user',
        JWT_type: JWTtype,

        // User only
        email: user.email,
        first_name: user.first_name,
        last_name: user.last_name,
        display_name: user.display_name,
        profile_image: user.profile_image,
    }

    if (user.source) payload.source = user.source;
    if (user.group_id) payload.group_id = user.group_id;

    var expiresIn = moment(new Date()).add(10, 'years').unix();
    if (Array.isArray(expires) && expires.length == 2) {
        expiresIn = moment(new Date()).add(expires[0], expires[1]).unix();
    } else if (typeof expires === 'string') {
        expiresIn = moment(expires, 'YYYY-MM-DD HH:mmZ').unix();
    }

    return jwt.sign(payload, fs.readFileSync(process.env.PRIVATE_KEY_PATH, 'utf8'), {
        expiresIn,
        algorithm: 'RS512',
    });
}