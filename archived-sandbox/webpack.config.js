var Encore = require('@symfony/webpack-encore');

const CopyWebpackPlugin = require('copy-webpack-plugin');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableVersioning()
    .enableSourceMaps(!Encore.isProduction())

    .addEntry('js/global', './assets/js/global.js')
    .addStyleEntry('css/global', './assets/css/global.scss')

    .addEntry('js/admin', './assets/js/admin.js')
    .addStyleEntry('css/admin', './assets/css/admin.scss')

    .addEntry('js/basic-scroll', './assets/js/basic-scroll.js')
    .addStyleEntry('css/react', './assets/css/react.scss')

    .enableReactPreset()
    .enableSassLoader(function(options) {}, { resolveUrlLoader: true })
    .enablePostCssLoader()
    .configureUrlLoader({
        fonts: { limit: 4096 },
        images: { limit: 4096 }
    })

    .autoProvidejQuery()
    .autoProvideVariables({
        Popper: ['popper.js', 'default'],
        React: 'react',
        ReactDOM: 'react-dom',
        Scroll: 'react-scroll',
        PropTypes: 'prop-types'
    })
    .enableBuildNotifications()

    .createSharedEntry('vendor', [
        'jquery',
        'popper.js',
        'bootstrap',
        'anchor-js',
        'ContentTools',
        'react',
        'react-dom',
        'react-scroll',
        'prop-types',
        'bootstrap/scss/bootstrap.scss',
    ])

    .addPlugin(new CopyWebpackPlugin([
      { from: './assets/static', to: 'static' }
    ]))
;

module.exports = Encore.getWebpackConfig();
