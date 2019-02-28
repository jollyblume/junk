var Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('web/build/')
  .setPublicPath('/build')
  .cleanupOutputBeforeBuild()
  .enableSassLoader(function(sassOptions) {}, {resolve_url_loader: true})
  .enablePostCssLoader()
  .autoProvidejQuery()
  .enableVersioning()
  .enableSourceMaps(!Encore.isProduction())
  .addStyleEntry('one-page-theme', './src/AppBundle/Resources/themes/one-page-theme/sass/one-page-theme.scss')
  .addEntry('one-page', './src/AppBundle/Resources/themes/one-page-theme/js/one-page-theme.js')
  .createSharedEntry('vendor', [
    'jquery',
    'popper.js',
    'bootstrap'
  ]);

var config = Encore.getWebpackConfig();

config.node = { fs: 'empty' };

module.exports = config;
