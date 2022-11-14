<?php
namespace Tnc\Admin;

class Button {
    /**
     * Composing cookie into button class
     *
     * @var Cookie
     */
    private $cookie;

    public function __construct( Cookie $cookie ) {
        $this->cookie = $cookie;

        add_filter( 'the_content', [ $this, 'button_in_page' ] );
    }

    /**
     * Agree Button
     *
     * @return $button
     */
    private function button() {
        // Set cookie in agreement submission
        $this->cookie->set_cookie();

        ob_start(); ?>
            <form action="" method="get">
                <input type="hidden" name="cookie" id="cookie" value="<?php echo md5( get_option( 'tnc_page' ) ); ?>" />
                <button type="submit" class="redirect-btn">Agree</button>
            </form>
        <?php
        $button = ob_get_clean();

        return $button;
    }

    /**
     * Set Agree Button in the selected page
     *
     * @return $content
     */
    public function button_in_page( $content ) {
        if ( is_page( get_option( 'tnc_page' ) ) ) {
            return $content . $this->button();
        }

        return $content;
    }
}
