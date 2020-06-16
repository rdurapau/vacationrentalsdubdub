module.exports = {
    up: (queryInterface, Sequelize) => queryInterface.createTable('spots', {
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
    }),
    down: (queryInterface, Sequelize) => queryInterface.dropTable('spots'),
};