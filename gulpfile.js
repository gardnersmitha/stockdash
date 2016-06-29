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
elixir.config.js.browserify.transformers.push({
    name: 'babelify'
});

elixir(function(mix) { 
	var bootstrapPath = 'node_modules/bootstrap/dist';
	var jqueryPath = 'node_modules/jquery/dist';

	

	mix.browserify('app.js')


		.sass('app.scss')
		.copy(bootstrapPath + '/js/bootstrap.min.js', 'public/js')
		.copy(jqueryPath + '/jquery.min.js', 'public/js')

});