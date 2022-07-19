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


mix.sass('resources/sass/app.scss', 'public/css').options( {processCssUrl: false} );
mix.sass('resources/sass/navbar.scss', 'public/css').options( {processCssUrl: false} );
mix.sass('resources/sass/table.scss', 'public/css').options( {processCssUrl: false} );
mix.sass('resources/sass/form.scss', 'public/css').options( {processCssUrl: false} );
mix.sass('resources/sass/authforms.scss', 'public/css').options( {processCssUrl: false} );
mix.sass('resources/sass/messages.scss', 'public/css').options( {processCssUrl: false} );
mix.sass('resources/sass/sponsors.scss', 'public/css').options( {processCssUrl: false} );


//# js general admin(ura ur)
mix.js('resources/js/admin.js', 'public/js');

//# Front end js vue
mix.js('resources/js/front.js', 'public/js');

/* //# js per collegare javascript al create di blade */
mix.js('resources/js/apartmentsCreate.js', 'public/js');

/* //# js per i messaggi */
mix.js('resources/js/messages.js', 'public/js');


