<?php
/**
* Plugin Name:       Terms and Conditions
* Plugin URI:        https://example.com/pluginName
* Description:       Description of the plugin.
* Version:           1.0.5
* Requires at least: 5.2
* Requires PHP:      7.2
* Author:            Zulfikar
* Author URI:        https://example.com
* License:           GPL v2 or later
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       tnc
* Domain Path:       /languages
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Including psr-4 autoloading file
require_once __DIR__ . "/vendor/autoload.php";

final class TNC {
    private static $_instance = null;

    const VERSION = '1.0.5';

    private function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'tnc_settings_link' ] );

    }
    private function __wakeup() {}
    public function __clone() {}

    /**
     * Run first when plugin loaded
     *
     */
    public function init_plugin() {
        new \Tnc\Assets();
        new \Tnc\Admin\Settings();
        new \Tnc\Admin\Button();
        new \Tnc\Admin\Redirect();
    }

    /**
     * Singleton initialized
     *
     * @return object
     */
    public static function init()
    {
        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Link to setting area from plugin page.
     *
     * @param array $setting
     * @return array
     */
    public function tnc_settings_link( $setting ) {
        $setting[] = '<a href="' .
            admin_url( 'options-general.php#wpfooter' ) .'">' . __( 'Settings', 'tnc' ) . '</a>';
        return $setting;
    }

}

TNC::init();
