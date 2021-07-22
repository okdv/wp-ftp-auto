<?php

/**
 * Fired during plugin activation
 *
 * @link       https://otho.dev
 * @since      1.0.0
 *
 * @package    Wp_Ftp_Auto
 * @subpackage Wp_Ftp_Auto/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Ftp_Auto
 * @subpackage Wp_Ftp_Auto/includes
 * @author     Otho DuBoise <okd@otho.dev>
 */
class Wp_Ftp_Auto_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		if (defined('WP_FTP_AUTO_DIRS')) {
			foreach (WP_FTP_AUTO_DIRS as $dir) {
				is_dir($dir) || wp_mkdir_p( $dir );
			}
		}
	}


}
