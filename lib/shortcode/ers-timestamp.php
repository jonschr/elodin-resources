<?php
/**
 * Output the time in a shortcode.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function ers_timestamp_shortcode() {
	// Get the current Unix timestamp
	$timestamp = time() + 10800;

	// Return the timestamp
	return esc_html($timestamp);
}

// Register the shortcode in WordPress
add_shortcode('ers_timestamp', 'ers_timestamp_shortcode');
