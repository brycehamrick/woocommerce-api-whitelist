<?php
/**
  * Plugin Name: WooCommerce API Whitelist
  * Plugin URI: https://bhamrick.com/
  * Description: Restricts API access based on a whitelist of allowed actions
  * Version: 0.0.1
  * Author: Bryce Hamrick
  * Author URI: https://bhamrick.com/
  */

/**
  * To use this plugin first create a dedicated user with Shop Manager role.
  * Create an API Key / Secret tied to that user, use the below to filter
  * based on user ID.
  *
  *
  */

$restricted_user = 2;
$allowed_types = array('shop_order');

function filter_woocommerce_rest_check_permissions( $permission, $context, $object_id, $post_type ) {
  $current_user = wp_get_current_user();
  if ($current_user->ID == $restricted_user && !in_array($post_type, $allowed_types)) {
    return false;
  }
  return $permission;
};
add_filter( 'woocommerce_rest_check_permissions', 'filter_woocommerce_rest_check_permissions', 10, 4 );
