<?php

function ers_resource_excerpt_func( $atts ) {
	ob_start();
	
	$resource_id = ers_get_post_id_from_resourceid();
	
	if ( ! $resource_id ) {
		return apply_filters( 'the_content', 'This is a placeholder for the resource excerpt. The resource ID is not set. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.' );
	}
	
	$excerpt = get_the_excerpt( $resource_id);
	
	if ( ! $excerpt ) {
		return;
	}

	echo '<div class="resource-excerpt">';
		echo apply_filters( 'the_content', apply_filters( 'the_content', apply_filters( 'ers_resource_filter_excerpt', $excerpt ) ) );
	echo '</div>';
	
	return ob_get_clean();
}
add_shortcode( 'ers_resource_excerpt', 'ers_resource_excerpt_func' );