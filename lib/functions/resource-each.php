<?php
/**
 * Output each resource.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Output the HTML for each resource.
 *
 * @return  void
 */
function ers_each_resource() {
	// Start output buffering
	ob_start();
	
	// Set custom Cache-Control headers
	header('Cache-Control: no-cache, must-revalidate');
	
	$title = get_the_title();
	$coming_soon_status = ers_get_coming_soon_status();
	$background = ers_get_post_thumbnail_url( get_the_ID() );
		
	echo '<div class="featured-wrap">';
	echo '<div class="resource-content-wrap">';
	echo '<div class="resource-content-inner">';
				
	ers_lock_icon();
				
	// if it's coming soon, output that
	if ( true === $coming_soon_status ) {
		printf( '<p class="coming-soon">%s</p>', 'Coming soon' );
	}
			
	if ( $title ) {
		printf( '<h3 class="resource-title">%s</h3>', esc_html( $title ) );
	}
						
	ers_resource_buttons();
	edit_post_link( 'Edit this resource', '<p>', '</p>' );
	echo '</div>'; // .resource-content-inner
	echo '</div>'; // .resource-content-wrap
	printf( '<div class="featured-image" style="background-image:url( %s )"></div>', $background );
	echo '</div>';	
	
	// Flush the output buffer and send the output
	ob_end_flush();
}
add_action( 'ers_do_each_resource', 'ers_each_resource' );