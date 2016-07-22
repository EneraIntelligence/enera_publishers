process.env.DISABLE_NOTIFIER = true;
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
    mix.sass('app.scss','public/assets/css/app.css');
    mix.sass('budget.scss','public/assets/css/budget.css');
    mix.sass('deposits.scss','public/assets/css/deposits.css');
    mix.sass('profile.scss','public/assets/css/profile.css');
    mix.sass('analytics.scss','public/assets/css/analytics.css');
    mix.sass('campaign.scss','public/assets/css/campaign.css');
    mix.sass('loader.scss','public/assets/css/loader.css');
    mix.sass('login_enera.scss','public/assets/css/login_enera.css');


    //materialize import to public
    mix.sass([
            'material-icons.scss',
            'sticky-footer.scss'
        ],
        'public/css/material-extra.css');

    mix.copy(
        'node_modules/materialize-css/dist/css/materialize.min.css',
        'public/css/materialize.css'
    );
    mix.copy(
        'node_modules/materialize-css/extras/noUiSlider/nouislider.css',
        'public/css/nouislider.css'
    );
    mix.copy(
        'node_modules/materialize-css/dist/js/materialize.min.js',
        'public/js/materialize.js'
    );
    mix.copy(
        'node_modules/materialize-css/dist/fonts',
        'public/fonts'
    );
    mix.copy(
        'node_modules/materialize-css/extras/noUiSlider/nouislider.js',
        'public/js/nouislider.js'
    );
});
