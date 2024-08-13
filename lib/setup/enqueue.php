<?php
/**
 * Enqueue scripts and styles.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function ers_enqueue_scripts_styles() {
	
	// Plugin styles
	wp_enqueue_style( 'ers-resources-styles', ELODIN_RESOURCES_PATH . 'assets/css/ers-resources-styles.css', array(), ELODIN_RESOURCES_VERSION, 'screen' );
	
	// Script
	// wp_register_script( 'slick-init', plugin_dir_url( __FILE__ ) . 'js/slick-init.js', array( 'slick-main' ), REDBLUE_SECTIONS_VERSION, true );
	
	
}
add_action( 'wp_enqueue_scripts', 'ers_enqueue_scripts_styles' );