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

mix
  .setPublicPath('./public')
  .sass('resources/css/fields.scss', 'css')
  .js('resources/js/fields.js', 'js')
  .autoload({ jquery: ['$', 'window.jQuery'] })
  .options({
    processCssUrls: false,
    postCss: [require('tailwindcss')('./tailwind.config.js')]
  })
  .version();
