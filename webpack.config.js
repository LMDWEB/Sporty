var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')


    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */

    .addEntry('front', [
        './assets/js/front.js',
        './assets/front/js/jquery.js',
        './assets/front/js/jquery.flexslider.js',
        './assets/front/js/owl.carousel.min.js',
        './assets/front/js/jquery.countdown.js',
        './assets/front/js/waypoints-min.js',
        './assets/front/js/jquery.bxslider.min.js',
        './assets/front/js/bootstrap-progressbar.js',
        './assets/front/js/jquery.accordion.js',
        './assets/front/js/jquery.circlechart.js',
        './assets/front/js/kode_pp.js',
        './assets/front/js/functions.js'
    ])
    .addEntry('back', [
        './assets/js/back.js',
        './assets/front/js/jquery.js'
    ])


    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables Sass/SCSS support
    .enableSassLoader()

    .enablePostCssLoader()

    .enableSourceMaps(!Encore.isProduction())

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you're having problems with a jQuery plugin
    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })
;

module.exports = Encore.getWebpackConfig();
