<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'mjr_talent_options', 'mjr_talent_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'mjr_talent' ), __( 'Theme Options', 'mjr_talent' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}



/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . __( ' Theme Options', 'mjr_talent' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'mjr_talent' ); ?></strong></p></div>
		<?php endif; ?>

		<!-- <form method="post" action="options.php">
			<?php settings_fields( 'mjr_talent_options' ); ?>
			<?php $options = get_option( 'mjr_talent_theme_options' ); ?>

			<table class="form-table">

				<tr valign="top"><th scope="row"><?php _e( 'Hit the Streets Category ID', 'mjr_talent' ); ?></th>
					<td>
						<input id="mjr_talent_theme_options[hts_category_id]" class="regular-text" type="text" name="mjr_talent_theme_options[hts_category_id]" value="<?php esc_attr_e( $options['hts_category_id'] ); ?>" />
					</td>
				</tr>

			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'mjr_talent' ); ?>" />
			</p>
		</form> -->
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	
	//$input['hts_category_id'] = wp_filter_nohtml_kses( $input['hts_category_id'] );


	return $input;
}