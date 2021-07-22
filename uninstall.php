<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://otho.dev
 * @since      1.0.0
 *
 * @package    Wp_Ftp_Auto
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

function delete_dir($dir) {
    if(is_dir($dir)) {
        $objs = scandir($dir);
        foreach($objs as $obj) {
            if ($obj != "." && $obj != "..") {
                $obj_path = $dir."/".$obj;
                if (filetype($obj_path) == "dir") {
                    delete_dir($obj_path);
                } else {
                    unlink($obj_path);
                }
            }
        }
        reset($objs);
        rmdir($dir);
    }
}

if (defined('WP_FTP_AUTO_DIRS')) {
	delete_dir(WP_FTP_AUTO_DIRS[0]);
} else {
    delete_dir(WP_CONTENT_DIR . "/uploads/wp-ftp-auto/");
}