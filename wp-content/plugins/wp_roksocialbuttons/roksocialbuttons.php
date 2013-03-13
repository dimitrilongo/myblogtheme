<?php
/**
 * @version   1.0.1 October 13, 2012
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
/*
Plugin Name: RokSocialButtons
Plugin URI: http://www.rockettheme.com
Description: RocketTheme Social Buttons Plugin
Author: RocketTheme, LLC
Version: 1.0.1
Author URI: http://www.rockettheme.com
License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/
// no direct access
defined('ABSPATH') or die('Restricted access');

// Define Directory Separator
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

// Globals
global $roksocialbuttons_plugin_path, $roksocialbuttons_plugin_url;
if(!is_multisite()) {
	$roksocialbuttons_plugin_path = dirname($plugin);
} else {
	if(!empty($network_plugin)) {
		$roksocialbuttons_plugin_path = dirname($network_plugin);
	} else {
		$roksocialbuttons_plugin_path = dirname($plugin);
	}
}
$roksocialbuttons_plugin_url = WP_PLUGIN_URL . '/' . basename($roksocialbuttons_plugin_path);

class RokSocialButtons {

	// Init
	static function init() {
		global $roksocialbuttons_plugin_path;

		// Add Shortcode
		add_shortcode('socialbuttons', array(__CLASS__, 'roksocialbuttons_shortcode'));

		// Add Scripts
		add_action('wp_enqueue_scripts', array(__CLASS__, 'roksocialbuttons_scripts'));

		// Load Language
		if(is_admin()) {
			load_plugin_textdomain('roksocialbuttons', false, basename($roksocialbuttons_plugin_path) . '/languages/');
		}

		// Add Admin
		add_action('admin_menu', array(__CLASS__, 'roksocialbuttons_menu'), 9);
		add_action('admin_enqueue_scripts', array(__CLASS__, 'roksocialbuttons_adminscripts'));
		add_action('admin_init', array(__CLASS__, 'roksocialbuttons_register_settings'));

		// Setup initial options
		$defaults = array(
			'addthis_id' => '',
			'enable_twitter' => '1',
			'enable_facebook' => '1',
			'enable_google' => '1',
			'prepend_text' => '',
			'extra_class' => ''
		);

		add_option('roksocialbuttons', $defaults);
	}

	// Admin menu
	function roksocialbuttons_menu() {
		add_plugins_page('RokSocialButtons', 'RokSocialButtons', 'activate_plugins', 'roksocialbuttons-settings', array(__CLASS__, 'roksocialbuttons_settings'));  
	}

	// Admin Scripts
	function roksocialbuttons_adminscripts() {
		global $roksocialbuttons_plugin_url, $pagenow;
		
		if($pagenow == 'plugins.php' && $_GET['page'] == 'roksocialbuttons-settings') {
			wp_enqueue_style('roksocialbuttons_admin_css', $roksocialbuttons_plugin_url . '/admin/admin.css');
		}
	}

	// Admin Register Settings
	function roksocialbuttons_register_settings() {
		register_setting('roksocialbuttons_registered', 'roksocialbuttons');
	}

	// Admin Page
	function roksocialbuttons_settings() {
		global $roksocialbuttons_plugin_url;
	
		$option = get_option('roksocialbuttons');

		if(isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') echo '<div id="message" class="updated fade"><p>' . __('RokSocialButtons settings saved.', 'roksocialbuttons') . '</p></div>';
		
		?>

		<div class="wrap" id="roksocialbuttons-settings">
		
			<div id="icon-options-roksocialbuttons" class="icon32"></div>
			<h2><?php _e('RokSocialButtons Settings', 'roksocialbuttons'); ?></h2>
			<div class="clear"></div>
			
			<form method="post" action="options.php">
				<?php settings_fields('roksocialbuttons_registered'); ?>
				<table class="widefat fixed rokplugin" cellspacing="0">
					<thead>
						<tr>
							<th class="manage-column column-title desc" scope="col">
								<?php _e('Option Name', 'roksocialbuttons'); ?>
							</th>
							<th class="manage-column column-title desc" scope="col">
								<?php _e('Value', 'roksocialbuttons'); ?>
							</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>
								<a href="http://rockettheme.com" target="_blank" id="rtlogo"></a>				
							</th>
							<th>
								<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'roksocialbuttons'); ?>" />
							</th>
						</tr>
					</tfoot>
					<tbody>
						<tr>
							<td>
								<strong><?php _e('AddThis ID', 'roksocialbuttons'); ?></strong><br />
								<?php _e('Insert your AddThis ID to enable tracking and analytics. Sign-up for a free account at http://www.addthis.com', 'roksocialbuttons'); ?>
							</td>
							<td>
								<input id="addthis_id" type="text" size="50" maxlength="255" name="roksocialbuttons[addthis_id]" value="<?php echo $option['addthis_id']; ?>" />
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Enable Twitter', 'roksocialbuttons'); ?></strong>
							</td>
							<td>
								<input id="enable_twitter1" type="radio" <?php if ($option['enable_twitter'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roksocialbuttons[enable_twitter]"/>
								<label for="enable_twitter1"><?php _e('Enabled', 'roksocialbuttons'); ?></label>
								<input id="enable_twitter0" type="radio" <?php if ($option['enable_twitter'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roksocialbuttons[enable_twitter]"/>
								<label for="enable_twitter0"><?php _e('Disabled', 'roksocialbuttons'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Enable Facebook', 'roksocialbuttons'); ?></strong>
							</td>
							<td>
								<input id="enable_facebook1" type="radio" <?php if ($option['enable_facebook'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roksocialbuttons[enable_facebook]"/>
								<label for="enable_facebook1"><?php _e('Enabled', 'roksocialbuttons'); ?></label>
								<input id="enable_facebook0" type="radio" <?php if ($option['enable_facebook'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roksocialbuttons[enable_facebook]"/>
								<label for="enable_facebook0"><?php _e('Disabled', 'roksocialbuttons'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Enable Google', 'roksocialbuttons'); ?></strong>
							</td>
							<td>
								<input id="enable_google1" type="radio" <?php if ($option['enable_google'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roksocialbuttons[enable_google]"/>
								<label for="enable_google1"><?php _e('Enabled', 'roksocialbuttons'); ?></label>
								<input id="enable_google0" type="radio" <?php if ($option['enable_google'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roksocialbuttons[enable_google]"/>
								<label for="enable_google0"><?php _e('Disabled', 'roksocialbuttons'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Prepend Text', 'roksocialbuttons'); ?></strong>
							</td>
							<td>
								<input id="prepend_text" type="text" size="50" maxlength="255" name="roksocialbuttons[prepend_text]" value="<?php echo $option['prepend_text']; ?>" />
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Extra CSS Class', 'roksocialbuttons'); ?></strong>
							</td>
							<td>
								<input id="extra_class" type="text" size="50" maxlength="255" name="roksocialbuttons[extra_class]" value="<?php echo $option['extra_class']; ?>" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			
		</div>

		<?php
	}

	// Add Scripts
	static function roksocialbuttons_scripts() {
		global $roksocialbuttons_plugin_path, $roksocialbuttons_plugin_url;

		if (!defined("ROKSOCIALBUTTONS")) {
			define("ROKSOCIALBUTTONS", 1);

			$option = get_option('roksocialbuttons');

			$script = 'http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$option['addthis_id'];

			// use template stylesheet if it exists
			$builtin_path = '/assets/roksocialbuttons.css';
			$template_path = '/html/plugins/wp_roksocialbuttons/roksocialbuttons.css';
			$template_stylesheet = get_template_directory() . $template_path;

			if (file_exists($template_stylesheet)) $stylesheet = get_template_directory_uri() . $template_path;
			else $stylesheet = $roksocialbuttons_plugin_url . $builtin_path;

			// get css from theme or plugin
			wp_enqueue_style('roksocialbuttons.css', $stylesheet);
			wp_enqueue_script('addthis_widget.js', $script);
		}
		
	}

	// Define the shortcode
	static function roksocialbuttons_shortcode() {
		$option = get_option('roksocialbuttons');

		$extra_class = isset($option['extra_class']) ? $option['extra_class'] : '';

		$code = '
			<div class="roksocialbuttons addthis_toolbox '.$extra_class.'"
			   addthis:url="'.get_permalink().'"
			   addthis:title="'.get_the_title().'">
			<div class="custom_images">';
		if (trim($option['prepend_text']) != "") {
			$code .= '<h4>'.$option['prepend_text'].'</h4>';
		}
		if ($option['enable_twitter'] == '1') {
			$code .= '<a class="addthis_button_twitter"><span></span></a>';
		}
		if ($option['enable_facebook'] == '1') {
			$code .= '<a class="addthis_button_facebook"><span></span></a>';
		}
		if ($option['enable_google'] == '1') {
			$code .= '<a class="addthis_button_google"><span></span></a>';
		}
		$code .= '
			</div>
			</div>';

		return $code;
	}
}

// Init the plugin
RokSocialButtons::init();

?>