<?php
/**
 * Single resources template.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

echo '<div class="single-resources-wrap">';
	
		$title = get_the_title();
		$content = get_the_content();
		
		if ( $title ) {
			printf( '<h1 class="resource-title">%s</h1>', esc_html( $title ) );
		}
		
		// Get the timestamp for the last modified date
		$last_modified_timestamp = get_the_modified_time('U');

		// Get the current timestamp
		$current_timestamp = current_time('timestamp');

		// Calculate the time difference and format it
		$relative_time = human_time_diff($last_modified_timestamp, $current_timestamp);

		// Output the relative time using printf
		printf('<p>Last edited %s ago</p>', esc_html($relative_time));
		
		if ( $content ) {
			printf( '<div class="resource-content">%s</div>', apply_filters( 'the_content', $content ) );
		}
	
echo '</div>';

get_footer();