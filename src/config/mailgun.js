const Mailgun = require('mailgun-js')

module.exports = Mailgun({
    apiKey: process.env.MAILGUN_APIKEY,
    domain: process.env.MAILGUN_DOMAIN
});