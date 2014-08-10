# Introduction

This is the main source for the golf league website that is hosted on http://bctngl.com.

# Configuration

This site uses a MySQL backend to house all of the site data. 

The database configuration for the site is located in the file src/php/config.inc.php. There is also a src/php/config.inc.local.php that contains the configuration for the development environment. The development environment settings should be changed to match your database.

If you need to setup the database for the first time, you can run the sql located at vm/mysql/initialize.sql. This will seed your database with some information for testing.

# Building

This website uses Grunt to build the application. The build primary consists of converting handlebars into real HTML. There are two configurations setup in the build script. One for development and one for production builds. To build the development site, run the following command

```
$ grunt dev
```

And to build the production site, run the following command

```
$ grunt
```

The result of either operation will create a build directory in this directory that contains the site.

> Written with [StackEdit](https://stackedit.io/).