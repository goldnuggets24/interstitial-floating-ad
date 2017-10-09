<?php
/*
Plugin Name: Interstitial Admin for floating ads
Description: A plugin to schedule DFP floating ads
Author: Mike Levine
Version: 0.1
*/
add_action('admin_menu', 'interstitial_floating_ad_plugin_setup_menu');
add_action( 'admin_enqueue_scripts', 'enqueue_date_picker' );
add_action( 'admin_menu', 'register_media_selector_settings_page' );
add_action( 'admin_footer', 'media_selector_print_scripts' );
add_action( 'wp_head', 'floating_ad_front_end' );

function floating_ad_front_end()
{
	$dir = plugin_dir_path( __FILE__ );
	include($dir."floating-ad.php");
}

add_action( 'wp', 'elegance_referal_init' );
 
function interstitial_floating_ad_plugin_setup_menu(){
        add_menu_page( 'Interstitial Floating Ad Scheduler', 'Interstitial Floating Ad Admin', 'manage_options', 'test-plugin', 'interstitial_init' );
}
function register_media_selector_settings_page() {
	add_submenu_page( 'options-general.php', 'Media Selector', 'Media Selector', 'manage_options', 'media-selector', 'media_selector_settings_page_callback' );
}
function enqueue_date_picker(){
                wp_enqueue_script(
			'field-date-js', 
			'Field_Date.js', 
			array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'),
			time(),
			true
		);
		wp_enqueue_style( 'jquery-ui-datepicker' );
} 

function media_selector_settings_page_callback() {
	// Save attachment ID
	if ( isset( $_POST['submit_image_selector'] ) && isset( $_POST['image_attachment_id'] ) ) :
		update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
	endif;

	wp_enqueue_media();

	?><form method='post'>
		<div class='image-preview-wrapper'>
			<img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' height='100'>
		</div>
		<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
		<input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
		<input type="submit" name="submit_image_selector" value="Save" class="button-primary">
	</form><?php
} 

function interstitial_init() { ?>

<div class="wrap">
	<!-- Save my values -->
    <?php
        if (isset($_POST['interstitial-width'])) {
        update_option('interstitial-width', $_POST['interstitial-width']);
        $value = get_option('interstitial-width');
    } 
        if (isset($_POST['interstitial-height'])) {
        update_option('interstitial-height', $_POST['interstitial-height']);
        $value = get_option('interstitial-height');
    } 
        if (isset($_POST['interstitial-dfp-code'])) {
        update_option('interstitial-dfp-code', $_POST['interstitial-dfp-code']);
        $value = get_option('interstitial-dfp-code');
    } 
        if (isset($_POST['startdate-interstitial'])) {
        update_option('startdate-interstitial', $_POST['startdate-interstitial']);
        $value = get_option('startdate-interstitial');
    } 
        if (isset($_POST['enddate-interstitial'])) {
        update_option('enddate-interstitial', $_POST['enddate-interstitial']);
        $value = get_option('enddate-interstitial');
    } 
        if (isset($_POST['activate_ad'])) {
        update_option('activate_ad', $_POST['activate_ad']);
        $value = get_option('activate_ad');
    } 
    if (isset($_POST['daily'])) {
        update_option('daily', $_POST['daily']);
        $value = get_option('daily');
    } ?>
 
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 
    <form method="POST">
        <div id="options-container">
 			<?php media_selector_settings_page_callback(); ?>
 			<hr>
            <div class="options">
				<h3>Timing</h3>
                <label>When would you like this ad to go live?</label>
                <br />
                <input type="date" id="datepicker" name="startdate-interstitial" value="<?php echo get_option('startdate-interstitial', $default = '1970-01-01'); ?>" class="startdate-datepicker" />
                <br />
                <label>When would you like this ad to end?</label>
                <br />
                <input type="date" id="datepicker_two" name="enddate-interstitial" value="<?php echo get_option('enddate-interstitial', $default = '2070-01-01'); ?>" class="enddate-datepicker" />
				<br />
				<label>How many times would you like to see this ad daily?</label>
                <br />
                <select name="daily" class="form-control" id="sel1">
					<option value="1" <?php echo get_option('daily', $default = '1') == '1' ? 'selected' : '' ?>>1</option>
					<option value="2" <?php echo get_option('daily', $default = '2') == '2' ? 'selected' : '' ?>>2</option>
				</select>
				<hr>
				<h3>Dimensions</h3>
				<input type="text" name="interstitial-width" value="<?php echo get_option('interstitial-width', $default = '500'); ?>" placeholder="width" />
				<input type="text" name="interstitial-height" value="<?php echo get_option('interstitial-height', $default = '500'); ?>" placeholder="height" />
				<hr>
				<h3>DFP Code</h3>
				<p>This is an example DFP code snippet. Please find the matching code for your ad, and enter only the code in <b>bold</b> into the DFP textfield below:</p>
				<p><pre><code>&lt;div id='div-gpt-ad-<b>1502995302683</b>-0' style='height:600px; width:300px;'&gt;
&lt;script&gt;
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1502995302683-0'); });
&lt;/script&gt;
&lt;/div&gt;
</blockquote></code></pre></p>
				<input type="text" name="interstitial-dfp-code" value="<?php echo get_option('interstitial-dfp-code', $default = 'sonicscoop'); ?>" placeholder="DFP Code" />
				<br />
				<hr>
				<input type='hidden' value='0' name='activate_ad'>
				<input class="activate_ad" style="float:left;position: relative;top:14px;" type="checkbox" name="activate_ad" value="<?php echo get_option('activate_ad', $default = '0'); ?>" <?php echo get_option('activate_ad', $default = '0') == '1' ? 'checked' : 'unchecked' ?> />
            	<h3>Activate Ad?</h3>
				<input type="submit" value="Save" class="button button-primary button-large">
        </div><!-- #options-container -->
    </form>
</div>
<? } 

function media_selector_print_scripts() {
	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 ); ?>
	<script type='text/javascript'>
		jQuery(document).ready( function( $ ) {
			jQuery('.activate_ad').change(function(){
				var c = this.checked ? '1' : '0';
				jQuery('.activate_ad').val(c);
			});
			var file_frame;
			// var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php // echo $my_saved_attachment_post_id; ?> + '4'; // Set this
			jQuery('#upload_image_button').on('click', function( event ){
				event.preventDefault();
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}
				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.id );
					// // Restore the main post ID
				});
					file_frame.open();
			});
		});
</script><?php }