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
		$id = get_the_ID();
		$access_link = '';
		
		if ( $title ) {
			printf( '<h1 class="resource-title">%s</h1>', esc_html( $title ) );
		}
		
		// Get the timestamp for the last modified date
		$last_modified_timestamp = get_the_modified_time('U');

		// Get the current timestamp
		$current_timestamp = current_time('timestamp');

		// Calculate the time difference and format it
		$relative_time = human_time_diff($last_modified_timestamp, $current_timestamp);
		
		if ( $id && is_user_logged_in() ) {
			$access_link = sprintf( '· <a class="access-link" href="/access/?resourceid=%s" target="_blank">View access page</a>', esc_html( $id ) );
		}

		// Output the relative time using printf
		printf('<p>Last edited %s ago %s</p>', esc_html($relative_time), $access_link );
		
		if ( $content ) {
			printf( '<div class="resource-content">%s</div>', apply_filters( 'the_content', $content ) );
		}
	
echo '</div>';

get_footer();