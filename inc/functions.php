<?php
/**
 * The actual SO Related Posts plugin files start here
 * For the function so_register_meta_boxes below I have taken the [demo.php file](https://github.com/rilwis/meta-box/blob/master/demo/demo.php) 
 * of the Meta Box plugin and adapted it for the specific purpose of this SO Related Posts Plugin.
 *
 * @since 2014.01.06
 * @modified 2014.02.12 - placed function in its own file
 */

/**
 * Register meta box
 *
 * @since 2014.01.06
 * @modified 2015.06.17 - added new MetaBox feature of sort_clone
 */
function so_register_meta_boxes( $meta_boxes )
{

	$prefix = 'so_';

	$meta_boxes[] = array(
		'id' => 'so_related_posts',
		'title' => __( 'Related Posts', 'so-related-posts' ),
		'post_types' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(
			/**
			 * add checkbox to show Related Posts or not
			 * @since 2014.03.21
			 */
			array(
				'name' => __( 'Tick the box to show Related Posts', 'so-related-posts' ),
				'id'   => "{$prefix}checkbox",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),
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
				'clone' => true,
				'sort_clone' => true,
			)
		)
	);

	return $meta_boxes;
}

/**
 * Place the output at the bottom of the_content()
 * The output comes in its own class, so you can customise it with CSS all you want.
 *
 * Improved by changing priority from 1 to 5, add conditional is_main_query(), unset foreach call and escape text/url/title-strings
 *
 * @since 2014.01.06
 * @improved 2014.03.21 added checkbox
 */
function so_related_posts_output( $content ) {

	// @since 2014.02.09 added is_main_query() to make sure that Related Posts don't show elsewhere
	if ( is_main_query() && is_single() ) {

		$so_show_related_posts = rwmb_meta( 'so_checkbox' );
		$so_related_posts = rwmb_meta( 'so_related_posts', 'type=select_advanced' ); 
		$options = get_option( 'sorp_options' );
		$sorp_title = $options['sorp_title'];

		if ( $so_show_related_posts == 1 && ! empty( $so_related_posts ) ) {
		
			if ( ! empty( $sorp_title ) ) {
				$content .= '<div class="so-related-posts"><h4>' . $sorp_title . '</h4><ul class="related-posts">';
			} else {
				$content .= '<div class="so-related-posts"><h4>' . __( 'Related Posts', 'so-related-posts' ) . '</h4><ul class="related-posts">';
			}
			
			foreach ( $so_related_posts as $so_related_post ) {
				
				$content .= '<li><a href="' . esc_url( get_permalink( $so_related_post ) ) . '" title="' . esc_attr( get_the_title( $so_related_post ) ) . '">' . esc_attr( get_the_title( $so_related_post ) ) . '</a></li>';
			
			};
			
			// @since 2014.02.09
			unset( $so_related_post );
			
			$content .= '</ul></div>';

		}

	}

	return $content;

}
