const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/edit-spot/edit-spot.js', 'public/js')
    .js('resources/js/im-the-map/im-the-map.js', 'public/js')
    .sass('resources/sass/mapbox.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/front/styles.scss', 'public/css')
    .copyDirectory('resources/img', 'public/img')
    .extract(['axios', 'bootstrap', 'geojson', 'lodash', 'mapbox-gl', 'mapbox-gl-geocoder', 'popper.js', 'vue', 'vee-validate'])
    .version()
    .options({
        processCssUrls: false,
    });
