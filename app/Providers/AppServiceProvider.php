<?php

namespace Publishers\Providers;

use App;
use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        App::setLocale('es');

        Validator::extend('foo', function($attribute, $value, $parameters, $validator) {
            return $value == 'foo';
        });


        /*$rules = ['count' => 'integer'];

        $input = ['count' => null];

        Validator::make($input, $rules)->passes(); // true*/
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
