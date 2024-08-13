<?php
/**
 * Get the post thumbnail url.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function ers_get_post_thumbnail_url( $id ) {

	if ( ! $id ) {
		$id = get_the_ID();
	}

	// Define the cache key using the actual post ID
	$cache_key = 'resource_' . $id . '_thumb';

	// Check if the post has a featured image
	$background = get_the_post_thumbnail_url( $id, 'large' );

	// If there's a featured image, return it without checking the cache
	if ( $background ) {		
		return $background;
	}

	// If no featured image, try to get the cached version
	$background = get_transient( $cache_key );

	// If there's a cached version, return it
	if ( $background ) {
		return $background;
	}

	// Get the content of the current post
	$post_content = get_the_content();

	// Define the regular expression pattern to match both standard and shortened YouTube URLs
	$pattern = '/https?:\/\/(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)|https?:\/\/youtu\.be\/([a-zA-Z0-9_-]+)/';

	// Search for the first match in the post content
	if ( preg_match( $pattern, $post_content, $matches ) ) {
		// Determine which capture group has the video ID
		$video_id = !empty( $matches[1] ) ? $matches[1] : $matches[2];

		// Try to get the best available thumbnail, prioritizing larger images
		$thumbnail_urls = [
			'https://img.youtube.com/vi/' . $video_id . '/maxresdefault.jpg', // 1280x720
			'https://img.youtube.com/vi/' . $video_id . '/sddefault.jpg',    // 640x480
			'https://img.youtube.com/vi/' . $video_id . '/hqdefault.jpg',    // 480x360
			'https://img.youtube.com/vi/' . $video_id . '/mqdefault.jpg',    // 320x180
			'https://img.youtube.com/vi/' . $video_id . '/default.jpg'       // 120x90
		];

		// Loop through the possible thumbnails and check if they exist
		foreach ( $thumbnail_urls as $url ) {
			$response = wp_remote_head( $url );
			if ( !is_wp_error( $response ) && $response['response']['code'] == 200 ) {
				$background = $url;
				// Cache the YouTube thumbnail URL
				set_transient( $cache_key, $background, 720 * MINUTE_IN_SECONDS );
				break;
			}
		}
		
		return $background;
	}

	return false; // Return false if no thumbnail or video ID is found
}
