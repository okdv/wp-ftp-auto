<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://otho.dev
 * @since      1.0.0
 *
 * @package    Wp_Ftp_Auto
 * @subpackage Wp_Ftp_Auto/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Ftp_Auto
 * @subpackage Wp_Ftp_Auto/admin
 * @author     Otho DuBoise <okd@otho.dev>
 */
class Wp_Ftp_Auto_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	private $cipher;
	private $key;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	public function __construct( $plugin_name, $version ) {

		require(get_home_path() . "wp-config.php");

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->cipher = "AES-128-CBC";
		$this->key = AUTH_KEY;
		$iv_len = openssl_cipher_iv_length($this->cipher);
		// generated string is 2x longer than length
		// more compatible alternative to openssl_random_pseudo_bytes
		$this->iv = bin2hex(random_bytes($iv_len / 2)); 
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-ftp-auto-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-ftp-auto-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the admin menu item.
	 *
	 * @since    1.0.0
	 */
	public function admin_menu() {
		add_menu_page( "FTP Automation Admin", "FTP Automation", "manage_options", "wp-ftp-auto", array($this,'admin_menu_page'));
	}

	/**
	 * Register the admin area.
	 * Not a hook
	 *
	 * @since    1.0.0
	 */
	public function admin_menu_page() {
		include(plugin_dir_path( __FILE__ ) . "partials/wp-ftp-auto-admin-display.php");
	}

	/**
	 * Process admin form for scheduling job.
	 *
	 * @since    1.0.0
	 */
	public function process_form() {
		$interval = $_POST["interval"];
		$time = strtotime($_POST["datetime"]);
		$hook = $_POST["job-type"];

		$creds = $_POST["username"] . "::" . $_POST["password"];
		$encrypted = openssl_encrypt($creds,$this->cipher,$this->key,0,$this->iv);

		$args = array($_POST["job-id"],$_POST["server"],$encrypted,$this->iv,$_POST["local-filename"],$_POST["server-path"]);

		if ($interval === "once") {
			wp_schedule_single_event( $time, $hook, $args );
		} else {
			wp_schedule_event( $time, $interval, $hook, $args);
		}
		wp_redirect( admin_url("admin.php?page=wp-ftp-auto"));
		die();
	}

	/**
	 * FTP Import event.
	 *
	 * @since    1.0.0
	 */
	public function ftp_import($id,$server,$encrypted,$iv,$filename,$path) {
		$creds = $this->decrypt($encrypted,$iv);
		$u = $creds[0];
		$pw = $creds[1];
		if ($conn = ftp_connect($server)) {
			if (ftp_login($conn,$u,$pw)) {
				ftp_pasv($conn,true);
				ftp_set_option($conn,FTP_TIMEOUT_SEC,120);
				ftp_get($conn, WP_CONTENT_DIR . "/uploads/wp-ftp-auto/import/" . $filename,$path, FTP_BINARY);
				ftp_close($conn);
			}
		}
	}

	/**
	 * FTP Export event.
	 *
	 * @since    1.0.0
	 */
	public function ftp_export($id,$server,$encrypted,$iv,$filename,$path) {
		$creds = $this->decrypt($encrypted,$iv);
		$u = $creds[0];
		$pw = $creds[1];
		if ($conn = ftp_connect($server)) {
			if (ftp_login($conn,$u,$pw)) {
				ftp_pasv($conn,true);
				ftp_set_option($conn,FTP_TIMEOUT_SEC,120);
				ftp_put($conn,$path,WP_CONTENT_DIR . "/uploads/wp-ftp-auto/export/" . $filename, FTP_BINARY);
				ftp_close($conn);
			}
		}
	}

	/**
	 * Encrypt using openSSL.
	 * 
	 * Not a hook
	 *
	 * @since    1.0.0
	 */
	public function encrypt($data,$iv) {
		return openssl_encrypt($data,$this->cipher,$this->key,0,$iv);
	}

	/**
	 * Decrypt using openSSL.
	 * 
	 * Not a hook
	 * 
	 * @since    1.0.0
	 */
	public function decrypt($data,$iv) {
		return explode("::",openssl_decrypt($data,$this->cipher,$this->key,0,$iv));
	}

}
