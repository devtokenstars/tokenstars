
let mix = require('laravel-mix');
const ImageminPlugin = require('imagemin-webpack-plugin').default;
const CopyWebpackPlugin = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');

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

mix.options({
    processCssUrls: false
});

//mix.copyDirectory('resources/assets/images', 'public/images');


mix.webpackConfig({
    node: { fs: 'empty' },
    plugins: [
        new CopyWebpackPlugin([{
            from: 'resources/assets/images',
            to: 'images', // Laravel mix will place this in 'public/img'
        },{
            from: 'resources/views/items/**/*.jpg',
            to: 'images', // Laravel mix will place this in 'public/img'
        },{
            from: 'resources/views/items/**/*.png',
            to: 'images', // Laravel mix will place this in 'public/img'
        }
        ]),
        new ImageminPlugin({
            test: /\.(jpe?g|png|gif|svg)$/i,
            plugins: [
                imageminMozjpeg({
                    quality: 80,
                })
            ]
        })
    ]
});


mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/landing-ace-v2.sass', 'public/css/')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .stylus('resources/assets/stylus/main2.styl', 'public/css')
    .stylus('resources/assets/stylus/charity.styl', 'public/css')
    .stylus('resources/assets/stylus/inline.styl', 'public/css')
    .stylus('resources/assets/stylus/main.styl', 'public/css')
    .copy('node_modules/notie/dist/notie.min.css','public/css')
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.min.css',
        'node_modules/animate.css/animate.min.css',
    ], 'public/css/lib.css')

    //Костыли
    .copy('node_modules/jquery/dist/jquery.min.js','public/plugins')
    .copy('node_modules/notie/dist/notie.min.js','public/plugins')
    .copy('node_modules/fotorama/','public/plugins/fotorama')
// .sourceMaps()


;


if (mix.inProduction()) {
    mix.version();
}
