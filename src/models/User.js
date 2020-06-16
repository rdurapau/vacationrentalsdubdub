const Sequelize = require('sequelize');
const db = require('./../config/db');
const _ = require('lodash');


module.exports = db.define('user', {
    id: {
        type: Sequelize.UUID,
        primaryKey: true,
        allowNull: false,
        unique: true
    },

    email: Sequelize.STRING,
    password: Sequelize.STRING,
    type: Sequelize.STRING,
    first_name: Sequelize.STRING,
    last_name: Sequelize.STRING,
    tos: Sequelize.STRING,

    invite_key: Sequelize.STRING,
    validation_key: Sequelize.STRING,
    password_reset_key: Sequelize.STRING,

    last_login_at: {
        type: Sequelize.DATE,
        allowNull: true,
    },
    deleted_at: {
        type: Sequelize.DATE,
        allowNull: true,
    },
}, {
    tableName: 'users',
    paranoid: true,
    createdAt: 'created_at',
    updatedAt: 'updated_at',
    deletedAt: 'deleted_at',
    defaultScope: {
        attributes: {
            exclude: [
                'password',
                'password_reset_key',
                'validation_key',
            ]
        }
    },
    scopes: {}
});