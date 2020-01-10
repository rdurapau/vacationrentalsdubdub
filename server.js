var express = require('express');

var app = express();
app.use(express.static('./public'));
app.get('/app.js', (req, res) => res.sendFile(__dirname + '/public/app.js'));
app.get('/app.css', (req, res) => res.sendFile(__dirname + '/public/app.css'));
app.get('/*', (req, res) => res.sendFile(__dirname + '/public/index.html'));


const PORT = process.env.APP_PORT || 80;
var server = app.listen(PORT, () => console.log(`App listening on port ${PORT}`));
module.exports = server;