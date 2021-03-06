<tr>
	<th scope="row">
		<label for="learn-press-emails-new-course-email-content"><?php _e( 'Email content', 'learnpress' ); ?></label>
	</th>
	<td>
		<?php if ( current_user_can( 'edit_themes' ) && ( !empty( $this->template_html ) || !empty( $this->template_plain ) ) ) { ?>
			<div id="templates">
				<?php
				$templates = array(
					'html'  => __( 'HTML template', 'learnpress' ),
					'plain' => __( 'Plain text template', 'learnpress' )
				);

				foreach ( $templates as $template_type => $title ) :
					$template      = $this->get_template( 'template_' . $template_type );

					if ( empty( $template ) ) {
						continue;
					}

					$local_file    = $this->get_theme_template_file( $template );
					$template_file = $this->template_base . $template;
					$template_dir  = learn_press_template_path();
					?>
					<div class="template <?php echo $template_type == 'html' ? $template_type . ' multipart' : 'plain_text'; ?>" style="display: none;">

						<?php if ( file_exists( $local_file ) ) { ?>
							<?php if( $template_type == 'plain' ){ ?>
								<div class="editor">
									<textarea name="<?php echo $settings_class->get_field_name( 'emails_' . $this->id . '[email_content_plain]' );?>" class="code" cols="25" rows="20" style="width: 97%;"><?php echo file_get_contents( $local_file ); ?></textarea>
								</div>
							<?php } else { ?>
								<?php
								wp_editor(
									stripslashes( file_get_contents( $local_file ) ),
									'learn_press_email_content_' . $template_type,
									array(
										'textarea_rows' => 20,
										'wpautop'       => false,
										'textarea_name' => $settings_class->get_field_name( 'emails_' . $this->id . '[email_content_html]' )
									)
								);
								?>
							<?php } ?>
							<h4><?php echo wp_kses_post( $title ); ?></h4>

							<p class="description">
								<?php printf( __( 'This template has been overridden by your theme and can be found in: <code>%s</code>.', 'learnpress' ), 'yourtheme/' . $template_dir . '/' . $template ); ?>
							</p>
							<p>
								<?php if ( is_writable( $local_file ) ) : ?>
									<a href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'move_template', 'saved' ), add_query_arg( 'delete_template', $template_type ) ), 'learn_press_email_template_nonce', '_learn_press_email_nonce' ) ); ?>" class="delete_template button">
										<?php _e( 'Delete template file', 'learnpress' ); ?>
									</a>
								<?php endif; ?>
							</p>
						<?php } elseif ( file_exists( $template_file ) ) { ?>
							<div class="editor">
								<textarea class="code" readonly="readonly" disabled="disabled" cols="25" rows="20" style="width: 97%;"><?php echo file_get_contents( $template_file ); ?></textarea>
							</div>
							<h4><?php echo wp_kses_post( $title ); ?></h4>
							<p class="description">
								<?php printf( __( 'To override and edit this email template copy <code>%s</code> to your theme folder: <code>%s</code>.', 'learnpress' ), plugin_basename( $template_file ), 'yourtheme/' . $template_dir . '/' . $template ); ?>
							</p>
							<p>
								<?php if ( ( is_dir( get_stylesheet_directory() . '/' . $template_dir . '/emails/' ) && is_writable( get_stylesheet_directory() . '/' . $template_dir . '/emails/' ) ) || is_writable( get_stylesheet_directory() ) ) { ?>
									<a href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'delete_template', 'saved' ), add_query_arg( 'move_template', $template_type ) ), 'learn_press_email_template_nonce', '_learn_press_email_nonce' ) ); ?>" class="button">
										<?php _e( 'Copy file to theme', 'learnpress' ); ?>
									</a>
								<?php } ?>
							</p>
						<?php } else { ?>

							<p><?php _e( 'File was not found.', 'learnpress' ); ?></p>

						<?php } ?>
					</div>
					<?php
				endforeach;
				?>
			</div>
		<?php } ?>
	</td>
</tr>
<?php ob_start();?>
<script>
	jQuery(function($){
		$('#learn_press_email_formats').change(function(){
			var format = $(this).val();
			$('.'+format).show().siblings().hide();
		}).change();
	});
</script>
<?php learn_press_enqueue_script( preg_replace( '!</?script>!', '', ob_get_clean() ) );?>