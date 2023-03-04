const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

/*mix.js('resources/js/app.js', 'public/js') .postCss('resources/css/app.css', 'public/css', []);*/

mix.copyDirectory('resources/image', 'public/image')


//css
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .copy('resources/css/dashboard/*.min.css', 'public/css')
    .copy('resources/css/plugins/icheck-bootstrap/*.min.css', 'public/css/plugins/icheck-bootstrap')
    .copy('resources/css/plugins/toastr/*.min.css', 'public/css/plugins/toastr')
    .copy('resources/css/plugins/datatables/*.min.css', 'public/css/plugins/datatables')
    .copy('resources/css/plugins/select2/*.min.css', 'public/css/plugins/select2')
    .copy('resources/css/plugins/sweetalert2/*.min.css', 'public/css/plugins/sweetalert2')
    .copy('resources/css/plugins/date-picker/*.css', 'public/css/plugins/date-picker')

//js
    .copy('resources/js/plugins/jquery/*.min.js', 'public/js/plugins/jquery')
    .copy('resources/js/plugins/bootstrap/*.min.js', 'public/js/plugins/bootstrap')
    .copy('resources/js/plugins/chart/*.min.js', 'public/js/plugins/chart')
    .copy('resources/js/plugins/toastr/*.min.js', 'public/js/plugins/toastr')
    .copy('resources/js/dashboard/*.min.js', 'public/js/dashboard')
    .copy('resources/js/plugins/datatables/*.min.js', 'public/js/plugins/datatables')
    .copy('resources/js/plugins/pdfmake/*.js', 'public/js/plugins/pdfmake')
    .copy('resources/js/plugins/jszip/*.min.js', 'public/js/plugins/jszip')
    .copy('resources/js/plugins/select2/*.min.js', 'public/js/plugins/select2')
    .copy('resources/js/plugins/sweetalert2/*.min.js', 'public/js/plugins/sweetalert2')
    .copy('resources/js/plugins/date-picker/*.js', 'public/js/plugins/date-picker')

//POS
    .copy('resources/css/pos/*.css', 'public/css/pos')
    .copy('resources/js/pos/*.js', 'public/js/pos')

;


