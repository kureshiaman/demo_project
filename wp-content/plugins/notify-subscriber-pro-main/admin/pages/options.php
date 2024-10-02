<div id="wrapper">
	<div id="page">
		<div class="ns-admin-container">
			<div class="ns-admin-wrapper">
				<div class="ns-admin-wrap">
					<div class="ns-head-name" id="plugin_title">
						<div class="thumb">
							<div class="wrap"><img src="<?php echo NOTIFY_SUBSCRIBERS_IN_PLUGIN_URL; ?>admin/images/logo.png"></div>
						</div>
					</div>
					<div id="notify-subscribers-block" class="ns-admin-tab-content notify_subscribers_settings">
						<div class="post-type-pane">
							<form action="" method="post">
								<div class="ns-admin-fieldset-group" id="accordion">
									<div class="ns-admin-panel"><div class="ns-admin-panel-heading">
										<div class="ns-admin-panel-title" data-toggle="collapse" data-parent="#accordion" data-target="#collapse_form" aria-expanded="false">
											<div class="ns-admin-panel-title-icon">
												<div class="ns-icon ns-icon-circle">
													<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"></path>
														<path d="M0 0h24v24H0z" fill="none"></path>
													</svg>
												</div>
												<div class="ns-icon ns-icon-down-arrow">
													<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														<path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
														<path d="M0 0h24v24H0z" fill="none"></path>
													</svg>
												</div>
												<div class="ns-icon ns-icon-up-arrow">
													<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														<path d="M12 8l-6 6 1.41 1.41L12 10.83l4.59 4.58L18 14z"></path>
														<path d="M0 0h24v24H0z" fill="none"></path>
													</svg>
												</div>
												<div class="ns-icon ns-icon-plus">
													<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
														<path d="M0 0h24v24H0z" fill="none"></path>
													</svg>
												</div>
												<div class="ns-icon ns-icon-minus">
													<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
														<path d="M19 13H5v-2h14v2z"></path>
														<path d="M0 0h24v24H0z" fill="none"></path>
													</svg>
												</div>
											</div>
											<h2><?php _e( 'Config', 'notify-subscribers' ); ?></h2>
										</div>
									</div>
									<div class="ns-admin-panel-collapse collapse in" id="collapse_form" aria-expanded="false" style="height: 0px;">
									<?php $config = apply_filters( 'ns_options', 'ns-config' ); ?>
										<div class="ns-admin-panel-body clearfix">
											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="ns-form-group">
														<label for="thank-you"><?php _e( 'Thank You Page', 'notify-subscribers' ); ?></label>
														<input type="text" name="config[thank_you_page]" value="<?php echo isset( $config['thank_you_page'] ) ? $config['thank_you_page'] : ''; ?>" class="ns-input" placeholder="<?php _e( 'Relative Path', 'notify-subscribers' ); ?>">
														<p><?php _e( 'You must enter the relative path.', 'notify-subscribers' ); ?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="ns-admin-fieldset-group" id="accordion">
								<div class="ns-admin-panel"><div class="ns-admin-panel-heading">
									<div class="ns-admin-panel-title collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#post_types" aria-expanded="false">
										<div class="ns-admin-panel-title-icon">
											<div class="ns-icon ns-icon-circle">
												<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
													<path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10 10-4.49 10-10S17.51 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3-8c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3z"></path>
													<path d="M0 0h24v24H0z" fill="none"></path>
												</svg>
											</div>
											<div class="ns-icon ns-icon-down-arrow">
												<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
													<path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"></path>
													<path d="M0 0h24v24H0z" fill="none"></path>
												</svg>
											</div>
											<div class="ns-icon ns-icon-up-arrow">
												<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
													<path d="M12 8l-6 6 1.41 1.41L12 10.83l4.59 4.58L18 14z"></path>
													<path d="M0 0h24v24H0z" fill="none"></path>
												</svg>
											</div>
											<div class="ns-icon ns-icon-plus">
												<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
													<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
													<path d="M0 0h24v24H0z" fill="none"></path>
												</svg>
											</div>
											<div class="ns-icon ns-icon-minus">
												<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
													<path d="M19 13H5v-2h14v2z"></path>
													<path d="M0 0h24v24H0z" fill="none"></path>
												</svg>
											</div>
										</div>
										<h2><?php _e( 'Post Types', 'notify-subscribers' ); ?></h2>
									</div>
								</div>
								<div class="ns-admin-panel-collapse collapse" id="post_types">
									<div class="ns-admin-panel-body clearfix">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="ns-admin-checkbox-message notice notice-warning">
													<p><strong><?php _e( 'It sends the push notification for all the post types by default. You can disable the push notification for specific post types. But, if you will disable it for all post types, it will send the push notification for all post types.', 'notify-subscribers' ); ?></strong></p>
												</div>
												<div class="ns-form-group">
													<?php
													if ( isset( $get_all_post_types ) ) {
														foreach ( $get_all_post_types as $post_key => $post_name ) {
															$checked = array_key_exists( $post_key, $set_post_types ) ? 'checked="checked"' : '';
															echo '<div class="ns-admin-checkbox">';
															echo '<div class="ns-admin-checkbox-inner">';
															echo '<input type="checkbox" name="ns_exclude_post[]" id="' . $post_key. '" value="' . $post_key . '" ' . $checked . '>';
															echo '<label for="' . $post_key . '"></label>';
															echo '</div>';
															echo '<div class="ns-admin-checkbox-text">' . $post_name . '</div>';
															echo '</div>';
														}
													}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="ns-submit">
							<?php echo submit_button( __( 'save', 'notify-subscribers' ), 'primary', 'post-type-save', false ); ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>