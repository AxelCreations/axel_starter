<?php

/**
 * Get the menu items with Subitems. !important => Only 2 levels
 *
 * Try to maintain Law and Order.
 * 
 * @param string $menu The menu ID
 * @return array 
 */
function axel_starter_get_menu_items($menu) {
  $menu_items = wp_get_nav_menu_items($menu);

  $custom_menu = array();
  foreach ($menu_items as $menu_item) {
    if ($menu_item->menu_item_parent) {
      $custom_menu[$menu_item->menu_item_parent]['subitems'][] = $menu_item;
    } else {
      $custom_menu[$menu_item->ID]['item'] = $menu_item;
    }
  }

  return $custom_menu;
}
