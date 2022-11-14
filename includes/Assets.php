<?php
namespace Tnc;

class Assets {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'tnc_assets' ] );

    }

    /**
     * Enqueuing CSS Style
     *
     * @return void
     */
    public function tnc_assets() {
        wp_enqueue_style( 'tnc-style', plugin_dir_url( __DIR__ ) . 'assets/css/style.css' );
        wp_enqueue_script( 'tnc-script', plugin_dir_url( __DIR__ ) . 'assets/js/scripts.js', [ 'jquery' ], '0.1', true );

        wp_localize_script( 'tnc-script', 'tnc_redirect_admin', [
            'tnc_redirect'  => admin_url()
        ]);
    }

}
