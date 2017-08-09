<?php
/*
 * Plugin Name: Exit Notifier
 * Version: 1.4.2
 * Plugin URI: http://cvstech.com/exit-notifier
 * Description: Pops up a notice when someone clicks a link that takes them away from your site.
 * Author: Curtis V. Schleich
 * Author URI: http://www.cvstech.com/
 * Requires at least: 4.0
 * Tested up to: 4.8
 *
 * @package WordPress
 * @author Curtis V. Schleich
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-exit-notifier.php' );
require_once( 'includes/class-exit-notifier-settings.php' );

// Load plugin libraries
require_once( 'includes/lib/class-exit-notifier-admin-api.php' );
require_once( 'includes/lib/class-exit-notifier-post-type.php' );
require_once( 'includes/lib/class-exit-notifier-taxonomy.php' );

/**
 * Returns the main instance of Exit_Notifier to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Exit_Notifier
 */
function Exit_Notifier () {
	$instance = Exit_Notifier::instance( __FILE__, '1.4.2' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = Exit_Notifier_Settings::instance( $instance );
	}

	return $instance;
}

Exit_Notifier();