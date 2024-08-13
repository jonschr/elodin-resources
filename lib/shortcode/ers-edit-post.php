<?php

function ers_edit_resource_func( $atts ) {
	ob_start();
	
	$resource_id = ers_get_post_id_from_resourceid();
	
	if ( ! $resource_id ) {
		return;
	}
	
	edit_post_link( 'Edit this resource', '<p>', '</p>', $resource_id );
	
	return ob_get_clean();
}
add_shortcode( 'ers_edit_resource', 'ers_edit_resource_func' );