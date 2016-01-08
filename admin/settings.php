<?php
/**
 * Render the Plugin options form
 */
function sorp_render_form() { ?>

	<div class="wrap">
		
		<!-- Display Plugin Header, and Description -->
		<h1><?php _e( 'SO Related Posts Settings', 'so-related-posts' ); ?></h1>
		
		<p><?php _e( 'Below you can change the title that shows above the list of Related Posts.', 'so-related-posts' ); ?></p>
			
		<div id="sorp-settings">
	
			<!-- Beginning of the Plugin Options Form -->
			<form method="post" action="options.php">
			
				<?php settings_fields( 'sorp_plugin_options' ); ?>
		
				<?php $options = get_option( 'sorp_options' ); ?>
			
				<table class="form-table"><tbody>
						
					<tr valign="top">
						<th scope="row">
							<label for="sorp-title"><?php _e( 'Title above Related Posts list', 'so-related-posts' ); ?></label>
						</th>

						<td>
							<input name="sorp_options[sorp_title]" type="text" id="sorp-title" class="regular-text" value="<?php echo $options['sorp_title']; ?>" />
							<p class="description"><?php _e( 'Change the title above the Related Posts list into something of your liking', 'so-related-posts' ); ?></p>
							<input type="hidden" name="action" value="update" />
							<input type="hidden" name="page_options" value="<?php echo $options['sorp_title']; ?>" />								
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="sorp-showthumbs"><?php _e( 'Thumbnails', 'so-related-posts' ); ?></label>
						</th>
						
						<td>
							
							<input name="sorp_options[sorp_showthumbs]" type="checkbox" id="sorp-showthumbs" value="1" <?php if ( isset($options['sorp_showthumbs'] ) ) { checked( '1', $options['sorp_showthumbs'] ); } ?> />
							<?php _e( 'Check to show thumbnails', 'so-related-posts' ); ?>
							<p class="description"><?php _e( 'Check this box if you would like to show the thumbnails of the Related Posts.<br />Please keep in mind that your Post(s) better have a Featured Image for this to look good. The image will be dynamically resized at 50x50px.', 'so-related-posts' ); ?></p>
							
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="sorp-styling"><?php _e( 'Style the output right here.', 'so-related-posts' ); ?></label>
						</th>

						<td>
							<textarea name="sorp_options[sorp_styling]" type="text" id="sorp-styling" class="text-area" rows="10" cols="70"><?php echo $options['sorp_styling']; ?></textarea>
							<p class="description">
								<?php 
									printf( __( 'The output of the SO Related Posts plugin comes with the following classes that you can adjust to your heart\'s content. %s', 'so-related-posts' ),
										'<br /><ul><li>div container: <code>.so-related-posts {}</code></li><li>title: <code>.so-related-posts h4 {}</code></li><li>unordered list: <code>ul.related-posts {}</code></li><li>list-items: <code>ul.related-posts li {}</code></li><li>anchor: <code>ul.related-posts li a {}</code></li><li>image (if you show the thumbnails): <code>img.related-post-thumb {}</code></li><li>post title: <code>ul.related-posts li span.title {}</code></li></ul>'
									);
								
								?>
							</p>
							
							<p class="description">
								<?php
									printf( __( 'As an example you could use the following styling if you choose to show the thumbs: %s', 'so-related-posts' ),
										'<br /><pre>.related-posts { list-style: none; margin-left: 0; }<br />.related-posts li { clear: both; margin-bottom: 10px; min-height: 50px; width: 100%; }<br />img.related-post-thumb { float: left; margin-right: 3%; }<br />.related-posts .title { line-height: 40px; }</pre>'
									);
								?>
							</p>

							<p class="description">
								<?php
									printf( __( 'Another simple example to show the Related Posts as a numbered list without thumbs can be like this: %s', 'so-related-posts' ),
										'<br /><pre>.related-posts { list-style: decimal; }<br />.related-posts a { text-decoration: none; }<br />.related-posts a:hover { text-decoration: underline; }</pre>'
									);
								?>
							</p>
							
							<input type="hidden" name="action" value="update" />
							<input type="hidden" name="page_options" value="<?php echo $options['sorp_styling']; ?>" />
						</td>
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="sorp-options"><?php _e( 'More Features', 'so-related-posts' ); ?></label>
						</th>

						<td>
							<p class="description"><?php printf( __( 'We are planning to roll out a few more features soon!<br />You can let us know any feature on your wish-list <a href="%s" target="_blank">via our plugin page on Github</a>.', 'so-related-posts' ), 'https://github.com/senlin/so-related-posts/issues' ); ?></p>
						</td>
					</tr>
						
					<tr valign="top">
						<hr />
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="sorp-db-chk"><?php _e( 'Database Options', 'so-related-posts' ); ?></label>
						</th>
						
						<td>
							<input name="sorp_options[chk_default_options_db]" type="checkbox" id="sorp-db-chk" value="1" <?php if ( isset($options['chk_default_options_db'] ) ) { checked( '1', $options['chk_default_options_db'] ); } ?> />
								<?php _e( 'Restore defaults upon plugin deactivation/reactivation', 'so-related-posts' ); ?>
							<p class="description"><?php _e( 'Only check this if you want to reset plugin settings upon Plugin reactivation', 'so-related-posts' ); ?></p>
						</td>
					</tr>
				
				</tbody></table> <!-- end .tbody end table -->
				
				<p class="submit">
					
					<input type="submit" class="button-primary" value="<?php _e( 'Save Settings', 'so-related-posts' ) ?>" />
				
				</p>
			
			</form>
		
		</div><!-- #sorp-settings -->

		<p class="rate-this-plugin">
			<?php
			/* Translators: 1 is link to WP Repo */
			printf( __( 'If you have found this plugin at all useful, please give it a favourable rating in the <a href="%s" title="Rate this plugin!">WordPress Plugin Repository</a>.', 'so-related-posts' ), 
				esc_url( 'http://wordpress.org/support/view/plugin-reviews/so-related-posts' )
			);
			?>
		</p>

		<p class="support">
			<?php
			/* Translators: 1 is link to Github Repo */
			printf( __( 'If you have an issue with this plugin or want to leave a feature request, please note that I give <a href="%s" title="Support or Feature Requests via Github">support via Github</a> only.', 'so-related-posts' ), 
				esc_url( 'https://github.com/senlin/so-related-posts/issues' )
			);
			?>
		</p>
		
		<div class="author postbox">
			
			<h3 class="hndle">
				<span><?php _e( 'About the Author', 'so-related-posts' ); ?></span>
			</h3>
			
			<div class="inside">
				<div class="top">
					<img class="author-image" src="http://www.gravatar.com/avatar/<?php echo md5( 'info@senlinonline.com' ); ?>" />
					<p>
						<?php printf( __( 'Hi, my name is Piet Bos, I hope you like this plugin! Please check out any of my other plugins on <a href="%s" title="SO WP Plugins">SO WP Plugins</a>. You can find out more information about me via the following links:', 'so-related-posts' ),
							esc_url( 'http://so-wp.com' )
						); ?>
					</p>
				</div> <!-- end .top -->
				
				<ul>
					<li><a href="http://senlinonline.com/" target="_blank" title="Senlin Online"><?php _e('Senlin Online', 'so-related-posts'); ?></a></li>
					<li><a href="http://wpti.ps/" target="_blank" title="WP TIPS"><?php _e('WP Tips', 'so-related-posts'); ?></a></li>
					<li><a href="https://www.linkedin.com/in/pietbos" target="_blank" title="LinkedIn profile"><?php _e( 'LinkedIn', 'so-related-posts' ); ?></a></li>
					<li><a href="https://github.com/senlin" title="on Github"><?php _e( 'Github', 'so-related-posts' ); ?></a></li>
					<li><a href="https://profiles.wordpress.org/senlin/" title="on WordPress.org"><?php _e( 'WordPress.org Profile', 'so-related-posts' ); ?></a></li>
				</ul>
			
			</div> <!-- end .inside -->
		
		</div> <!-- end .postbox -->

	</div> <!-- end .wrap -->

<?php }

