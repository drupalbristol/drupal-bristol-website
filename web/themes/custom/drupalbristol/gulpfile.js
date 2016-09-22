'use strict';

var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();
var del = require('del');

var config = {
  production: !!plugins.util.env.production,
  sourceMaps: !plugins.util.env.production
};

gulp.task('styles', function () {
  gulp.src('sass/drupalbristol.sass')
    .pipe(plugins.plumber())
    .pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.init()))
    .pipe(plugins.sassGlob())
    .pipe(plugins.sass())
    .pipe(plugins.autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.write('.')))
    .pipe(plugins.if(!config.production, plugins.refresh()))
    .pipe(gulp.dest('css'))
    .pipe(plugins.notify());
});

gulp.task('clean', function () {
  del('css');
});

gulp.task('watch', function () {
  plugins.refresh.listen();

  gulp.watch('sass/**/*.sass', ['styles']);
});

gulp.task('build', ['clean', 'styles']);

gulp.task('default', ['build', 'watch']);
