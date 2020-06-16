module.exports = {
    up: (queryInterface, Sequelize) => queryInterface.createTable('images', {
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
    }),
    down: (queryInterface, Sequelize) => queryInterface.dropTable('images'),
};