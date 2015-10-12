var gulp = require('gulp'),
    gutil = require('gulp-util'),
    coffee = require('gulp-coffee'),
    coffeeify = require('gulp-coffeeify'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    test = require('gulp-if'),
    del = require('del'),
    rename = require('gulp-rename');

var paths = {
  scripts: {
    main: ['assets/coffee/app.coffee'],
    listen: ['assets/coffee/**/*.coffee'],
    out: 'assets/js'
  },
  stylesheets: {
    main: ['assets/sass/app.sass'],
    listen: ['assets/sass/**/*.sass'],
    out: 'assets/css'
  }
};

var templates = {
  scripts: function (mangle) {
    return gulp.src(paths.scripts.main)
      .pipe(coffeeify({
        options: {
          debug: !mangle,
          paths: [__dirname + '/node_modules', __dirname + '/assets/coffee']
        }
      }))
      .pipe(test(mangle, uglify(), null))
      .pipe(gulp.dest(paths.scripts.out));
  },
  styles: function (compress) {
    return gulp.src(paths.stylesheets.main)
      .pipe(sass({
        outputStyle: (compress ? 'compressed' : 'expanded'),
        includePaths: require('node-neat').includePaths.concat(require('node-reset-scss').includePath)
      }).on('error', sass.logError))
      .pipe(gulp.dest(paths.stylesheets.out));

    return stream;
  }
};

// Javascript

gulp.task('scripts:compile', ['scripts:clean'], function () {
  templates.scripts(false);
});

gulp.task('scripts:build', ['scripts:clean'], function () {
  templates.scripts(true);
});

gulp.task('scripts:clean', function () {
  del(['assets/js/*.js']);
});

gulp.task('scripts:watch', function () {
  gulp.watch(paths.scripts.listen, ['scripts:compile']);
});

// Sass

gulp.task('stylesheets:compile', ['stylesheets:clean'], function () {
  templates.styles(false);
});

gulp.task('stylesheets:build', ['stylesheets:clean'], function () {
  templates.styles(true);
});

gulp.task('stylesheets:clean', function () {
  del(['assets/css/*.css']);
});

gulp.task('stylesheets:watch', function () {
  gulp.watch(paths.stylesheets.listen, ['stylesheets:compile']);
});

// Groups

gulp.task('scripts', ['scripts:watch', 'scripts:compile']);
gulp.task('stylesheets', ['stylesheets:watch', 'stylesheets:compile']);

// Commands

gulp.task('default', ['scripts:compile', 'stylesheets:compile']);
gulp.task('watch', ['scripts', 'stylesheets']);

gulp.task('build', ['scripts:build', 'stylesheets:build']);
