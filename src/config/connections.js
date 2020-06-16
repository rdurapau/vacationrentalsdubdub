module.exports = {
    development: {
        username: process.env.DB_USER || 'app',
        password: process.env.DB_PASSWORD || 'secret',
        database: process.env.DB_DATABASE || 'vrww',
        host: process.env.DB_HOST || 'vrww-db',
        port: process.env.DB_PORT || '5432',
        dialect: 'postgres',
    },
    production: {
        username: process.env.DB_USER,
        password: process.env.DB_PASSWORD,
        database: process.env.DB_DATABASE,
        host: process.env.DB_HOST,
        port: process.env.DB_PORT,
        dialect: 'postgres',
    },

    test: {
        username: 'app',
        password: 'secret',
        database: 'vrww',
        host: 'vrww-db-test',
        port: '5432',
        dialect: 'postgres',
    }
}