<?php
/**
 * Redirects based on gating.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Redirect based on locked status (this happens after the template_redirect hook, on purpose).
 *
 * @return  void
 */
function ers_redirect_based_on_locked_status() {
	if ( is_singular( 'resources' ) ) { // Check if the post type is 'resources'.
		global $post;

		// Replace `your_conditional_function()` with your actual conditional function.
		if ( 'unlocked' !== ers_get_locked_status() ) {
			$resource_id  = $post->ID;
			$redirect_url = home_url( '/access/?resourceid=' . $resource_id );
			wp_safe_redirect( $redirect_url );
			exit;
		}
	}
}
add_action( 'wp', 'ers_redirect_based_on_locked_status' );
