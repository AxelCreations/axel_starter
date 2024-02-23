# Starter Theme
Development environment configuration and frontend compilation.

## Environment Recommendations
- WordPress v6.4.3
- PHP v8.2.10
- MySQL v8.0.16

## Requirements
- [Yarn v1.22.19](https://classic.yarnpkg.com/lang/en/docs/install/#mac-stable/)
- [Node.js v20.11.0](https://nodejs.org/)
- [Composer v2.7.1](https://getcomposer.org/download/)
- [Gulp CLI v2.3.0](https://gulpjs.com/docs/en/getting-started/quick-start#install-the-gulp-command-line-utility)

## Compile JS and CSS
Go to the entry path: **/themes/axel_starter/**

0 - Remove the `node_modules` folder if exists

1 - Install npm and composer packages

```sh
$ composer install
$ yarn install
```

2 - Run gulp task
```sh
$ gulp watch
```

### Additional CLI commands
- `composer lint:wpcs` : checks all PHP files against [PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
- `composer lint:php` : checks all PHP files for syntax errors.
- `composer make-pot` : generates a .pot file in the `languages/` directory.
