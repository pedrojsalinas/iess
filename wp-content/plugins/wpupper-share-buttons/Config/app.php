<?php
/**
 * @since 3.40
 * @package WPUSB_App
 */

if ( ! defined( 'ABSPATH' ) ) {
	// Exit if accessed directly.
	exit;
}

class WPUSB_App {

	/**
	 * The short slug
	 *
	 * @var String
	 */
	const SLUG = 'wpusb';

	/**
	 * Plugin name
	 *
	 * @var String
	 */
	const NAME = 'WPUpper Share Buttons';

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since 2.0
	 * @since 3.32
	 * @return Void
	 */
	public static function uses( $class, $location ) {
		$locations = array(
			'View'       => 1,
			'Controller' => 1,
		);

		$extension = isset( $locations[ $location ] ) ? strtolower( $location ) . '.php' : 'php';
		$path      = "/{$class}.{$extension}";
		$file      = dirname( WPUSB_PLUGIN_FILE ) . '/' . $location . $path;

		if ( $location === 'Templates' ) {
			$file = WPUSB_Utils::get_template_located( $file, $path, $class );
		}

		require_once $file;
	}
}
