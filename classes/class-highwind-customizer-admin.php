<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Admin class for Highwind Customizer plugin
 *
 * @package WordPress
 *
 * @subpackage Project
 */
class Highwind_Customizer_Admin {

	// A single instance of this class.
	public static $instance         = null;
	public static $key              = 'highwind-customizer';
	public static $title            = '';
	public static $site_options     = array();

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @since  1.0.0
	 *
	 * @return Highwind_Customizer_Admin A single instance of this class.
	 */
	public static function go() {
		if( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initiate our hooks
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		self::$title = __( 'Highwind Options', 'highwind-customizer' );

		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_page' ) );
	}

	/**
	 * Register our setting to WP
	 *
	 * @since 1.0.0
	 */
	public function init() {
		register_setting( self::$key, self::$key );
	}

	/**
	 * Add menu options page
	 *
	 * @since 1.0.0
	 */
	public function add_page() {
		$this->options_page = add_theme_page( self::$title, self::$title, 'manage_options', self::$key, array( $this, 'admin_page' ) );
		add_action( 'admin_head-' . $this->options_page, array( $this, 'admin_head' ) );
	}

	/**
	 * CSS
	 *
	 * @since 1.0.0
	 */
	public function admin_head() { ?>
		<style type="text/css">
		.cmb-form .button-primary {
			margin: 48px 0 0 8px;
		}
		</style>
	<?php }

	/**
	 * Admin page markup. Mostly handled by CMB
	 *
	 * @since 1.0.0
	 */
	public function admin_page() { ?>
		<div class="wrap cmb_options_page <?php echo self::$key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php // Check for CMB
			if( class_exists( 'cmb_Meta_Box' ) ) {
				cmb_metabox_form( $this->option_fields(), self::$key );
			} ?>
		</div>
	<?php }

	/**
	 * Defines the site option metabox and field configuration
	 *
	 * @since  1.0.0
	 *
	 * @return array
	 */
	public static function option_fields() {

		// Only need to initiate the array once per page-load
		if ( ! empty( self::$site_options ) ) {
			return self::$site_options;
		}

		self::$site_options = array(
			'id'         => 'site_options',
			'show_on'    => array( 'key' => 'options-page', 'value' => array( self::$key, ), ),
			'show_names' => true,
			'cmb_styles' => false,
			'fields'     => array(
				array(
					'name' => __( 'Disable Header Gravatar'),
					'id'   => 'disable-gravatar',
					'type' => 'checkbox'
				),
				array(
					'name' => __( 'Footer Text'),
					'id'   => 'footer-text',
					'type' => 'wysiwyg'
				),
				array(
					'name' => __( 'Add Generic Copyright'),
					'id'   => 'copyright',
					'type' => 'checkbox'
				),
			)
		);

		return self::$site_options;

	}

	/**
	 * Make public the protected $key variable.
	 *
	 * @since  1.0.0
	 *
	 * @return string  Option key
	 */
	public static function key() {
		return self::$key;
	}

}

global $Highwind_Customizer_Admin;
$Highwind_Customizer_Admin = new Highwind_Customizer_Admin();

/**
 * Wrapper function around cmb_get_option
 *
 * @since  1.0.0
 *
 * @param  string  $key Options array key
 *
 * @return mixed        Option value
 */
function get_highwind_option( $key = '' ) {
	return cmb_get_option( Highwind_Customizer_Admin::key(), $key );
}
