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
    .react()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

if (mix.inProduction()) {
    mix.version();
} else {
    mix.browserSync('127.0.0.1:8000');
    mix.webpackConfig({
        devServer: {
            proxy: {
                '*': 'http://127.0.0.1:8000'
            },
            hot: true,
            port: 8080,
            headers: {
                'Access-Control-Allow-Origin': '*'
            }
        }
    });
}

// mix.js('resources/js/app.js', 'public/js')
//     .react()
//     .sass('resources/sass/app.scss', 'public/css');
