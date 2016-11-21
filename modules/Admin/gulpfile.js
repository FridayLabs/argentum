const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

elixir((mix) => {
    mix.sass([
        'app.scss'
    ], 'resources/assets/build/css/app.css');
    mix.sass([
        '../css/bootstrap.min.css',
        '../css/font-awesome.css',
        'gsdk.scss'
    ], 'resources/assets/build/css/vendor.css');
    mix.webpack('app.js', 'resources/assets/build/js/app.js');
});
