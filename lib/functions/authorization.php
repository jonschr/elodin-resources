<?php
/**
 * Authorization.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get the locked status.
 *
 * @return  string The locked status.
 */
function ers_get_locked_status() {

	// override if we're logged in.
	if ( is_user_logged_in() ) {
		return 'unlocked';
	}

	// override if cookie was previously set.
	$cookie_status = ers_get_cookie_auth_status();

	if ( 'unlocked' === $cookie_status ) {
		return 'unlocked';
	}

	// do the individual check if needed here.
	$locked_status = get_post_meta( get_the_ID(), '_resource_locked', true );

	if ( '1' === $locked_status ) {
		$locked_status = 'locked';
	} else {
		$locked_status = 'unlocked';
	}

	return $locked_status;
}
