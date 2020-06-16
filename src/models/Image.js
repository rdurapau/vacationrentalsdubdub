const Sequelize = require('sequelize');
const db = require('./../config/db');


module.exports = db.define('image', {
    id: {
        type: Sequelize.UUID,
        primaryKey: true,
        allowNull: false,
        unique: true
    },

    spot_id: Sequelize.UUID,

    name: {
        type: Sequelize.STRING,
        allowNull: false
    },
    mime: {
        type: Sequelize.STRING,
        allowNull: false
    },
    url: {
        type: Sequelize.STRING,
        allowNull: false
    },

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
    paranoid: true,
    tableName: 'images',
    createdAt: 'created_at',
    updatedAt: 'updated_at',
    deletedAt: 'deleted_at',
});