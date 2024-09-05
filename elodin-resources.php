<?php
/*
	Plugin Name: Elodin Resources
	Plugin URI: https://elod.in
    Description: Just another plugin
	Version: 0.3.1
    Author: Jon Schroeder
    Author URI: https://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/


/* Prevent direct access to the plugin */
if ( !defined( 'ABSPATH' ) ) {
    die( "Sorry, you are not allowed to access this page directly." );
}

// Plugin directory
define( 'ELODIN_RESOURCES', dirname( __FILE__ ) );

// Define the version of the plugin
define ( 'ELODIN_RESOURCES_VERSION', '0.3.1' );

// Set up plugin directories.
define( 'ELODIN_RESOURCES_DIR', plugin_dir_path( __FILE__ ) );
define( 'ELODIN_RESOURCES_PATH', plugin_dir_url( __FILE__ ) );
define( 'ELODIN_RESOURCES_BASENAME', plugin_basename( __FILE__ ) );
define( 'ELODIN_RESOURCES_FILE', __FILE__ );

/**
 * Load the files
 *
 * @param   string $directory  the path to the directory to load.
 * @return  void
 */
function ers_require_files_recursive( $directory ) {
	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $directory, RecursiveDirectoryIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ( $iterator as $file ) {
		if ( $file->isFile() && $file->getExtension() === 'php' ) {
			require_once $file->getPathname();
		}
	}
}

// Require_once all files in /lib and its subdirectories.
ers_require_files_recursive( ELODIN_RESOURCES_DIR . 'lib' );

// Load Plugin Update Checker.
require ELODIN_RESOURCES_DIR . 'vendor/plugin-update-checker/plugin-update-checker.php';
$update_checker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/elodin-resources',
	__FILE__,
	'elodin-resources'
);

// Optional: Set the branch that contains the stable release.
$update_checker->setBranch( 'main' );