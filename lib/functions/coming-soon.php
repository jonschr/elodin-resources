<?php
/**
 * Coming soon status.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get the coming soon status.
 *
 * @return  bool a bool value for whether the resource is coming soon or not.
 */
function ers_get_coming_soon_status() {

	$coming_soon_status = get_post_meta( get_the_ID(), '_resource_coming_soon', true );

	if ( '1' === $coming_soon_status ) {
		$coming_soon_status = true;
	} else {
		$coming_soon_status = false;
	}

	return $coming_soon_status;
}
