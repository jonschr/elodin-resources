<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// Fetch the token and expiration timestamp from the URL
$token = $_GET['resourcetoken'] ?? '';
$expires = $_GET['expires'] ?? '';

if (!$token || !$expires) {
	echo "Invalid or missing token or expiration timestamp.<br>";
	return false;
}

// Check if the token is valid and not expired
if ($token && $expires && time() < $expires) {

	// Define the cookie parameters
	$cookie_name = "resourcetoken";
	$cookie_value = $token;
	$cookie_expire = time() + 10800; // Expiry timestamp (3 hours)
	$cookie_path = "/"; // The path on the server in which the cookie will be available
	$cookie_domain = $_SERVER['HTTP_HOST']; // The domain that the cookie is available to
	$secure = isset($_SERVER['HTTPS']); // Ensure cookie is only sent over HTTPS
	$httponly = true; // Prevent JavaScript access to the cookie

	// Set the cookie with the Secure flag
	$cookie_set = setcookie($cookie_name, $cookie_value, $cookie_expire, $cookie_path, $cookie_domain, $secure, $httponly);
	
	// Debugging output for parameters
	echo "Debug Information:<br>";
	echo "Cookie Name: " . $cookie_name . "<br>";
	echo "Cookie Value: " . $cookie_value . "<br>";
	echo "Cookie Expiry: " . date('Y-m-d H:i:s', $cookie_expire) . " (Timestamp: $cookie_expire)<br>";
	echo "Cookie Path: " . $cookie_path . "<br>";
	echo "Cookie Domain: " . $cookie_domain . "<br>";
	echo "Secure Flag: " . ($secure ? 'Yes' : 'No') . "<br>";
	echo "HttpOnly Flag: " . ($httponly ? 'Yes' : 'No') . "<br>";

	if ($cookie_set) {
		echo "Attempted to set cookie successfully.<br>";
		
		// Construct the redirect URL dynamically
		$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
		$host = $_SERVER['HTTP_HOST'];
		$redirect_url = $protocol . $host . '/resources/?cachebuster=' . time();
		
		echo "Redirect URL: " . $redirect_url . "<br>";

		// Redirect to the resources page
		header("Location: $redirect_url");
		exit;
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
	echo "Token is either invalid or expired.<br>";
	return false;
}
