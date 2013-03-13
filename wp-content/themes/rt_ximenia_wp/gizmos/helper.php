<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

defined('GANTRY_VERSION') or die();

gantry_import('core.gantrygizmo');

/**
 * @package     gantry
 * @subpackage  features
 */
class GantryGizmoHelper extends GantryGizmo {

	var $_name = 'helper';

	function isEnabled() {
		return true;
	}

	function admin_init() {
		global $gantry, $pagenow, $wp_version;
		add_action('widgets_init', array(&$this, 'unregister_gantry_mobile_menu'));

		if ($gantry->get('custom_widget_background')) {
			add_action('in_widget_form', array(&$this, 'gantry_add_widget_background_action'), 1, 3);
			add_filter('widget_update_callback', array(&$this, 'gantry_widget_background_udpate_filter'), 1, 3);
			if($pagenow == 'widgets.php' && version_compare($wp_version, '3.5', '>=')) {
				$js = "// Uploading files
					var file_frame;

					jQuery('[id$=-custom-bg-upload]').live('click', function( event ) {

						event.preventDefault();
						file_frame = null;

						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}

						// Create the media frame.
						file_frame = wp.media.frames.file_frame = wp.media({
							title: jQuery( this ).data( 'uploader_title' ),
							button: {
								text: jQuery( this ).data( 'uploader_button_text' ),
							},
							multiple: false  // Set to true to allow multiple files to be selected
						});

						file_frame.custom_bg_upload = jQuery(this);

						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							// We set multiple to false so only get one image from the uploader
							attachment = file_frame.state().get('selection').first().toJSON();

							// Do something with attachment.id and/or attachment.url here or do console.log(attachment) to get the list
							jQuery(file_frame.custom_bg_upload).prev().val(attachment.url);

						});

						// Finally, open the modal
						file_frame.open();
					});";

				$gantry->addInlineScript($js);
			}
		}
	}

	/* Unregister Gantry Mobile Menu widget */
	function unregister_gantry_mobile_menu() {
		unregister_widget('GantryWidgetiPhoneMenu');
	}

	/* Add Background Image field to the widgets */
	function gantry_add_widget_background_action(&$instance, &$return, $values) {
		if ($return != "noform") {
			global $gantry, $wp_version;
			if(version_compare($wp_version, '3.5', '>=')) wp_enqueue_media(); ?>
			<?php if ($gantry->get('custom_widget_background')) { ?>
				<p>
					<label for="<?php echo $instance->get_field_id('custom-background');?>"><?php _re('Background Image'); ?></label>
					<input type="text" id="<?php echo $instance->get_field_id('custom-background');?>" name="<?php echo $instance->get_field_name('custom-background')?>" value="<?php echo $values['custom-background']; ?>" size="23"/>
					<?php if(version_compare($wp_version, '3.5', '>=')) : ?>
						<input id="<?php echo $instance->get_field_id('custom-bg-upload');?>" class="button" type="button" value="Upload" />
					<?php endif; ?>
				</p>
			<?php }
		}
	}

	function gantry_widget_background_udpate_filter($instance, $new_instance, $old_instance) {
		global $gantry;
		if (array_key_exists('custom-background', $new_instance)) {
			$instance['custom-background'] = $new_instance['custom-background'];
		}
		return $instance;
	}
}