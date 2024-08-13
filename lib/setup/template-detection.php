<?php
/**
 * Template detection
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Load templates from the plugin unless they are overridden by the theme.
 *
 * @return  array $template the template to be loaded.
 */
function ers_load_single_templates( $template ) {

	global $post;

	// assign the resources single template
	if ( 'resources' === $post->post_type && locate_template( array( 'single-resources.php' ) ) !== $template ) {
		return ELODIN_RESOURCES_DIR . 'template/single-resources.php';
	}

	return $template;
}
add_filter( 'single_template', 'ers_load_single_templates', 99 );