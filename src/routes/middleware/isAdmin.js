const errorHandler = require('./../../config/errorHandler');
const jwt = require('jsonwebtoken');
const fs = require('fs');

module.exports = (req, res, next) => {
    var token = req.headers['authorization'].replace('Bearer ', '');

    jwt.verify(token, fs.readFileSync(process.env.PUBLIC_KEY_PATH, 'utf8'), { algorithms: ['RS512'] }, (err, user) => {
        if (err) return errorHandler(err);

        if (user.type === 'admin') {
            return next()
        } else {
            return res.status(401).send('Error 1')
        }
    });
}