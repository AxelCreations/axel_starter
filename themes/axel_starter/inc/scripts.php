<?php

/**
 * Author: AxelCreations
 * 
 * Enqueue scripts and styles based on the page template name
 * RULES:
 * 1. The PHP templates need to be like this: /pages/page-{page-name}.php
 * 2. The JS files need to be like this: /js/modules/{page-name}.js
 * 3. The CSS files need to be like this: /css/pages/{page-name}.css
 * 
 * The file empty.css is automatically loaded if there is no CSS file for the loaded page.
 * The file global.js is loaded for all pages
 * 
 * @package Axel_Starter_Theme
 *  
 */

function starter_enqueue_scripts()
{
  $themePath = get_template_directory_uri();

  // Get page name from the template file name
  $pageName = str_replace(array('pages/page-', '.php'), '', get_page_template_slug());

  // if a custom post type is used instead of a page template
  if (empty($pageName)) {
    $pageName = get_post_type();
  }

  // Enqueue the style
  $cssBase = '/assets/css/' . $pageName . '.css';
  $cssFile = $themePath . $cssBase;

  if (file_exists(get_template_directory() . $cssBase)) {
    wp_enqueue_style('axel_starter-' . $pageName . '-css', $cssFile, array(), _S_VERSION);
  } else {
    wp_enqueue_style('axel_starter-empty-css', $themePath . '/assets/css/empty.css', array(), _S_VERSION);
  }

  // Enqueue the script
  $jsBase = '/assets/js/' . $pageName . '.js';
  $jsFile = $themePath . $jsBase;

  if (file_exists(get_template_directory() . $jsBase)) {
    wp_enqueue_script('axel_starter-' . $pageName . '-js', $jsFile, array('jquery'), _S_VERSION, true);
  }
  
  wp_enqueue_script('axel_starter-global-js', $themePath . '/assets/js/global.js', array('jquery'), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'starter_enqueue_scripts');

function starter_enqueue_extra_scripts()
{
  $pageLoads = array();

  $pageLoads['example'] = array(
    'styles' => array('css'),
    'scripts' => array(
      array(
        'script' => 'js',
        'dependency' => array('jquery'),
      ),
      array(
        'script' => 'js',
        'dependency' => array('jquery'),
        'localize' => array(
          'ajaxurl' => admin_url('admin-ajax.php'),
        ),
      ),
    ),
    'localize' => array(
      'ajaxurl' => admin_url('admin-ajax.php'),
    ),
  );

  $pageName = str_replace(array('pages/page-', '.php'), '', get_page_template_slug());

  // if a custom post type is used instead of a page template
  if (empty($pageName)) {
    $pageName = get_post_type();
  }

  $theme_path = get_template_directory_uri();

  $jsBase = $theme_path . '/js/';
  $cssBase = $theme_path . '/css/';

  if (isset($pageLoads[$pageName])) {
    $pageStyles = $pageLoads[$pageName]['styles'];
    $pageScripts = $pageLoads[$pageName]['scripts'];

    $styleID = 1;
    foreach ($pageStyles as $style) {
      wp_enqueue_style('starter-' . $pageName . '-' . $styleID . '-css', $cssBase . $style, array(), _S_VERSION);

      $styleID++;
    }

    $scriptID = 1;
    foreach ($pageScripts as $script) {
      $scriptName = 'starter-' . $pageName . '-' . $scriptID . '-js';
      wp_enqueue_script($scriptName, $jsBase . $script['script'], $script['dependency'], _S_VERSION, true);

      if (isset($script['localize'])) {
        wp_localize_script($scriptName, 'axel_starter', $script['localize']);
      }

      $scriptID++;
    }

    if (isset($pageLoads[$pageName]['localize'])) {
      wp_localize_script('axel_starter-' . $pageName . '-js', 'axel_starter', $pageLoads[$pageName]['localize']);
    }
  }
}

add_action('wp_enqueue_scripts', 'starter_enqueue_extra_scripts');
