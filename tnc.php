<?php
/**
* @package           PluginPackage
* @author            Zulfikar
* @copyright         2020 Zulfikar
* @license           GPL-2.0-or-later
*
* @wordpress-plugin
* Plugin Name:       Terms and Conditions Plugin
* Plugin URI:        https://example.com/pluginName
* Description:       Description of the plugin.
* Version:           1.0.0
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

function init_tnc_plugin() {
    new \Tnc\Assets();
    new \Tnc\Admin\Settings();
    new \Tnc\Admin\Redirect();
}
add_action( 'plugins_loaded', 'init_tnc_plugin' );

function tnc_settings_link( $links ) {
    $links[] = '<a href="' .
        admin_url( 'options-general.php#wpfooter' ) .'">' . __( 'Settings', 'tnc' ) . '</a>';
    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'tnc_settings_link' );
