const path = require('path');
const Mustache = require('mustache');
const fs = require('fs');

module.exports = {
    header: (params) => Mustache.render(fs.readFileSync(path.resolve('./src/emails/layout/header.html'), 'utf8'), params),
    template: (template, params) => Mustache.render(fs.readFileSync(path.resolve('./src/emails/' + template), 'utf8'), ((params) ? params : {})),
    footer: (params) => Mustache.render(fs.readFileSync(path.resolve('./src/emails/layout/footer.html'), 'utf8'), params),
}