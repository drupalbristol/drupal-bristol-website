'use strict';

var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();
var del = require('del');

var config = {
  production: !!plugins.util.env.production,
  sass: {
    sourceDir: "sass",
    pattern: "/**/*.sass",
    outputDir: "css"
  },
  sourceMaps: !plugins.util.env.production
};

gulp.task('styles', function () {
  gulp.src(config.sass.sourceDir + config.sass.pattern)
    .pipe(plugins.plumber())
    .pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.init()))
    .pipe(plugins.sassGlob())
    .pipe(plugins.sass())
    .pipe(plugins.autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.write('.')))
    .pipe(plugins.if(!config.production, plugins.refresh()))
    .pipe(gulp.dest(config.sass.outputDir));
});

gulp.task('clean', function () {
  del(config.sass.outputDir);
});

gulp.task('watch', ['default'], function () {
  plugins.refresh.listen();

  gulp.watch(config.sass.sourceDir + config.sass.pattern, ['styles']);
});

gulp.task('default', ['clean', 'styles']);
