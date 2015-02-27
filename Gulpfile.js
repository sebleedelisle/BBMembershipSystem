var elixir = require('laravel-elixir');

require('laravel-elixir-codeception');

require('laravel-elixir-bower');

/*
 |----------------------------------------------------------------
 | Have a Drink!
 |----------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic
 | Gulp tasks for your Laravel application. Elixir supports
 | several common CSS, JavaScript and even testing tools!
 |
 */

elixir(function(mix) {
    mix.less("bootstrap.less")
        .styles([
            'css/bootstrap.css',
            'css/custom.css',
            'css/select2.css',
            'css/select2-bootstrap.css'
        ])
        .scripts([
            'js/partials/payments.js',
            'js/partials/snackbar.js',
            'js/partials/admin-forms.js',
            'js/lib/bootstrap.min.js',
            'js/lib/select2.min.js'
        ])
        .bower()
        .codeception();
});