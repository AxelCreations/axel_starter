<?php

/**
 * Fluent static class to create new Custom Post Types
 * *
 * @package Axel_Starter_Theme
 */

namespace Support\CustomPostTypes;

class PostTypeBuilder
{
  private $postTypeSlug;
  private $pluralName;
  private $singularName;

  // args default values
  private $isPublic = true;
  private $isPublicQueryable = true;
  private $showUI = true;
  private $showInMenu = true;
  private $queryVar = true;
  private $hasArchive = true;
  private $hierarchical = false;
  private $supportArray = array('title');
  private $menuPosition = null;
  private $menuIcon = null;

  /**
   * Custom Post Types builder
   *
   * @param string $postTypeSlug The slug for the custom post type. Example: 'book'.
   * @param string $singularName The singular name. Example: 'Book'.
   * @param string $pluralName The plural name. Example: 'Books'.
   * @return PostTypeBuilder
   */
  public function __construct($postTypeSlug, $singularName, $pluralName)
  {
    $this->postTypeSlug = $postTypeSlug;
    $this->singularName = $singularName;
    $this->pluralName = $pluralName;
  }

  /**
   * Return the function that is going to be registered as an action
   * 
   * add_action('init', $returnedFunction)
   *
   * Must be end as the last function of this Builder
   * @return callable
   */
  public function getRegisterFunction()
  {
    $args = array(
      'labels'             => $this->getLabels(),
      'public'             => $this->isPublic,
      'publicly_queryable' => $this->isPublicQueryable,
      'show_ui'            => $this->showUI,
      'show_in_menu'       => $this->showInMenu,
      'query_var'          => $this->queryVar,
      'rewrite'            => array('slug' => $this->postTypeSlug),
      'capability_type'    => 'post',
      'has_archive'        => $this->hasArchive,
      'hierarchical'       => $this->hierarchical,
      'supports'           => $this->supportArray,
      'menu_position'      => $this->menuPosition,
      'menu_icon'          => $this->menuIcon,
    );

    return function () use ($args) {
      register_post_type($this->postTypeSlug, $args);
    };
  }

  // Public functions to override default args values
  public function notPublic()
  {
    $this->isPublic = false;
    return $this;
  }

  /**
   * Deactivate front end queryable functionality for this post type.
   *
   * @return PostTypeBuilder
   */
  public function notQueryable()
  {
    $this->isPublicQueryable = false;
    return $this;
  }

  /**
   * Deactivate managing UI for this post type.
   *
   * @return PostTypeBuilder
   */
  public function notShowUI()
  {
    $this->showUI = false;
    return $this;
  }

  /**
   * Hide from Admin menu.
   *
   * @return PostTypeBuilder
   */
  public function notShowInMenu()
  {
    $this->showInMenu = false;
    return $this;
  }

  /**
   * Deactivate query_var key for this post type.
   *
   * @return PostTypeBuilder
   */
  public function notQueryVar()
  {
    $this->queryVar = false;
    return $this;
  }

  /**
   * Deactivate post type archives.
   *
   * @return PostTypeBuilder
   */
  public function notArchive()
  {
    $this->hasArchive = false;
    return $this;
  }

  /**
   * Activate hierarchical functionality like pages.
   *
   * @return PostTypeBuilder
   */
  public function isHierarchical()
  {
    $this->hierarchical = true;
    return $this;
  }

  /**
   * Add the custom post type support.
   * Default: array('title')
   *
   * @param array $supports array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
   * @return PostTypeBuilder
   */
  public function supportArray($supports)
  {
    $this->supportArray = $supports;
    return $this;
  }
  
  /**
   * Change the menu position based on Wordpress ints
   *
   * @param int $position
   * @return PostTypeBuilder
   */
  public function changePosition($position)
  {
    $this->menuPosition = $position;
    return $this;
  }

  /**
   * Change the menu Icon
   *
   * @param string $icon Can be a WordPress DashIcon, image asset, url data svg
   * @return PostTypeBuilder
   */
  public function changeIcon($icon)
  {
    $this->menuIcon = $icon;
    return $this;
  }

  /**
   * Create label array
   *
   * @return array
   */
  private function getLabels()
  {
    $textDomain = 'axel_starter';

    $labels = array(
      'name'                  => _x($this->pluralName, 'Post type general name', $textDomain),
      'singular_name'         => _x($this->singularName, 'Post type singular name', $textDomain),
      'menu_name'             => _x($this->pluralName, 'Admin Menu text', $textDomain),
      'name_admin_bar'        => _x($this->singularName, 'Add New on Toolbar', $textDomain),
      'add_new'               => __('Add New', $textDomain),
      'add_new_item'          => __('Add New ' . $this->singularName, $textDomain),
      'new_item'              => __('New ' . $this->singularName, $textDomain),
      'edit_item'             => __('Edit ' . $this->singularName, $textDomain),
      'view_item'             => __('View ' . $this->singularName, $textDomain),
      'all_items'             => __('All ' . $this->pluralName, $textDomain),
      'search_items'          => __('Search ' . $this->pluralName, $textDomain),
      'parent_item_colon'     => __('Parent ' . $this->pluralName . ':', $textDomain),
      'not_found'             => __('No ' . $this->pluralName . ' found.', $textDomain),
      'not_found_in_trash'    => __('No ' . $this->pluralName . ' found in Trash.', $textDomain),
      'featured_image'        => _x($this->singularName . ' Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', $textDomain),
      'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', $textDomain),
      'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', $textDomain),
      'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', $textDomain),
      'archives'              => _x($this->singularName . ' archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', $textDomain),
      'insert_into_item'      => _x('Insert into ' . $this->singularName, 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', $textDomain),
      'uploaded_to_this_item' => _x('Uploaded to this ' . $this->singularName, 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', $textDomain),
      'filter_items_list'     => _x('Filter ' . $this->pluralName . ' list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', $textDomain),
      'items_list_navigation' => _x($this->pluralName . ' list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', $textDomain),
      'items_list'            => _x($this->pluralName . ' list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', $textDomain),
    );

    return $labels;
  }
}
