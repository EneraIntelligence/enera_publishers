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
    mix.sass('app.scss','public/assets/css/main.css');
    mix.sass('profile.scss','public/assets/css/profile.css');
    mix.sass('analytics.scss','public/assets/css/analytics.css');
    mix.sass('campaign.scss','public/assets/css/campaign.css');
});
