var fs = require('fs');
var sass = require('node-sass');
var autoprefixer = require('autoprefixer');
var postcss = require('postcss');
var Logger = require('./logger');

var args = process.argv.slice(2);
var command = args[0];
var logger = new Logger('Styles');

var render = function (options) {
  options = options || {};

  sass.render({
    file: 'src/css/app.scss',
    outFile: 'app/assets.css/app.css',
    functions: {
      test: function (str) { return sass.types.String(str.getValue() + " test"); }
    },
    outputStyle: options.compress ? 'compressed' : 'nested',
    sourceMapEmbed: options.compress ? false : true
  }, function (err, result) {
    if (err) {
      logger.log(`Stylesheet failed to compile:`);
      console.error(err.formatted);
    } else {
      logger.log(`Stylesheet compiled in ${result.stats.duration}ms`);

      postcss([autoprefixer]).process(result.css, {
        map: false,
        from: undefined
      }).then(function (processed) {
        processed.warnings().forEach(function (warn) {
          logger.warn(warn.toString());
        });

        fs.writeFile('app/assets/css/app.css', processed.css, function (err) {
          if (!err) {
            logger.log(`Stylesheet written.`);
          } else {
            logger.err(err);
          }
        });
      });

    }
  });
}


if (command == 'watch') {
  var watcher = fs.watch('src/css', { recursive: true }, function (type, fileName) {
    logger.log(`Detected update: ${fileName}`);
    render();
  });

  render();
} else {
  render({ compress: true });
}
