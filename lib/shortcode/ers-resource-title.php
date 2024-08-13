<?php

function ers_resource_title_func( $atts ) {
	ob_start();
	
	$resource_id = ers_get_post_id_from_resourceid();
	
	if ( ! $resource_id ) {
		return 'This is a placeholder for the resource title. The resource ID is not set.';
	}
	
	$title = get_the_title( $resource_id);

	echo esc_html( apply_filters( 'ers_resource_filter_title', $title ) );
	
	return ob_get_clean();
}
add_shortcode( 'ers_resource_title', 'ers_resource_title_func' );