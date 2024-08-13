<?php
/**
 * Everything dealing directly with the cookie.
 *
 * @package ers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Set the cookie status.
 *
 * @return  bool False if the cookie wasn't set.
 */
function ers_set_cookie() {
	
	// Fetch the token and expiration timestamp from the URL
	$token = $_GET['resourcetoken'] ?? '';
	$expires = $_GET['expires'] ?? '';
	
	if ( !$token || !$expires) {
		return false;
	}
	
	// Check if the token is valid and not expired
	if ( $token && $expires && time() < $expires ) {

		// // Set a cookie if the token is valid
		// setcookie("resourcetoken", $token, time() + 10800, "/"); // 3-hour expiration
		
		// // Because the cookie can't be checked properly until the next page load, we need to redirect to the same page
		// $redirect_url = home_url( '/resources/' );
		// wp_redirect($redirect_url);
		
		// Define the cookie parameters
		$cookie_name = "resourcetoken";
		$cookie_value = $token;
		$cookie_expire = time() + 10800; // Expiry timestamp
		$cookie_path = "/"; // The path on the server in which the cookie will be available
		$cookie_domain = $_SERVER['HTTP_HOST']; // The domain that the cookie is available to
		$secure = isset($_SERVER['HTTPS']); // Ensure cookie is only sent over HTTPS
		$httponly = true; // Prevent JavaScript access to the cookie

		// Debugging output for parameters
		echo "Cookie Name: " . $cookie_name . "<br>";
		echo "Cookie Value: " . $cookie_value . "<br>";
		echo "Cookie Expiry: " . date('Y-m-d H:i:s', $cookie_expire) . " (Timestamp: $cookie_expire)<br>";
		echo "Cookie Path: " . $cookie_path . "<br>";
		echo "Cookie Domain: " . $cookie_domain . "<br>";
		echo "Secure Flag: " . ($secure ? 'Yes' : 'No') . "<br>";
		echo "HttpOnly Flag: " . ($httponly ? 'Yes' : 'No') . "<br>";

		// Set the cookie with the Secure flag
		$cookie_set = setcookie($cookie_name, $cookie_value, $cookie_expire, $cookie_path, $cookie_domain, $secure, $httponly);

		if ($cookie_set) {
			echo "Attempted to set cookie successfully.<br>";
		} else {
			echo "Failed to set the cookie. Possible reasons:<br>";
			echo "- Headers might have been sent before this cookie was set.<br>";
			echo "- There could be an issue with the domain or path.<br>";
			echo "- Check if HTTPS is required and if it's being used correctly.<br>";
		}

		// Check if the cookie is set in subsequent requests
		if (isset($_COOKIE[$cookie_name])) {
			echo "Cookie '" . $cookie_name . "' is set! Value: " . $_COOKIE[$cookie_name] . "<br>";
		} else {
			echo "Cookie '" . $cookie_name . "' is not set in the current request.<br>";
		}


	} else {
		return false;
	}
}
// add_action( 'plugins_loaded', 'ers_set_cookie' );

/**
 * Check the cookie status.
 *
 * @return  string The cookie status.
 */
function ers_get_cookie_auth_status() {
	
	$cookie_auth_status = 'locked';
	
	if ( isset( $_COOKIE['resourcetoken'] ) ) {
		$cookie_auth_status = 'unlocked';
	}
	
	return $cookie_auth_status;
}