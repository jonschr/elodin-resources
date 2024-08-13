<?php
/**
 * Resource button.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Output the resource button.
 *
 * @return void
 */
function ers_resource_buttons() {

	$coming_soon_status = ers_get_coming_soon_status();
	$link               = get_permalink();
	$locked_status      = ers_get_locked_status();

	// bail if it's coming soon.
	if ( true === $coming_soon_status ) {
		return;
	}

	echo '<div class="resource-buttons">';

	if ( 'unlocked' === $locked_status ) {
		printf( '<a class="ers-button" href="%s">View Resource</a>', esc_url( $link ) );
	} else {
		printf( '<a class="ers-button" href="%s">Get Access</a>', esc_url( $link ) );
	}

	echo '</div>';
}
