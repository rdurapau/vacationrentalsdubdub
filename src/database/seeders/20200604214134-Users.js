const faker = require('faker');
const bcrypt = require('bcrypt-nodejs');

var insert = [{
    id: 'c4644733-deea-47d8-b35a-86f30ff9618e',
    email: 'anthonybudd@vrww.app',
    password: bcrypt.hashSync('password', bcrypt.genSaltSync(10)),
    first_name: 'anthony',
    last_name: 'budd',
    type: 'user',
    tos: '2020-04-06',
}, {
    id: '281bd02e-c1c5-4833-8af0-7b6e339cc103',
    email: 'user@vrww.app',
    password: bcrypt.hashSync('password', bcrypt.genSaltSync(10)),
    type: 'user',
    first_name: 'USER',
    last_name: 'USER',
    tos: '2020-04-06',
}, {
    id: '259a4733-deea-47d8-b35a-e853d6812097',
    email: 'admin@vrww.app',
    password: bcrypt.hashSync('password', bcrypt.genSaltSync(10)),
    type: 'admin',
    first_name: 'ADMIN',
    last_name: 'ADMIN',
    tos: '2020-04-06',
}]


module.exports = {
    up: (queryInterface, Sequelize) => queryInterface.bulkInsert('users', insert).catch(err => console.log(err)),
    down: (queryInterface, Sequelize) => { }
};
