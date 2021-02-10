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
mix.js('resources/js/auth.js', 'public/js')
mix.js('resources/js/payment_method.js', 'public/js')
mix.js('resources/js/addressForm.js', 'public/js')
mix.js('resources/js/packageForm.js', 'public/js')
mix.js('resources/js/customerForm.js', 'public/js')
mix.js('resources/js/bootstrap.js', 'public/js')

    .sass('resources/sass/app.scss', 'public/css');
