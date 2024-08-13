<?php
/**
 * Get the post ID from the resource ID.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Get the post ID from the resource ID.
 *
 * @return  int The post ID.
 */
function ers_get_post_id_from_resourceid() {
	if ( isset($_GET['resourceid']) ) {
		$resource_id = $_GET['resourceid'];
	} else {
		return false;
	}
	
	return (int) $resource_id;
}
