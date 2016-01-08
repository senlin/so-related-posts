<?php
/**
 * The actual SO Related Posts plugin files start here
 * For the function so_register_meta_boxes below I have taken the [demo.php file](https://github.com/rilwis/meta-box/blob/master/demo/demo.php) 
 * of the Meta Box plugin and adapted it for the specific purpose of this SO Related Posts Plugin.
 *
 * @since 1.0
 * @modified 1.3.0 - placed function in its own file
 */

/**
 * Register meta box
 *
 * @since 1.0
 * @since 1.4.0 - added new MetaBox feature of sort_clone
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
 * @since 1.0
 * @improved 1.3.2 added checkbox
 */
function so_related_posts_output( $content ) {

	// @since 1.2.0 added is_main_query() to make sure that Related Posts don't show elsewhere
	if ( is_main_query() && is_single() ) {

		$so_show_related_posts = rwmb_meta( 'so_checkbox' );
		$so_related_posts = rwmb_meta( 'so_related_posts', 'type=select_advanced' ); 
		$options = get_option( 'sorp_options' );
		$sorp_title = $options['sorp_title'];
		// check whether it has been set: http://wordpress.stackexchange.com/a/25409/2015
		$sorp_showthumbs = isset( $options['sorp_showthumbs'] ) ? esc_attr( $options['sorp_showthumbs'] ) : '';

		if ( $so_show_related_posts == 1 && ! empty( $so_related_posts ) ) {
		
			if ( ! empty( $sorp_title ) ) {
				$content .= '<div class="so-related-posts"><h4>' . $sorp_title . '</h4><ul class="related-posts">';
			} else {
				$content .= '<div class="so-related-posts"><h4>' . __( 'Related Posts', 'so-related-posts' ) . '</h4><ul class="related-posts">';
			}
			
			foreach ( $so_related_posts as $so_related_post ) {
				
				if ( $sorp_showthumbs == 1 && has_post_thumbnail( $so_related_post ) ) {
					$feat_img = get_post_thumbnail_id( $so_related_post );
					$img_url = wp_get_attachment_url( $feat_img,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
					$sorp_thumb = aq_resize( $img_url, 50, 50, true ); //resize & crop the image

					$content .= '<li><a href="' . esc_url( get_permalink( $so_related_post ) ) . '" title="' . esc_attr( get_the_title( $so_related_post ) ) . '"><img class="related-post-thumb" src="' . $sorp_thumb . '" width="50" height="50" /><span class="title">' . esc_attr( get_the_title( $so_related_post ) ) . '</span></a></li>';

				} else {
					$content .= '<li><a href="' . esc_url( get_permalink( $so_related_post ) ) . '" title="' . esc_attr( get_the_title( $so_related_post ) ) . '"><span class="title">' . esc_attr( get_the_title( $so_related_post ) ) . '</span></a></li>';
				}
			
			};
			
			// @since 1.2.0
			unset( $so_related_post );
			
			$content .= '</ul></div>';

		}

	}

	return $content;

}

// @since 2.0.0
function so_related_posts_styling() {
	
	$so_show_related_posts = rwmb_meta( 'so_checkbox' );

	// is_main_query() to make sure that Related Posts Styling doesn't show elsewhere
	if ( is_main_query() && is_single() && $so_show_related_posts == 1 ) {

		$options = get_option( 'sorp_options' );
		$sorp_styling = $options['sorp_styling'];

		if ( ! empty( $sorp_styling ) ) { ?>
			
			<style type="text/css" id="so-related-posts-css"><?php echo $sorp_styling; ?></style>
			
		<?php }
	}
}
