<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Frontend class for Highwind Customizer plugin
 *
 * @package WordPress
 *
 * @subpackage Project
 */
class Highwind_Customizer {

	/**
	 * Construct function
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'setup_highwind' ) );
	}

	/**
	 * Add Highwind actions/filters
	 */
	public function setup_highwind() {
		// Load CMB
		if ( ! class_exists( 'cmb_Meta_Box' ) ) {
			require_once 'cmb/init.php';
		}
		
		// Footer
		remove_action( 'highwind_footer', 'highwind_credit', 20 );
		add_action( 'highwind_footer', array( $this, 'custom_highwind_credit' ),    11 );
		add_action( 'highwind_footer', array( $this, 'custom_highwind_copyright' ), 12 );

		// Maybe remove custom gravatar
		$gravatar = get_highwind_option( 'gravatar' );

		if( 'on' !== $gravatar ) {
			add_filter( 'highwind_header_gravatar', '__return_false' );
		}
	}

	/**
	 * Custom footer section
	 */
	public function custom_highwind_credit() {
		$credit = get_highwind_option( 'footer-text' );

		if( ! empty( $credit ) ) {
			echo wpautop( $credit );
		} else {
			highwind_credit();
		}
		
	}

	/**
	 * Custom footer section
	 */
	public function custom_highwind_copyright() {
		$copyright = get_highwind_option( 'copyright' );

		if( 'on' === $copyright ) {
			echo '<div style="clear:both;"></div>';
			echo sprintf( '<p style="float:none;">&copy; %1$s %2$s</p>', date( 'Y' ), get_bloginfo( 'name' ) );
		}
		
	}

	
}