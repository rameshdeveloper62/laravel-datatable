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

// mix.autoload({
//    jquery: ['$', 'window.jQuery']
// });

mix.js([
		'resources/js/app.js',
		'resources/js/bootstrap.js',
	], 'public/js/app.js')
   .styles([
   		// 'resources/css/app.css',
   		'resources/css/style.css',
   		'resources/css/bootstrap.css',
   		'resources/css/animate.css',
   	], 'public/css/app.css');
