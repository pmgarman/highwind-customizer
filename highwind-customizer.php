<?php
/**
 * Plugin Name: Highwind Customizer
 * Plugin URI: https://pmgarman.me/
 * Description: Customize your Highwinds.
 * Version: 1.0.0
 * Author: Patrick Garman
 * Author URI: https://pmgarman.me
 * Text Domain: balanced-payments
 * Domain Path: /languages/
 * License: GPLv2
 */

/**
 * Copyright 2014  Patrick Garman  (email: patrick@pmgarman.me)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

if( ! class_exists( 'Highwind_Customizer' ) ) {
	// Required File (s)
	require_once 'classes/class-highwind-customizer-admin.php';
	require_once 'classes/class-highwind-customizer.php';

	// Start the engines!
	global $Highwind_Customizer;
	$Highwind_Customizer = new Highwind_Customizer( __FILE__ );
	load_plugin_textdomain( 'highwind-customizer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
