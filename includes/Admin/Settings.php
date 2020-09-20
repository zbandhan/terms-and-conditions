<?php
namespace Tnc\Admin;

class Settings {
    
    public function __construct() {

        add_action( 'admin_init', [ $this, 'redirect_setting_option' ] );
    }

    public function redirect_setting_option() {
        // register a redirect setting
        register_setting('general', 'tnc_redirect_setting');
        register_setting('general', 'tnc_page_selection');
     
        // register a redirect section
        add_settings_section(
            'tnc_settings_section',
            'Terms and Condition Section', [ $this, 'tnc_settings_section_callback' ],
            'general'
        );
     
        // register a redirect field
        add_settings_field(
            'tnc_settings_field',
            'Add Tnc Days',
            [ $this, 'tnc_settings_field_callback' ],
            'general',
            'tnc_settings_section'
        );

        // Register redirect page field
        add_settings_field(
            'tnc_settings_page',
            'Add a page for Terms and Conditions',
            [ $this, 'tnc_settings_page_callback' ],
            'general',
            'tnc_settings_section'
        );
    }
     
    // section content cb
    public function tnc_settings_section_callback() {}
     
    // field content cb
    public function tnc_settings_field_callback() {

        $days_specification = get_option( 'tnc_redirect_setting' );

        if ( '' === $days_specification ) :
            update_option( 'tnc_redirect_setting', intval( 30 ) ); 
            update_option( 'tnc_cookie_duration', intval( 30 ) ); 
            ?>
            
            <input type="number" name="tnc_redirect_setting" value="<?php echo esc_attr( $days_specification ); ?>" placeholder="Enter your desired duration">

        <?php else: ?>

            <input type="number" name="tnc_redirect_setting" value="<?php echo esc_attr( $days_specification ); ?>" placeholder="Enter your desired duration">

        <?php 
        endif;
    }

    public function tnc_settings_page_callback() {

        global $wpdb;

        $tnc_pages = $wpdb->get_results( "SELECT ID, post_name FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status = 'publish'", 'ARRAY_A' );
        $page_specification = get_option( 'tnc_page_selection' );

        ?>
        <select name="tnc_page_selection" id="tnc_page_selection">
            <option value="" disabled selected><?php esc_html_e( 'Select Terms and Conditions page', 'tnc' ); ?></option>
            <?php
                foreach ( $tnc_pages as $tnc_page ) {
                ?>
                    <option value="<?php esc_attr_e( $tnc_page['ID'], 'tnc'); ?>" <?php selected( $page_specification, $tnc_page['ID'] ); ?>><?php  esc_html_e( get_the_title( $tnc_page['ID'] ) ); ?></option>
                <?php
                }
            ?>
        </select>

        <?php
    }

}
