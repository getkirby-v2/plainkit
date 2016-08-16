# Kirby Plainkit

> Not so plain, really. This is a great place to start if you like Sass & CoffeeScript

## Setup

This project is based on Kirby CMS. Additional requirements include:

- PHP version 5.4 or newer
- [Node](https://nodejs.org) and NPM (Installed with [Brew](http://brew.sh), if possible)

To get started, use the GitHub application to clone the repository, or run:

```
$ git clone --recursive https://github.com/AugustMiller/plainkit.git
$ cd plainkit
```

It's important that the `--recursive` flag is set, because we include a number of dependencies as submodules.

You'll need to create a few folders (if they don't exist, already) for things to work correctly:

```
$ mkdir app/site/accounts app/assets/avatars app/thumbs app/site/config
```

Then, fire up a PHP development server, on an available port:

```
$ php -S localhost:8000 -t app
```

The `-t` flag sets the web root to the `app` directory. We do this to protect leakage of source files and other configuration details into production environments. If you're using an Apache VirtualHost, make sure you use the `app` directory as your `DocumentRoot`!

Things will be pretty broken, right off the bat, but pulling down the `devDependencies` declared in `package.json` will get you most of the way there:

```
$ npm install
```

We use [Gulp](http://gulpjs.com) to consolidate the compilation of Sass and Coffeescript. Front-end Javascript is in the CommonJS architectre, and Browserify handles proper concatenation. Get going with a simple:

```
$ gulp watch
```

When you're ready to deploy, `$ gulp build` will generate minified versions of `app.css` and `app.js`. This is already set up as a local task for [Capistrano](http://capistranorb.com), but you can run it manually, prior to using `rsync` or `scp`. Always remember to set up an ignore list before executing a command that overwrites remote files!

### Starting a new Project

To use this as the starting point for a new project, clone it as you ordinarily would, but specifying a directory name:

```
git clone --recursive https://github.com/AugustMiller/plainkit.git new-project
cd new-project
```

Create your new project repository on GitHub, and replace the `origin` URL in the config:

```
git remote remove origin
git remote add origin https://github.com/username/new-project.git
git push origin master
```

Don't forget to update your server information in the Capistrano configuration files— including your new repo's URL.

### Content

This is up to you! A basic content folder exists, and should be modified or trashed.

### Configuration

Add sensitive configuration to your environment-specific config file, as `site/config/config.localhost.php`, where `localhost` is the domain of the targeted environment. The standard `config.php` is tracked in the repository, by default, to store some environment-agnostic settings.

```php
c::set('custom.config.var', 'your-super-secret-key');
```

## Legal

Code in this repository may not be used on live web servers without a license, available on the [Kirby website](https://getkirby.com/).

Kirby, the Kirby Toolkit and Kirby Panel are all subject to their respective licenses. Please observe the terms of each when using any code herein.

### Buy a license

You can purchase your Kirby license at http://getkirby.com/buy.

A Kirby license is valid for a single domain. You can find Kirby's license agreement here: http://getkirby.com/license.

### Copyright

© 2009-2016 Bastian Allgeier (Bastian Allgeier GmbH) http://getkirby.com

:deciduous_tree:
