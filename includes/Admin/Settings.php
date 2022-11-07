<?php
namespace Tnc\Admin;

class Settings {

    public function __construct() {
        add_action( 'admin_init', [ $this, 'agreement_options' ] );
    }

    public function agreement_options() {
        // register a setting
        register_setting( 'general', 'tnc_duration' );
        register_setting( 'general', 'tnc_page' );

        // register a section
        add_settings_section(
            'tnc_section',
            __( 'Terms and Condition Section', 'tnc' ),
            [ $this, 'tnc_section_callback' ],
            'general'
        );

        // Add a number input field
        add_settings_field(
            'tnc_days',
            __('Days', 'tnc'),
            [ $this, 'tnc_days_field_callback' ],
            'general',
            'tnc_section'
        );

        // Add setting for select input filed for pages
        add_settings_field(
            'tnc_pages',
            __( 'Agreement page', 'tnc' ),
            [ $this, 'tnc_pages_callback' ],
            'general',
            'tnc_section'
        );
    }

    // section content cb
    public function tnc_section_callback() {}

    // field content cb
    public function tnc_days_field_callback() {
        $tnc_days = get_option( 'tnc_duration' );
        ?>
            <input
                type="number"
                name="tnc_duration"
                value="<?php echo esc_attr( $tnc_days ); ?>"
                placeholder="Enter a cookie duration"
            />
        <?php
    }

    public function tnc_pages_callback() {
        $tnc_selected = get_option( 'tnc_page' );
        ?>
        <select name="tnc_page" id="tnc_page">
            <option value="" disabled selected><?php esc_html_e( 'Select an agreement page', 'tnc' ); ?></option>
            <?php
                foreach ( get_pages() as $tnc_page ) {
                ?>
                    <option value="<?php esc_attr_e( $tnc_page->ID, 'tnc'); ?>" <?php selected( $tnc_selected, $tnc_page->ID ); ?>>
                        <?php  esc_html_e( $tnc_page->post_title ); ?>
                    </option>
                <?php
                }
            ?>
        </select>
        <?php
    }

}
