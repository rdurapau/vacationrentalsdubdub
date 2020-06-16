var insert = [{
    id: '4f97eb9c-31c6-4156-a52a-c4ac78c85c12',
    spot_id: '09895cd2-43b6-4d9d-8250-65f0a723898d',
    month: 1,
    price: 100,
    unavailable: 1,
}];


module.exports = {
    up: (queryInterface, Sequelize) => queryInterface.bulkInsert('prices', insert).catch(err => console.log(err)),
    down: (queryInterface, Sequelize) => { }
};
