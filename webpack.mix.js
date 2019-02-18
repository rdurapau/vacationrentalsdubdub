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
   .js('resources/js/submit-spot/submit-spot.js', 'public/js')
   .sass('resources/sass/mapbox.scss', 'public/css')
   .sass('resources/sass/app.scss', 'public/css')
   .extract(['axios', 'bootstrap', 'lodash', 'mapbox-gl', 'mapbox-gl-geocoder', 'popper.js', 'vue'
   ]);
