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

 mix.js('resources/js/admin/admin.js', 'public/js')
    .sass('resources/scss/admin/admin.scss', 'public/css')
    .js('resources/js/home/home.js', 'public/js')
    .sass('resources/scss/home/home.scss', 'public/css');


// mix.js('resources/js/app.js', 'public/js')
//     .vue()

