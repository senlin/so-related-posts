<?php
/**
 * Render the Plugin options form
 */
function sorp_render_form() { ?>

	<div class="wrap">
		
		<!-- Display Plugin Header, and Description -->
		<h1><?php _e( 'SO Related Posts Settings', 'so-related-posts' ); ?></h1>
		
		<p><?php _e( 'Below you can change the title that shows above the list of Related Posts.', 'so-related-posts' ); ?></p>
			
		<div id="sorrp-settings">
	
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
							<label for="sorp-options">
								<?php printf( __( 'Get more options with<br /><a href="%s" title="SO PLUS Premium WordPress Plugins by Senlin Online">SO Related Posts PLUS</a>!', 'so-related-posts' ),
									'https://senlinonline.com/plus/plugin/so-related-posts-plus/'
								); ?>
							</label>
						</th>

						<td>
							<p class="description">
								<?php 
									printf( __( 'Upgrade now with coupon code: %1$s for %2$s!', 'so-related-posts' ),
										'<span class="discount">SWITCH2PLUS</span>',
										'<strong>30% discount</strong>'
									);
								?>
							</p>
						</td>
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
		
		</div><!-- #sorpp-settings -->

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

