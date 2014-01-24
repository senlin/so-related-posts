<?php
/**
 * Plugin Name: SO Related Posts
 * Plugin URI: http://so-wp.com/?p=63
 * Description: This plugin lets the user choose the Related Posts from all published Posts. The plugin is an Addon for the Meta Box plugin by Rilwis and therefore cannot function without the latter being installed too.
 * Version: 2014.01.24
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
 */
class SORP_Load {

	function __construct() {

		global $sorp;

		/* Set up an empty class for the global $so_pinyinslugs object. */
		$sorp = new stdClass;

		/* Internationalize the text strings used. */
		add_action( 'admin_init', array( &$this, 'i18n' ), 1 );

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

}

$sorp_load = new SORP_Load();

/**
 * This function checks whether the Meta Box plugin is active (it needs to be active for this to have any use)
 * and gives a warning message with link to plugin homepage if it is not active.
 *
 * modified using http://wpengineer.com/1657/check-if-required-plugin-is-active/ and the _no_wpml_warning function (of WPML)
 *
 * @since 2014.01.06
 */

$plugins = get_option( 'active_plugins' );

$required_plugin = 'meta-box/meta-box.php';

// multisite throws the error message by default, because the plugin is installed on the network site, therefore check for multisite
if ( ! in_array( $required_plugin , $plugins ) && ! is_multisite() ) {

	add_action( 'admin_notices', 'so_no_meta_box_warning' );

}

function so_no_meta_box_warning() {
    
    // display the warning message
    echo '<div class="message error"><p>';
    
    printf( __( 'The <strong>SO Related Posts plugin</strong> only works if you have the <a href="%s">Meta Box</a> plugin installed.', 'so-related-posts' ), 
		admin_url( 'plugins.php?page=install-required-plugin' )
	);
    
    echo '</p></div>';
    
    // @modified 2014.01.20
    // no longer deactivate the plugin, instead include TGM Activation Class
    //deactivate_plugins( plugin_basename( __FILE__ ) );
}

/**
 * Include the TGM Activation Class
 *
 * @since 2014.01.20
 */
require_once dirname( __FILE__ ) . '/inc/required-plugin.php';

/**
 * The actual SO Related Posts plugin files start here
 * For the function so_register_meta_boxes below I have taken the [demo.php file](https://github.com/rilwis/meta-box/blob/master/demo/demo.php) 
 * of the Meta Box plugin and adapted it for the specific purpose of this SO Related Posts Plugin.
 *
 * @since 2014.01.06
 */
add_filter( 'rwmb_meta_boxes', 'so_register_meta_boxes' );

/**
 * Register meta box
 *
 * @since 2014.01.06
 */
function so_register_meta_boxes( $meta_boxes )
{

	$prefix = 'so_';

	$meta_boxes[] = array(
		'id' => 'SO_related_posts',
		'title' => __( 'Related Posts', 'so-related-posts' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			array(
				'name' => __( 'Choose one or more Related Post(s) you want to show.', 'so-related-posts' ),
				'id' => "{$prefix}related_posts",
				'type' => 'post',
				'post_type' => 'post',
				'field_type' => 'select_advanced',
				/**
				 * add placeholder text
				 * @since 2014.01.07
				 */
				'placeholder' => __( 'Please select...', 'so-related-posts' ),
				'query_args' => array(
					'post_status' => 'publish',
					'posts_per_page' => '999',
				),
				'clone' => true
			)
		)
	);

	return $meta_boxes;
}

/**
 * Place the output at the bottom of the_content()
 * The output comes in its own class, so you can customise it with CSS all you want.
 *
 * @since 2014.01.06
 */
add_filter ( 'the_content', 'so_related_posts_output', 1 );

function so_related_posts_output( $content ) {

	if ( is_single() ) {

		$so_related_posts = rwmb_meta( 'so_related_posts', 'type=select_advanced' ); 

		if( ! empty( $so_related_posts ) ) {
		
			$content .= '<div class="so-related-posts"><h4>' . __( 'Related Posts:', 'so-related-posts' ) . '</h4><ul class="related-posts">';
			
			foreach ( $so_related_posts as $so_related_post ) {
				
				$content .= '<li><a href="' . get_permalink( $so_related_post ) . '" title="' . get_the_title( $so_related_post ) . '">' . get_the_title( $so_related_post ) . '</a></li>';
			
			};
			
			$content .= '</ul></div>';

		}

	}

	return $content;

}
/*** The End ***/