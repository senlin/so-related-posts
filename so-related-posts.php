<?php
/**
 * Plugin Name: SO Related Posts
 * Plugin URI: http://so-wp.com/?p=63
 * Description: This plugin lets the user choose the Related Posts from all published Posts. The plugin is an Addon for the Meta Box plugin by Rilwis and therefore cannot function without the latter being installed too.
 * Version: 2014.02.09
 * Author: Piet Bos
 * Author URI: http://senlinonline.com
 * Text Domain: so-related-posts
 * Domain Path: /languages
 *
 * Copywrite 2013 Piet Bos (piet@senlinonline.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 */

/**
 * Prevent direct access to files
 * via http://mikejolley.com/2013/08/keeping-your-shit-secure-whilst-developing-for-wordpress/
 *
 * @since 2014.01.06
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Version check; any WP version under 3.6 is not supported (if only to "force" users to stay up to date)
 * 
 * adapted from example by Thomas Scholz (@toscho) http://wordpress.stackexchange.com/a/95183/2015, Version: 2013.03.31, Licence: MIT (http://opensource.org/licenses/MIT)
 *
 * @since 2014.01.06
 */

//Only do this when on the Plugins page.
if ( ! empty ( $GLOBALS['pagenow'] ) && 'plugins.php' === $GLOBALS['pagenow'] )
	add_action( 'admin_notices', 'so_check_admin_notices', 0 );

function so_min_wp_version() {
	global $wp_version;
	$require_wp = '3.6';
	$update_url = get_admin_url( null, 'update-core.php' );

	$errors = array();

	if ( version_compare( $wp_version, $require_wp, '<' ) ) 

		$errors[] = "You have WordPress version $wp_version installed, but <b>this plugin requires at least WordPress $require_wp</b>. Please <a href='$update_url'>update your WordPress version</a>.";

	return $errors; 
}

function so_check_admin_notices()
{
	$errors = so_min_wp_version();

	if ( empty ( $errors ) )
		return;

	// Suppress "Plugin activated" notice.
	unset( $_GET['activate'] );

	// this plugin's name
	$name = get_file_data( __FILE__, array ( 'Plugin Name' ), 'plugin' );

	printf( __( '<div class="error"><p>%1$s</p><p><i>%2$s</i> has been deactivated.</p></div>', 'so-related-posts' ),
		join( '</p><p>', $errors ),
		$name[0]
	);
	deactivate_plugins( plugin_basename( __FILE__ ) );
}

/**
 *
 * @since 2014.01.06
 * @modified 2014.02.12
 */
class SORP_Load {

	function __construct() {

		global $sorp;

		/* Set up an empty class for the global $so_pinyinslugs object. */
		$sorp = new stdClass;

		/* Set the init. */
		add_action( 'admin_init', array( &$this, 'init' ), 1 );

		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 2 );

