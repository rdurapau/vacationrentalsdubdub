let User = require('./User');
let Spot = require('./Spot');
let Image = require('./Image');
let Price = require('./Price');


// Relationships
User.hasMany(Spot, { foreignKey: 'user_id' });

Spot.hasMany(Image, { foreignKey: 'spot_id' });
Spot.hasMany(Image, { foreignKey: 'spot_id' });


module.exports = {
    User,
    Spot,
    Image,
    Price,
}