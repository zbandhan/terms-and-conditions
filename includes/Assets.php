<?php
namespace Tnc;

class Assets {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'asset_style' ] );

    }

    /**
     * Enqueuing CSS Style
     *
     * @return void
     */
    public function asset_style() {
        wp_enqueue_style( 'redirect-style', plugin_dir_url(__DIR__) . 'assets/css/redirect.css' );
    }

}
