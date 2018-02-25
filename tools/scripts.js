var fs = require('fs');
var coffeeify = require('coffeeify');
var browserify = require('browserify');
var watchify = require('watchify');
var uglify = require('uglify-js');
var Logger = require('./logger');

var args = process.argv.slice(2);
var command = args[0];
var plugins = [];

var logger = new Logger('Scripts');

if (command == 'watch') plugins.push(watchify);

var b = browserify({
  entries: [
    'src/js/app.coffee'
  ],
  paths: [
    'node_modules',
    'src/js'
  ],
  transform: [
    coffeeify
  ],
  extensions: '.coffee',
  cache: {},
  packageCache: {},
  plugin: plugins
});


function render (options) {
  options = options || {};

  b.bundle(function (err, result) {
    var timer = new Date();

    logger.log('Bundle is updating...');

    if (err) {
      logger.error(`Bundle failed to update.`);
      console.error(err);
    } else {
      var out = fs.createWriteStream('app/assets/js/app.js');

      if (options.compress) {
        var mangled = uglify.minify(result.toString(), {
          compress: {
            drop_console: true
          }
        });

        if (mangled.error) {
          logger.error(mangled.error);
          out.end(`console.log("[Error at build time] ${mangled.error}");`);
        } else {
          out.end(mangled.code);
        }
      } else {
        out.end(result);
      }

      logger.log(`Bundle updated in ${new Date().getTime() - timer.getTime()}ms`);
    }
  })
}

if (command == 'watch') {
  b.on('update', render);
  render();
} else if (command == 'build') {
  render({ compress: true });
}
