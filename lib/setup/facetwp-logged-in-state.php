<?php
/**
 * Force FacetWP to use the logged-in state.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
  Please note that caching may interfere with the NONCE,
  causing AJAX requests to fail. Please DISABLE CACHING for facet pages,
  or set the cache expiration to < 12 hours!
*/
 
add_action( 'wp_footer', function() {
  ?>
    <script>
      document.addEventListener('facetwp-loaded', function() {
        if (! FWP.loaded) { // initial pageload
          FWP.hooks.addFilter('facetwp/ajax_settings', function(settings) {
            settings.headers = { 'X-WP-Nonce': FWP_JSON.nonce };
            return settings;
          });
        }
      });
    </script>
  <?php
}, 100 );