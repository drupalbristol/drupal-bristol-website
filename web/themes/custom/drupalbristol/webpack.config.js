var Encore = require('@symfony/webpack-encore');

Encore
    .cleanupOutputBeforeBuild()
    .setOutputPath('build/')
    .setPublicPath('/themes/custom/drupalbristol/build')
    .enableLessLoader()
    .addStyleEntry('css/site', './less/main.less')
    .enablePostCssLoader(function(options) {
        options.config = {
            path: 'postcss.config.js'
        };
    })
    .enableSourceMaps(!Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
