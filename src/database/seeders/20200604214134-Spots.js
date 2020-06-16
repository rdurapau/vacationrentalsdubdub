var insert = [{
    id: '09895cd2-43b6-4d9d-8250-65f0a723898d',
    user_id: 'c4644733-deea-47d8-b35a-86f30ff9618e',
    name: 'my house',
}];


module.exports = {
    up: (queryInterface, Sequelize) => queryInterface.bulkInsert('spots', insert).catch(err => console.log(err)),
    down: (queryInterface, Sequelize) => { }
};
