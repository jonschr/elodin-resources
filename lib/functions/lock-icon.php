<?php
/**
 * Lock icon.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Output the lock icon.
 *
 * @return  void
 */
function ers_lock_icon() {
	
	$coming_soon_status = ers_get_coming_soon_status();
	
	// bail if it's coming soon
	if ( true === $coming_soon_status ) {
		return;
	}
	
	$locked_status = ers_get_locked_status();
	
	echo '<div class="resource-lock-element">';
	
		if ( 'unlocked' === $locked_status ) {
			echo '<div class="lock-icon-wrap unlocked"><div class="lock-icon"></div></div>';
		} else {
			echo '<div class="lock-icon-wrap locked"><div class="lock-icon"></div></div>';
		}
	
	echo '</div>';
}
