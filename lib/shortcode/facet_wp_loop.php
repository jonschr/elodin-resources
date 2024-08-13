<?php
/**
 * Set up the facetwp resources loop
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function ers_resources() {

	if ( have_posts() ) {

		while ( have_posts() ) {
			
			the_post(); 
			
			global $post;
			
			printf( '<div class="%s"><div class="post-inner">', esc_attr( implode( ' ', get_post_class( 'resources-each' ) ) ) );
				
				do_action( 'ers_do_each_resource' );

			echo '</div></div>';
			
		} // end while
		
	} else {
		echo 'So sorry! Nothing found.';
	}
}
add_action( 'ers_do_resources', 'ers_resources' );