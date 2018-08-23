let mix = require('laravel-mix');

require('laravel-mix-tailwind');

mix.disableNotifications()
  .less('less/main.less', 'build/css/site.css')
  .tailwind();
