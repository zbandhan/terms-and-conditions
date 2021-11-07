<?php
namespace Tnc\Admin;

class Redirect {

    private $cookie_checking;
    private $redirecting_url;
    private $modified_time;

    public function __construct() {

        // Assigning property value
        $this->cookie_checking = ( $_COOKIE[ 'redirect' ] != '' ) ? $_COOKIE[ 'redirect' ] : '';
        $this->redirecting_url = filter_input( INPUT_GET, 'redirect', FILTER_SANITIZE_URL );
        $this->modified_time = get_the_modified_time( 'G', get_option( 'tnc_page_selection' ) );

        // Hooks
        if ( $this->cookie_checking != $this->modified_time ) {
            add_filter( 'login_redirect', [ $this, 'redirect_to_tnc' ] );

        }
        add_filter( 'the_content', [ $this, 'tnc_agreement_buton' ] );

        if ( get_option( 'tnc_page_selection' ) != false ) {
            add_action( 'init', [ $this, 'redirect_to_admin' ], 1 );
        }

    }

    /**
     * Agree Button
     *
     * @return $content
     */
    public function tnc_agreement_buton( $content ) {

        ob_start(); ?>

        <a href="<?php echo get_the_permalink() . "?redirect=" . get_the_modified_time( 'G' ); ?>"
        class="redirect-btn"><?php esc_html_e( 'Agree', 'tnc' ); ?></a>

        <?php
        $button = ob_get_clean();

        if ( is_page( get_option( 'tnc_page_selection' ) ) ) {
            return $content . $button;
        }

        return $content;

    }

    /**
     * Redirect to specific page
     *
     * @return string
     */
    public function redirect_to_tnc() {
        // Redirection to terms and conditons
        return get_the_permalink( get_option( 'tnc_page_selection' ) );
    }

    /**
     * Redirecting to admin area
     *
     * @return void
     */
    public function redirect_to_admin() {

        $days = get_option( 'tnc_redirect_setting' );

        if ( $this->redirecting_url == $this->modified_time ) {

            // Setting cookie for agreement
            setcookie( 'redirect', $this->redirecting_url, time() + 60 * 60 * 24 * $days, '/' );
            // update duration for further check
            update_option( 'tnc_cookie_duration', $days );

            // Redirect to admin area
            wp_redirect( admin_url() );
            exit;

        } elseif ( $days != get_option( 'tnc_cookie_duration' ) ) {
            update_option( 'tnc_cookie_duration', $days );
            unset( $_COOKIE[ 'redirect' ] );
            setcookie( 'redirect', $this->modified_time, time() + 60 * 60 * 24 * $days, '/' );
        }

    }

}
