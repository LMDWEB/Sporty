/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../back/scss/style.scss');
require('datatables.net-bs4/css/dataTables.bootstrap4.min.css');
require('@fortawesome/fontawesome-free/css/all.min.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('@fortawesome/fontawesome-free/js/all.js');
require('datatables.net-bs4/js/dataTables.bootstrap4.min');
require('jquery.easing/jquery.easing.min');