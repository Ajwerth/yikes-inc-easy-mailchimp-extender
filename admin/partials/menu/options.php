<!-- required styles -->
<style>
#postbox-container-1 .postbox { padding-bottom: 1em; }
</style>

<!-- toggle optin message container on change -->
<script type="text/javascript">
function toggleOptinValue( selected ) {
	if( selected.value == 'true' ) {
		jQuery( '.yks-mailchimp-single-optin-message' ).slideUp( 'fast' , function() {
			jQuery( '.yks-mailchimp-double-optin-message' ).slideDown( 'fast' );
		});
	} else {
		jQuery( '.yks-mailchimp-double-optin-message' ).slideUp( 'fast' , function() {
			jQuery( '.yks-mailchimp-single-optin-message' ).slideDown( 'fast' );
		});
	}
}
</script>
<?php
	
	/* Get and Store Option Values */
	if( get_option( 'yikes-mc-api-validation' , 'invalid_api_key' ) == 'valid_api_key' ) {
		$api_connection = '<span id="connection-container" class="api-connected" title="' . __( "Your site is currently connected to the MailChimp API" , "yikes-inc-easy-mailchimp-extender" ) . '"><span class="dashicons dashicons-yes yikes-mc-api-connected"></span> ' . __( "Connected" , $this->text_domain ) . '</span>';
		$api_error_response = '';
	} else {
		$api_connection = '<span id="connection-container" class="api-not-connected"><span class="dashicons dashicons-no-alt yikes-mc-api-not-connected"></span>  ' . __( "Not Connected" , $this->text_domain ) . '</span>';
		if( get_option( 'yikes-mc-api-invalid-key-response' , '' ) != '' ) {	
			$api_error_response = '<p><small><i class="dashicons dashicons-no-alt"></i> ' . get_option( 'yikes-mc-api-invalid-key-response' , '' ) . '</small></p>';
		} else {
			$api_error_response = '';
		}
	}
	
	// optin option value
	$optin = get_option( 'yks-mailchimp-optin' , 'true' );
	
	$single_optin_message = get_option( 'yks-mailchimp-single-optin-message' , __( 'Thank You for subscribing!', $this->text_domain ) );
	$double_optin_message = get_option( 'yks-mailchimp-double-optin-message' , __( 'Thank You for subscribing! Check your email for the confirmation message.', $this->text_domain ) );
	
	/* Callback + Validation Functions */
		
		/* General Settings Section Callback */
		function yikes_easy_mc_settings_section_callback() {
			echo __( 'General settings section callback.' , $this->text_domain ); 
		}
						
		/* Single Optin Field */
		function yikes_inc_easy_mc_single_optin_field_callback() {
			echo 'Single Optin Message Here';
		}
		
		/* Double Optin Field */
		function yikes_inc_easy_mc_double_optin_field_callback() {
			echo 'Double Optin Message Here';
		}
	
?>


	<!-- 
		Actual Settings Form 
		Chyea --
	-->
	<div class="wrap">
	
		<!-- Freddie Logo -->
		<img src="<?php echo YIKES_MC_URL . 'includes/images/MailChimp_Assets/Freddie_60px.png'; ?>" alt="Freddie - MailChimp Mascot" style="float:left;margin-right:10px;" />
		
		<h2>Easy MailChimp by Yikes Inc. | <?php _e( 'Settings' , $this->text_domain ) ?></h2>				
		
		<!-- Settings Page Description -->
		<p class="yikes-easy-mc-about-text about-text"><?php _e( 'Easy MailChimp Forms allows you to painlessly add MailChimp sign up forms to your WordPress site and track user activity with interactive reports.' , $this->text_domain ); ?></p>

		<?php
			/* Success Messages on Options Updated */
			if( isset( $_REQUEST['settings-updated'] ) && $_REQUEST['settings-updated'] == 'true' ) {
				?>
				<div class="updated manage-form-admin-notice">
					<p><?php _e( 'Settings successfully updated.', $this->text_domain ); ?></p>
				</div>
				<?php
			}
			/* MailChimp API Cleared Successfully message */
			if( isset( $_REQUEST['transient-cleared'] ) && $_REQUEST['transient-cleared'] == 'true' ) {
				?>
				<div class="updated manage-form-admin-notice">
					<p><?php _e( 'MailChimp API Cache successfully cleared.', $this->text_domain ); ?></p>
				</div>
				<?php
			}
		?>
										
		<!-- entire body content -->
		<div id="poststuff">
	
			<div id="post-body" class="metabox-holder columns-2">
			
				<!-- main content -->
				<div id="post-body-content">
					
					<div class="meta-box-sortables ui-sortable">
						
						<div class="postbox yikes-easy-mc-postbox">
						
							<?php if( !isset( $_REQUEST['section'] ) || $_REQUEST['section'] == '' ) { 
								include YIKES_MC_PATH . 'admin/partials/menu/options-sections/general-settings.php';				
							} else {
								include YIKES_MC_PATH . 'admin/partials/menu/options-sections/' . $_REQUEST['section'] . '.php';		
							}
							?>
						
						</div> <!-- .postbox -->
						
					</div> <!-- .meta-box-sortables .ui-sortable -->
					
				</div> <!-- post-body-content -->
				
				<!-- sidebar -->
				<div id="postbox-container-1" class="postbox-container">
										
					<div class="meta-box-sortables">
						
						<div class="postbox yikes-easy-mc-postbox">
																		
							<?php 
								// Render our sidebar menu
								// inside class-yikes-inc-easy-mailchimp-extender-admin.php
								$this->generate_options_pages_sidebar_menu(); 
							?>
															
						</div> <!-- .postbox -->
						
						<?php $this->generate_show_some_love_container(); ?>
						
					</div> <!-- .meta-box-sortables -->
					
				</div> <!-- #postbox-container-1 .postbox-container -->
				
			</div> <!-- #post-body .metabox-holder .columns-2 -->
			
			<br class="clear">
		</div> <!-- #poststuff -->
		
	</div>	<!-- .wrap -->