module.exports = {
    up: (queryInterface, Sequelize) => queryInterface.createTable('users', {
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
    down: (queryInterface, Sequelize) => queryInterface.dropTable('users'),
};