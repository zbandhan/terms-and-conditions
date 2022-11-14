<?php
namespace Tnc\Admin;

class Redirect
{
    public function __construct() {
        add_action( 'admin_init', [ $this, 'redirect_enforcing_agreement' ] );
        add_action( 'template_redirect', [ $this, 'redirect_enforcing_agreement' ] );
    }

    /**
     * Redirect to agreement page
     *
     * @return string
     */
    public function redirect_enforcing_agreement() {
        if( ! empty( get_option( 'tnc_page' ) ) ) {
            if ( ! is_page( get_option( 'tnc_page' ) )
                && empty( $_COOKIE['tnc__agreement'] )
                && is_user_logged_in() ) {
                wp_redirect( get_the_permalink( get_option( 'tnc_page' ) ) );
                exit();
            }
        }
    }

}
