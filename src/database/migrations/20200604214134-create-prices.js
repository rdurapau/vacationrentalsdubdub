module.exports = {
    up: (queryInterface, Sequelize) => queryInterface.createTable('prices', {
        id: {
            type: Sequelize.UUID,
            primaryKey: true,
            allowNull: false,
            unique: true
        },

        spot_id: Sequelize.UUID,
        month: Sequelize.INTEGER,
        price: Sequelize.INTEGER,
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
    }),
    down: (queryInterface, Sequelize) => queryInterface.dropTable('prices'),
};