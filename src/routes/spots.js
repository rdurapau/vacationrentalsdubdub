const { check, validationResult } = require('express-validator/check');
const { matchedData } = require('express-validator/filter');
const errorHandler = require('./../config/errorHandler');
const wrapper = require('./../config/wrapper');
const middleware = require('./middleware');
const { Spot } = require('./../models');
const passport = require('passport');
const { Op } = require('sequelize');
const express = require('express');
const uuidv4 = require('uuid/v4');

var app = (module.exports = express.Router());


/**
 * GET api/v1/spots
 * 
 */
app.get('/spots', [
    passport.authenticate('jwt', { session: false }),
], (req, res) => {
    Spot.findAll({})
        .then(spots => res.json(wrapper(spots)))
        .catch(err => errorHandler(err, res))
})


/**
 * POST api/v1/spots/new
 * 
 */
app.post('/spots/new', [
    passport.authenticate('jwt', { session: false }),
], (req, res) => {

    let errors = validationResult(req);
    if (!errors.isEmpty()) return res.status(422).json({ errors: errors.mapped() });
    var data = matchedData(req);

    Spot.create({
        id: uuidv4(),
        group_id: req.params.group_id,
        token: token.id,
        brand: token.card.brand,
        last4: token.card.last4,
        exp_month: token.card.exp_month,
        exp_year: token.card.exp_year,
        is_default: true,
    })
        .then(spot => res.json(wrapper(spot)))
        .catch(err => errorHandler(err, res));
});



/**
 * GET api/v1/spots/:spot_id
 * 
 */
app.get('/spots/:spot_id', [
    passport.authenticate('jwt', { session: false }),
], (req, res) => {
    Spiot.findByPk(req.params.spot_id)
        .then(spot => res.json(wrapper(spot)))
        .catch(err => errorHandler(err, res));
});


/**
 * POST api/v1/spots/:spot_id/delete
 * 
 */
app.delete('/spots/:spot_id/delete', [
    passport.authenticate('jwt', { session: false }),
], (req, res) => {
    Spot.destroy({
        where: {
            id: req.params.spot_id
        }
    })
        .then(() => res.send(wrapper({ id: req.params.spot_id })))
        .catch(err => errorHandler(err, res));
});