const Sequelize = require('sequelize');
const connections = require('./connections');
const errorHandler = require('./errorHandler');


let connection = (typeof global.it === 'function') ? 'test' : (process.env.APP_ENV || 'development');
let dbHost = connections[connection].host;
let dbPort = connections[connection].port;
let dbName = connections[connection].database;
let dbUser = connections[connection].username;
let dbPassword = connections[connection].password;


const sequelize = new Sequelize(dbName, dbUser, dbPassword, {
    port: dbPort,
    host: dbHost,
    dialect: 'postgres',
    logging: false
});

sequelize.authenticate()
    .then(() => console.log('Sequelize: Connection has been established successfully.'))
    .catch(err => errorHandler(err));

module.exports = sequelize