<?php
/**
 * Post type setup
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register the content type
 */
add_action( 'init', 'ers_register_content_types' );
function ers_register_content_types() {

	//* NAME
	$name_plural = 'Resources';
	$name_singular = 'Resource';
	$post_type = 'resources';
	$slug = 'resources';
	$icon = 'lightbulb'; //* https://developer.wordpress.org/resource/dashicons/
	$supports = array( 'title', 'editor', 'thumbnail', 'excerpt' );

	$labels = array(
		'name' => $name_plural,
		'singular_name' => $name_singular,
		'add_new' => 'Add new',
		'add_new_item' => 'Add new ' . $name_singular,
		'edit_item' => 'Edit ' . $name_singular,
		'new_item' => 'New ' . $name_singular,
		'view_item' => 'View ' . $name_singular,
		'search_items' => 'Search ' . $name_plural,
		'not_found' =>  'No ' . $name_plural . ' found',
		'not_found_in_trash' => 'No ' . $name_plural . ' found in trash',
		'parent_item_colon' => '',
		'menu_name' => $name_plural,
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => $slug ),
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-' . $icon,
		'show_in_rest' => true, // enable gutenberg
		'supports' => $supports,
	);

	register_post_type( $post_type, $args );

}