<?php
    // Load WordPress and a few functions
    include_once dirname(__DIR__, 4) . '/wp-load.php';
    include_once dirname(__FILE__) . '/functions.php';

    // Set cookie for user's acceptance and duration tracing.
    tnc_cookie_set( 'cookie' );

    // Redirect to Admin
    wp_safe_redirect( admin_url() );
    exit;