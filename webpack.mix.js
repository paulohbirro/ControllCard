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

mix.js([
    'node_modules/laravel-materialize/dist/materialize/materialize.js',
    'node_modules/jquery/dist/jquery.js',
    'node_modules/jquery.maskedinput/src/jquery.maskedinput.js',
    'resources/assets/js/app.js'], 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
