<?php

// Check if the menu exists
$menu_name = 'Home Page Curation';
$menu_exists = wp_get_nav_menu_object( $menu_name );

// If it doesn't exist, let's create it.
if( !$menu_exists){
    $menu_id = wp_create_nav_menu($menu_name);

	// Set up default menu items
    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Home'),
        'menu-item-classes' => 'home',
        'menu-item-url' => home_url( '/' ), 
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Custom Page'),
        'menu-item-url' => home_url( '/custom/' ), 
        'menu-item-status' => 'publish'));

}