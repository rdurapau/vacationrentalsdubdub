const Sequelize = require('sequelize');
const db = require('./../config/db');

module.exports = db.define('group', {
    id: {
        type: Sequelize.UUID,
        primaryKey: true,
        allowNull: false,
        unique: true
    },

    user_id: Sequelize.UUID,

    name: Sequelize.STRING,

    created_at: {
        type: Sequelize.DATE,
        allowNull: true,
    },
    updated_at: {
        type: Sequelize.DATE,
        allowNull: true,
    },
    deleted_at: {
        type: Sequelize.DATE,
        allowNull: true,
    },
}, {
    tableName: 'groups',
    paranoid: true,
    createdAt: 'created_at',
    updatedAt: 'updated_at',
    deletedAt: 'deleted_at',
    defaultScope: {},
});
