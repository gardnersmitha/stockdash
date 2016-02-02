var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) { 
	var bootstrapPath = 'node_modules/bootstrap/dist'; 
	mix.sass('app.scss')
		.copy(bootstrapPath + '/js/bootstrap.min.js', 'public/js');
});