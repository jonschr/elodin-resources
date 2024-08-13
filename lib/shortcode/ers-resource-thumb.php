<?php

function ers_resource_thumbnail_func( $atts ) {
	
	ob_start();
	
	$resource_id = ers_get_post_id_from_resourceid();
	
	if ( ! $resource_id ) {
		return '<div class="resource-thumbnail"></div>';
	}
	
	$thumb_url = ers_get_post_thumbnail_url( $resource_id );
	
	$container = sprintf( '<div class="resource-thumbnail" style="background-image:url(%s);"></div>', $thumb_url );

	echo wp_kses_post( $container );
	
	return ob_get_clean();
}
add_shortcode( 'ers_resource_thumbnail', 'ers_resource_thumbnail_func' );