		/* Internationalize the text strings used. */
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 3 );

		/* Load the functions files. */
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 4 );

		/* Load the admin files. */
		add_action( 'plugins_loaded', array( &$this, 'admin' ), 5 );

	}

	/**
	 * Init plugin options to white list our options
	 *
	 * @since 2014.02.12
	 */
	function init() {
		
		register_setting( 'sorp_plugin_options', 'sorp_options', 'sorp_validate_options' );
		
	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since 2014.02.12
	 */
	function constants() {

		/* Set the version number of the plugin. */
		define( 'SORP_VERSION', '2014.02.12' );

		/* Set constant path to the plugin directory. */
		define( 'SORP_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		/* Set constant path to the plugin URL. */
		define( 'SORP_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Set the constant path to the inc directory. */
		define( 'SORP_INCLUDES', SORP_DIR . trailingslashit( 'inc' ) );

		/* Set the constant path to the admin directory. */
		define( 'SORP_ADMIN', SORP_DIR . trailingslashit( 'admin' ) );

	}

	/**
	 * Loads the translation file.
	 *
	 * @since 2014.01.06
	 */
	function i18n() {

		/* Load the translation of the plugin. */
		load_plugin_textdomain( 'so-related-posts', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since 2014.02.12
	 */
	function includes() {

		/* Load the plugin functions file. */
		require_once( SORP_INCLUDES . 'functions.php' );
	}

	/**
	 * Loads the admin functions and files.
	 *
	 * @since 2014.02.12
	 */
	function admin() {

		/* Only load files if in the WordPress admin. */
		if ( is_admin() ) {

			/* Load the main admin file. */
			require_once( SORP_ADMIN . 'settings.php' );

		}
	}
}

$sorp_load = new SORP_Load();

/**
 * This function checks whether the Meta Box plugin is active (it needs to be active for this to have any use)
 * and redirects to inc/required-plugin.php script if it is not active.
 *
 * modified using http://wpengineer.com/1657/check-if-required-plugin-is-active/ and the _no_wpml_warning function (of WPML)
 *
 * @since 2014.01.06
 */

$plugins = get_option( 'active_plugins' );

$required_plugin = 'meta-box/meta-box.php';

// multisite throws the error message by default, because the plugin is installed on the network site, therefore check for multisite
if ( ! in_array( $required_plugin , $plugins ) && ! is_multisite() ) {

	add_action( 'admin_notices', 'sorp_no_meta_box_warning' );

}

function sorp_no_meta_box_warning() {
    
    // display the warning message
    echo '<div class="message error"><p>';
    
    printf( __( 'The <strong>SO Related Posts plugin</strong> only works if you have the <a href="%s">Meta Box</a> plugin installed.', 'so-related-posts' ), 
		admin_url( 'plugins.php?page=install-required-plugin' )
	);
    
    echo '</p></div>';
    
}

/**
 * Include the TGM Activation Class
 *
 * @since 2014.01.20
 */
require_once dirname( __FILE__ ) . '/inc/required-plugin.php';

/**
 * Register activation/deactivation hooks
 * @since 2014.02.12
 */
register_activation_hook( __FILE__, 'sorp_add_defaults' ); 
register_deactivation_hook( __FILE__, 'sorp_delete_plugin_options' );

add_action( 'admin_menu', 'sorp_add_options_page' );

function sorp_add_options_page() {
	// Add the new admin menu and page and save the returned hook suffix
	$hook = add_options_page( 'SO Related Posts Settings', 'SO Related Posts', 'manage_options', __FILE__, 'sorp_render_form' );
	// Use the hook suffix to compose the hook and register an action executed when plugin's options page is loaded
	add_action( 'admin_print_styles-' . $hook , 'sorp_load_settings_style' );
}


/**
 * Define default option settings
 * @since 2014.02.12
 */
function sorp_add_defaults() {
	
	$tmp = get_option( 'sorp_options' );
	
	if ( ( $tmp['chk_default_options_db'] == '1' ) || ( ! is_array( $tmp ) ) ) {
		
		delete_option( 'sorp_options' ); // so we don't have to reset all the 'off' checkboxes too! (don't think this is needed but leave for now)
		
		$arr = array(
			'sorp_title' => __( 'Related Posts', 'so-related-posts' ),
			'chk_default_options_db' => ''
		);
		
		update_option( 'sorp_options', $arr );
	}
}

/**
 * Delete options table entries ONLY when plugin deactivated AND deleted 
 * @since 2014.02.12
 */
function sorp_delete_plugin_options() {
	
	delete_option( 'sorp_options' );
	
}

/**
 * Register and enqueue the settings stylesheet
 * @since 2014.02.12
 */
function sorp_load_settings_style() {

	wp_register_style( 'custom_sorp_settings_css', SORP_URI . 'css/settings.css', false, SORP_VERSION );

	wp_enqueue_style( 'custom_sorp_settings_css' );

}

/**
 * Set-up Action and Filter Hooks
 * @since 2014.02.12
 */
add_filter( 'plugin_action_links', 'sorp_plugin_action_links', 10, 2 );

add_filter( 'rwmb_meta_boxes', 'so_register_meta_boxes' );

add_filter ( 'the_content', 'so_related_posts_output', 5 );

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 * @since 2014.02.12
 */
function sorp_validate_options($input) {
	// strip html from textboxes
	$input['sorp_title'] =  wp_filter_nohtml_kses( $input['sorp_title'] ); // Sanitize input (strip html tags, and escape characters)
	return $input;
}

/**
 * Display a Settings link on the main Plugins page
 * @since 2014.02.12
 */
function sorp_plugin_action_links( $links, $file ) {

	if ( $file == plugin_basename( __FILE__ ) ) {
		$sorp_links = '<a href="' . get_admin_url() . 'options-general.php?page=so-related-posts/so-related-posts.php">' . __( 'Settings', 'so-related-posts' ) . '</a>';
		// make the 'Settings' link appear first
		array_unshift( $links, $sorp_links );
	}

	return $links;
}


/*** The End ***/