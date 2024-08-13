<?php

function ers_token_shortcode() {
    // Ensure that the session is started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Get the session ID
    $session_id = session_id();

    // Return the session ID
    return esc_html($session_id);
}

// Register the shortcode in WordPress
add_shortcode('ers_token', 'ers_token_shortcode');
