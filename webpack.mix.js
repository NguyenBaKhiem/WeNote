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

mix.copy('resources/js/lib/socket.io.js', 'public/js')
   .js('resources/js/home/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .version();

/**
 * Webpack configuration
 */

mix.webpackConfig({
    plugins: [
    ],
    resolve: {
      alias: {
        "requestfactory": path.resolve(__dirname, './resources/js/request/RequestFactory.js'),
        "common": path.resolve(__dirname, './resources/js/common'),
        "images": path.resolve(__dirname, './public/images')
      }
    },
});
