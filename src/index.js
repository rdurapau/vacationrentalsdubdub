require('dotenv').load();
const passport = require('./config/passport');
const { version } = require('./../package');
const bodyParser = require('body-parser');
const express = require('express');
const cors = require('cors');
const http = require('http');


////////////////////////////
// App
var app = express();
app.use(cors({
    origin: '*',
    credentials: true,
    allowedHeaders: ['Content-Type', 'Authorization']
}));
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());


// Console Debug
if (process.env.APP_ENV === 'development') app.use((req, res, next) => {
    console.log(req.method + ' - ' + req.protocol + '://' + req.get('Host') + req.url);
    if (req.body && req.body.length > 0) console.log(req.body);
    return next();
});


////////////////////////////
// HTTP

// Healthcheck
app.get('/api/v1/_healthcheck', (req, res) => res.json({
    status: 'ok',
    api: 'vrww',
    version,
}));

// Authcheck
app.get('/api/v1/_authcheck', passport.authenticate('jwt', { session: false }), (req, res) => res.json({
    auth: true,
    user_id: req.user.id,
}));

// Admin
// app.use('/api/v1/', require('./routes/_admin'));

// Auth Routes
app.use('/api/v1/', require('./routes/auth'));

// Spots Routes
app.use('/api/v1/', require('./routes/spots'));


var port = process.env.PORT || 80;
if (typeof global.it === 'function') port = 7777
http.createServer(app).listen(port, err => console.log('listening in http://localhost:' + port));
module.exports = app;
