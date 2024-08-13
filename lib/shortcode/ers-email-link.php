<?php
/**
 * Combine session ID and timestamp into a single shortcode for generating a secure link.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function ers_email_link_func( $atts ) {
	// Ensure that the session is started
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	// Get the session ID
	$session_id = session_id();

	// Get the current Unix timestamp and add 3 hours (10800 seconds)
	$timestamp = time() + 10800;

	// Construct the dynamic URL
	$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
	$host = $_SERVER['HTTP_HOST'];
	$link = $protocol . $host . '/wp-content/plugins/elodin-resources/getaccess.php?resourcetoken=' . esc_html($session_id) . '&expires=' . esc_html($timestamp);
	
	// Shortcode attributes with a default label
	$atts = shortcode_atts( array(
		'label' => 'Access Resources',
	), $atts, 'ers_email_link' );

	// Create the link with the label
	$link = sprintf( '<a href="%s">%s</a>', esc_url( $link ), esc_html( $atts['label'] ) );

	// Return the full link
	return wp_kses_post( $link );
}

// Register the combined shortcode in WordPress
add_shortcode('ers_email_link', 'ers_email_link_func');
