<?php
/**
 * Resources post meta
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function ers_add_resources_meta_box() {
	add_meta_box(
		'resources_meta_box',
		'Resource Options',
		'ers_display_resources_meta_box',
		'resources',
		'side',
		'high'
	);
}
add_action('add_meta_boxes', 'ers_add_resources_meta_box');

function ers_display_resources_meta_box($post) {
	$resource_locked = get_post_meta($post->ID, '_resource_locked', true);
	$resource_coming_soon = get_post_meta($post->ID, '_resource_coming_soon', true);
	
	// Add nonce for security
	wp_nonce_field('ers_save_resources_meta_box', 'ers_resources_meta_box_nonce');

	?>
	<p>
		<label>
			<input type="checkbox" name="resource_locked" value="1" <?php checked($resource_locked, '1'); ?> />
			Resource Locked
		</label>
	</p>
	<p>
		<label>
			<input type="checkbox" name="resource_coming_soon" value="1" <?php checked($resource_coming_soon, '1'); ?> />
			Resource Coming Soon
		</label>
	</p>
	<?php
}

function ers_save_resources_meta_box($post_id) {
	// Check if our nonce is set.
	if (!isset($_POST['ers_resources_meta_box_nonce'])) {
		return;
	}

	// Verify that the nonce is valid.
	if (!wp_verify_nonce($_POST['ers_resources_meta_box_nonce'], 'ers_save_resources_meta_box')) {
		return;
	}

	// Check for autosave.
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Check user permissions.
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Save Resource Locked.
	$resource_locked = isset($_POST['resource_locked']) ? '1' : '';
	update_post_meta($post_id, '_resource_locked', $resource_locked);

	// Save Resource Coming Soon.
	$resource_coming_soon = isset($_POST['resource_coming_soon']) ? '1' : '';
	update_post_meta($post_id, '_resource_coming_soon', $resource_coming_soon);
}
add_action('save_post', 'ers_save_resources_meta_box');

