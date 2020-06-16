const Sequelize = require('sequelize');
const db = require('./../config/db');


module.exports = db.define('price', {
    id: {
        type: Sequelize.UUID,
        primaryKey: true,
        allowNull: false,
        unique: true
    },

    spot_id: Sequelize.UUID,
    month: Sequelize.STRING,
    price: Sequelize.STRING,
    unavailable: Sequelize.BOOLEAN,

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
    tableName: 'price',
    createdAt: 'created_at',
    updatedAt: 'updated_at',
    deletedAt: 'deleted_at',
});
