<?php
/*
Plugin Name: Woobizz Hook 8
Plugin URI: http://woobizz.com
Description: Add a button to empty the entire cart on the cart page
Author: WOOBIZZ.COM
Author URI: http://woobizz.com
Version: 1.0.1
Text Domain: woobizzhook8
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook8_load_textdomain' );
function woobizzhook8_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook8', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Add Hook 8
//Empty cart button
function woobizzhook8_add_empty_cart_button() { 
    global $woocommerce;
	$woobizzhook8_empty_cart_txt= __( 'Empty your cart', 'woobizzhook8' );
	echo '<a class="button" href="'.$woocommerce->cart->get_cart_url().'?empty-cart">'.$woobizzhook8_empty_cart_txt.'</a>';
  
}
add_action ('woocommerce_cart_actions','woobizzhook8_add_empty_cart_button');
//Empty cart URL
function woobizzhook8_empty_cart_url() {
	if ( isset( $_GET['empty-cart'] ) ) {
		global $woocommerce;
		$woocommerce->cart->empty_cart();
	}
}
add_action( 'init', 'woobizzhook8_empty_cart_url' );