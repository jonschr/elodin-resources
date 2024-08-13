<?php
/**
 * Everything dealing directly with the cookie.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Set the cookie status.
 *
 * @return  bool False if the cookie wasn't set.
 */

/**
 * Check the cookie status.
 *
 * @return  string The cookie status.
 */
function ers_get_cookie_auth_status() {
	
	$cookie_auth_status = 'locked';
	
	if ( isset( $_COOKIE['resourcetoken'] ) ) {
		$cookie_auth_status = 'unlocked';
	}
	
	return $cookie_auth_status;
}