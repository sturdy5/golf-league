# Introduction

This is the main source for the golf league website that is hosted on http://bctngl.com.

# Configuration

This site uses a MySQL backend to house all of the site data. 

The database configuration for the site is located in the file src/php/config.inc.php. There is also a src/php/config.inc.local.php that contains the configuration for the development environment. The development environment settings should be changed to match your database.

__NOTE:__ using the default `config.inc.php` will connect you to the production database. Please be careful with changing data.

If you need to setup the database for the first time, you can run the sql located at vm/mysql/initialize.sql. This will seed your database with some information for testing.

# Building

This website uses [Grunt](http://gruntjs.com) to build the application. The build primary consists of converting handlebars into real HTML. There are two configurations setup in the build script. One for development and one for production builds. Before building the site, you will need install the [Composer](https://getcomposer.org/) dependencies by running the command

```
$ composer install
```

Then to build the development site, run the following command

```
$ grunt dev
```

And to build the production site, run the following command

```
$ grunt
```

The result of either operation will create a `dist` directory in this directory that contains the site.

For development, you can build and run the server with grunt using the following command

```
$ grunt serve
```

# Deployments

This project is setup to automatically build, test and deploy all changes made to the master branch. The build is setup via [codeship.io](http://codeship.io).