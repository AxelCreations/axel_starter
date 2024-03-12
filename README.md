# Starter Theme
This is a starter theme to ease the process of creating new WordPress projects. It comes configured to work with modern technologies such as TypeScript and SASS for the development process, a framework for working with page templates and automatic loading of css and js.


## Build-In custom post type registration
You can create a new Custom Post Type using our PostTypeBuilder.

### 1. Create a new File for the Custom Post Type.
Let's create a new "Service" Custom Post Type,  `/inc/support/post-types/ServicePostType.php`

```php
use Support\CustomPostTypes\PostTypeBuilder;

$serviceBuilder = new PostTypeBuilder('service', 'Service', 'Services');
$servicePostType = $serviceBuilder->getRegisterFunction();
add_action('init', $servicePostType);
```
### 2. Register your new Custom Post Type in the support file.
Edit `/inc/support.php` and register your new file after the **PostTypeBuilder.php** `require get_template_directory() . '/inc/support/post-types/ServicePostType.php';`

```php
/**
 * Include custom post types
 */
require get_template_directory() . '/inc/support/post-types/PostTypeBuilder.php';
require get_template_directory() . '/inc/support/post-types/ServicePostType.php';

/**
 * Include custom functions
 */
require get_template_directory() . '/inc/support/custom-functions/functions.php';
```



# How to get Ready?
Here you can see everything you need to get this **starter theme** ready to work.

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
