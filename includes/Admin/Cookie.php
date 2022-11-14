<?php
namespace Tnc\Admin;

class Cookie {
    /**
     * Setting cookie duration
     *
     * @return int
     */
    private function cookie_duration() {
        $duration = get_option( 'tnc_duration' ) ?? 30;
        return ( time() + 60 * 60 * 24 * (int) $duration );
    }

    /**
     * Setting cookie value
     *
     * @param string cookie filed
     * @return string
     */
    private function cookie_value() {
        $url_param = filter_input( INPUT_GET, 'cookie', FILTER_SANITIZE_URL );

        if( isset( $url_param ) ) {
            return $url_param;
        }

        return;
    }

    /**
     * Setting cookie after login
     *
     * @param string cookie filed
     * @return void
     */
    public function set_cookie() {
        if( $this->cookie_value() ) {
            setcookie( 'tnc__agreement', $this->cookie_value(), $this->cookie_duration(), '/' );
        }
    }

}
