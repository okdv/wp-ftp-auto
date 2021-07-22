<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://otho.dev
 * @since      1.0.0
 *
 * @package    Wp_Ftp_Auto
 * @subpackage Wp_Ftp_Auto/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Ftp_Auto
 * @subpackage Wp_Ftp_Auto/includes
 * @author     Otho DuBoise <okd@otho.dev>
 */
class Wp_Ftp_Auto_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-ftp-auto',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
