# Kirby Plainkit

> Not so plain, really. This is a great place to start if you like Sass & CoffeeScript

## Setup

This project is based on Kirby CMS. Additional requirements include:

- PHP version 5.4 or newer
- [Node](https://nodejs.org) and NPM (Installed with [Brew](http://brew.sh), if possible)

To get started, use the GitHub application to clone the repository, or run:

```
$ git clone --recursive git@github.com:AugustMiller/plainkit.git
$ cd plainkit
```

It's important that the `--recursive` flag is set, because we include a number of dependencies as submodules.

You'll need to create a few folders (if they don't exist, already) for things to work correctly:

```
$ mkdir site/accounts assets/avatars thumbs site/config
```

Then, fire up a PHP development server, on an available port:

```
$ php -S localhost:8000
```
Things will be pretty broken, right off the bat, but pulling down the `devDependencies` declared in `package.json` will get you most of the way there:

```
$ npm install
```

We use [Gulp](http://gulpjs.com) to consolidate the compilation of Sass and Coffeescript. Front-end Javascript is in the CommonJS architectre, and Browserify handles proper concatenation. Get going with a simple:

```
$ gulp watch
```

When you're ready to deploy, `$ gulp build` will generate minified versions of `app.css` and `app.js`. This can be added as a local task for [Capistrano](http://capistranorb.com), or done manually prior to `rsync`.

### Content

This is up to you! A basic content folder exists, and should be modified or trashed.

### Configuration

Add sensitive configuration to your environment-specific config file, as `site/config/config.localhost.php`, where `localhost` is the domain of the targeted environment. The standard `config.php` is tracked in the repository, by default, to store some environment-agnostic settings.

```php
c::set('custom.config.var', 'your-super-secret-key');
```
