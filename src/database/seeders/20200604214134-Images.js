var insert = [{
    id: '604a1106-1e9f-4bad-93ae-2a3cfa588257',
    spot_id: '09895cd2-43b6-4d9d-8250-65f0a723898d',
    name: 'image_1.png',
    mime: 'image/png',
    url: 'https://image.com/image.png',
}];


module.exports = {
    up: (queryInterface, Sequelize) => queryInterface.bulkInsert('images', insert).catch(err => console.log(err)),
    down: (queryInterface, Sequelize) => { }
};
