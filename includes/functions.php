<?php
    /**
     * Setting cookie duration
     *
     * @return int
     */
    function tnc_cookie_duration() {
        $duration = get_option( 'tnc_duration' ) ?? 30;
        return ( time() + 60 * 60 * 24 * (int) $duration );
    }

    /**
     * Setting cookie value
     *
     * @return string
     */
    function tnc_cookie_value( $cookie_val ) {
        $url_param = filter_input( INPUT_GET, $cookie_val, FILTER_SANITIZE_URL );

        if( ! empty( $url_param ) ) {
            return $url_param;
        }
    }

    /**
     * Setting cookie after login
     *
     * @return void
     */
    function tnc_cookie_set( $cookie_val ) {
        setcookie( 'tnc__agreement', tnc_cookie_value( $cookie_val ), tnc_cookie_duration(), '/' );
    }
