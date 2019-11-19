const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/app.js')
    .sass('resources/sass/app.scss', 'public/app.css');