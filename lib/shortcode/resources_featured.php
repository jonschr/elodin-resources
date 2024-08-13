<?php

// [resources_featured foo="foo-value"]
function ers_shortcode_resources( $atts ) {
	$a = shortcode_atts( array(
		'posts_per_page' => -1,
		'post_class' => '',
		'wrap_class' => '',
		'columns' => 3,
	), $atts );

	ob_start();
	
	// Loop through the resources, and get the last 3.
	$args = array(
		'post_type' => 'resources',
		'posts_per_page' => $a['posts_per_page'],
	);

	// The Query
	$custom_query = new WP_Query( $args );

	// The Loop
	if ( $custom_query->have_posts() ) {
		
		echo '<div class="resources-wrap' . ' ' . esc_attr( $a['wrap_class'] ) . ' ' . 'columns-' . (int) $a['columns'] . '">';

			while ( $custom_query->have_posts() ) {
				
				$custom_query->the_post();
				printf( '<div class="%s"><div class="post-inner">', esc_attr( implode( ' ', get_post_class( esc_attr( $a['post_class'] . ' ' . 'resources-each' ) ) ) ) );
				
					do_action( 'ers_do_each_resource' );

				echo '</div></div>';

			}
		
		echo '</div>';
		
		// Restore postdata
		wp_reset_postdata();

	}
	
	
	return ob_get_clean();
}
add_shortcode( 'resources', 'ers_shortcode_resources' );