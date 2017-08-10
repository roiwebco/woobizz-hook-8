<?php
/*
Plugin Name: Woobizz Hook 8
Plugin URI: http://woobizz.com
Description: Add empty cart button on cart page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
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
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
	 add_action ('woocommerce_cart_actions','woobizzhook8_add_empty_cart_button');
	 add_action( 'init', 'woobizzhook8_empty_cart_url' );
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook8_admin_notice' );
}
//Add Hook 8
//Empty cart button
function woobizzhook8_add_empty_cart_button() { 
    global $woocommerce;
	$woobizzhook8_empty_cart_txt= __( 'Empty your cart', 'woobizzhook8' );
	echo '<a class="button" href="'.$woocommerce->cart->get_cart_url().'?empty-cart">'.$woobizzhook8_empty_cart_txt.'</a>';
  
}
//Empty cart URL
function woobizzhook8_empty_cart_url() {
	if ( isset( $_GET['empty-cart'] ) ) {
		global $woocommerce;
		$woocommerce->cart->empty_cart();
	}
}
//Hook8 Notice
function woobizzhook8_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 8 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook8' ); ?></p>
    </div>
    <?php
}