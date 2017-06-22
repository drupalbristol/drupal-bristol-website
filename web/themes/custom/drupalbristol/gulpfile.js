'use strict';

var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();
var del = require('del');

var config = {
  fontsDir: 'fonts',
  production: !!plugins.util.env.production,
  sass: {
    sourceDir: "sass",
    pattern: "/**/*.sass",
    outputDir: "css"
  },
  sourceMaps: !plugins.util.env.production
};

var app = {};

app.copy = function(sourceDir, outputDir) {
  return gulp.src(sourceDir)
    .pipe(gulp.dest(outputDir));
}

app.sass = function(sourceFiles, filename) {
  return gulp.src(sourceFiles)
    .pipe(plugins.plumber())
    .pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.init()))
    .pipe(plugins.sassGlob())
    .pipe(plugins.sass())
    .pipe(plugins.concat(filename))
    .pipe(plugins.autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe(plugins.if(config.sourceMaps, plugins.sourcemaps.write('.')))
    .pipe(plugins.if(!config.production, plugins.refresh()))
    .pipe(gulp.dest(config.sass.outputDir));
}

gulp.task('styles', function () {
  return app.sass([
    'node_modules/font-awesome/css/font-awesome.css',
    config.sass.sourceDir + config.sass.pattern
  ], 'main.css');
});

gulp.task('fonts', function() {
  return app.copy('node_modules/font-awesome/fonts/*', config.fontsDir);
});

gulp.task('clean', function () {
  del.sync(config.sass.outputDir);
  del.sync(config.fontsDir);
});

gulp.task('watch', ['default'], function () {
  plugins.refresh.listen();

  gulp.watch(config.sass.sourceDir + config.sass.pattern, ['styles']);
});

gulp.task('default', ['clean', 'fonts', 'styles']);
