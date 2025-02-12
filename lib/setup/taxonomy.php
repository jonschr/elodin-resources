<?php
/**
 * Resources post taxonomies
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'init', 'ers_register_taxonomies' );
function ers_register_taxonomies() {
	register_taxonomy(
		'topics',
		'resources',
		array(
			'label' 			=> __( 'Resource topics' ),
			'rewrite' 			=> false,
			'hierarchical' 		=> true,
			'show_in_rest' 		=> true,
		)
	);
	
	register_taxonomy(
		'resourcetypes',
		'resources',
		array(
			'label' 			=> __( 'Resource types' ),
			'rewrite' 			=> false,
			'hierarchical' 		=> true,
			'show_in_rest' 		=> true,
		)
	);
}