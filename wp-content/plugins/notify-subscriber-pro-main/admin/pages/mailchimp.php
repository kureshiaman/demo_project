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
					<div id="notify-subscribers-block" class="ns-admin-tab-content">
						<div class="post-type-pane">
							<form action="" method="post">
								<div class="ns-admin-fieldset-group" id="accordion">
									<div class="ns-admin-panel"><div class="ns-admin-panel-heading">
										<div class="ns-admin-panel-title collapsed" data-toggle="collapse" data-parent="#accordion" data-target="#mailchimp" aria-expanded="false">
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
											<h2><?php _e( 'MailChimp', 'notify-subscribers' ); ?></h2>
										</div>
									</div>
									<div class="ns-admin-panel-collapse collapse in" id="mailchimp" aria-expanded="false" style="height: 0px;">
										<?php $mailchimp = apply_filters( 'ns_options', 'ns-mailchimp' ); ?>
										<div class="ns-admin-panel-body clearfix">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="ns-form-group">
														<div class="ns-admin-checkbox">
															<div class="ns-admin-checkbox-inner">
																<input type="checkbox" name="mailchimp[on_off]" id="mailchimp-on-off" <?php echo isset( $mailchimp['on_off'] ) ? 'checked' : ''; ?>>
																<label for="mailchimp-on-off"></label>
															</div>
															<div class="ns-admin-checkbox-text"><?php _e( 'Enabled/Disabled', 'notify-subscribers' ); ?>
															</div>
														</div>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="ns-form-group">
														<label for="mailchimp_api"><?php _e( 'API Key', 'notify-subscribers' ); ?></label>
														<input type="text" name="mailchimp[mailchimp_api]" id="mailchimp_api" value="<?php echo isset( $mailchimp['mailchimp_api'] ) ? $mailchimp['mailchimp_api'] : ''; ?>" class="ns-input" placeholder="<?php _e( 'API Key', 'notify-subscribers' ); ?>" <?php echo ! isset( $mailchimp['on_off'] ) ? 'readonly' : ''; ?>>
													</div>
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
													<div class="ns-form-group">
														<label for="mailchimp_list"><?php _e( 'List ID', 'notify-subscribers' ); ?></label>
														<input type="text" name="mailchimp[mailchimp_list]" id="mailchimp_list" value="<?php echo isset( $mailchimp['mailchimp_list'] ) ? $mailchimp['mailchimp_list'] : ''; ?>" class="ns-input" placeholder="<?php _e( 'List ID', 'notify-subscribers' ); ?>" <?php echo ! isset( $mailchimp['on_off'] ) ? 'readonly' : ''; ?>>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<div class="ns-submit">
							<?php echo submit_button( __( 'save', 'notify-subscribers' ), 'primary', 'mailchimp-save', false ); ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>