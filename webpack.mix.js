let mix = require('laravel-mix');

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

mix
    // .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('resources/assets/js/stcore.js', 'public/js')
    .copy('bower_components/speedtest/speedtest_worker.min.js', 'public/js/speedtest.min.js')
    .copy('bower_components/gauge.js/dist/gauge.min.js', 'public/js');
