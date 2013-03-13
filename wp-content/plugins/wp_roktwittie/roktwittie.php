<?php
/**
 * @version   1.5 November 13, 2012
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
/*
Plugin Name: RokTwittie
Plugin URI: http://www.rockettheme.com
Description: RokTwittie is a plugin that integrates Twitter into your WordPress site. Display tweets of any username, or even by search terms, as well as your profile information and various other elements from Twitter itself.
Author: RocketTheme, LLC
Version: 1.5
Author URI: http://www.rockettheme.com
License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// No Direct Access
defined('ABSPATH') or die('Restricted access');

// Define Directory Separator
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

// Globals

global $roktwittie_plugin_path, $roktwittie_plugin_url, $browser_platform, $browser_name, $browser_version;
if(!is_multisite()) {
	$roktwittie_plugin_path = dirname($plugin);
} else {
	if(!empty($network_plugin)) {
		$roktwittie_plugin_path = dirname($network_plugin);
	} else {
		$roktwittie_plugin_path = dirname($plugin);
	}
}
$roktwittie_plugin_url = WP_PLUGIN_URL . '/' . basename($roktwittie_plugin_path);

require(dirname(__FILE__) . DS . 'rokbrowsercheck.php');

$browser_check = new RokBrowserCheck;
$browser_platform = $browser_check->platform;
$browser_name = $browser_check->name;
$browser_version = $browser_check->shortversion;

// Define Cache Dir
if (!defined('ROKTWITTIE_CACHE')) {
	define('ROKTWITTIE_CACHE', $roktwittie_plugin_path . DS . 'cache/');
}

require_once(dirname(__FILE__) . DS . 'libs' . DS . 'twitteroauth' . DS . 'twitteroauth.php');
require_once(dirname(__FILE__) . DS . 'roktwittie.class.php');

class RokTwittiePlugin {

	// RocketTheme RokTwittie Plugin
	// Port by Jakub Baran

	// Initialise Default Options
	function roktwittie_defaults() {

		$options = array(
			'use_oauth' => '0',
			'consumer_key' => '',
			'consumer_secret' => '',
			'load_css' => '1',
			'enable_cache' => '1',
			'timeout_connect' => '3',
			'timeout_response' => '6',
			'enable_cache_time' => '5',
			'usernames' => 'rockettheme',
			'inactive_opacity' => '0.5',
			'show_default_avatar' => '1',
			'header_style' => 'dark',
			'include_rts' => '1',
			'enable_statuses' => '1',
			'status_external' => '1',
			'show_feed' => '1',
			'show_follow_updates' => '1',
			'show_bio' => '1',
			'show_web' => '1',
			'show_location' => '1',
			'show_updates' => '1',
			'show_followers' => '1',
			'show_following' => '1',
			'show_following_icons' => '1',
			'following_icons_count' => '10',
			'show_viewall' => '1',
			'enable_usernames' => '1',
			'enable_usernames_avatar' => '1',
			'usernames_avatar_size' => '48',
			'usernames_count_size' => '4',
			'usernames_count_merged' => '1',
			'enable_usernames_externals' => '1',
			'enable_usernames_source' => '1',
			'enable_usernames_user' => '1',
			'enable_search' => '1',
			'search' => '@rockettheme',
			'enable_search_avatar' => '1',
			'search_avatar_size' => '48',
			'search_count_size' => '4',
			'enable_search_externals' => '1',
			'enable_search_source' => '1',
			'enable_search_user' => '1',
			'oauth_token' => '',
			'oauth_token_secret' => ''
		);
		
		add_option('roktwittie_options', $options);
	}

	// Add FrontEnd Scripts & Styles
	function roktwittie_scripts() {
		global $roktwittie_plugin_url, $post, $browser_platform, $browser_name, $browser_version;

		$option = get_option('roktwittie_options');
		
		if($option['load_css'] == '1' && (is_active_widget(false, false, 'widget-roktwittie', true) || preg_match('/\[roktwittie\]/i', $post->post_content))) {
			// Enqueue Style 
			wp_enqueue_style('roktwittie_css', $roktwittie_plugin_url . '/css/roktwittie.css');
	
			// Add IE6, IE7 and IE8 css style fixes
			if($browser_name == 'ie') :
				wp_enqueue_style('rokstories_css_ie' . $browser_version, $roktwittie_plugin_url . '/css/roktwittie-ie' . $browser_version . '.css');
			endif;
		}
		
		if(!is_admin() && (is_active_widget(false, false, 'widget-roktwittie', true) || preg_match('/\[roktwittie\]/i', $post->post_content))) {
			// Enqueue JS
			wp_enqueue_script('roktwittie_js', $roktwittie_plugin_url . '/js/roktwittie.js');
		}
	}
	
	// Inline Head Script
	function roktwittie_loadScripts() {
		global $post;
	
		$option = get_option('roktwittie_options');
		$id = 'roktwittie';

		$enable_usernames = ($option['enable_usernames'] == '1') ? 1 : 0;
		$usernames = str_replace(" ", "", $option['usernames']);
		$enable_usernames_avatar = ($option['enable_usernames_avatar'] == '1') ? 1 : 0;
		$usernames_avatar_size = $option['usernames_avatar_size'];
		$usernames_count_size = $option['usernames_count_size'];
		$enable_usernames_externals = ($option['enable_usernames_externals'] == '1') ? 1 : 0;
		$enable_usernames_source = ($option['enable_usernames_source'] == '1') ? 1 : 0;
		$enable_usernames_user = ($option['enable_usernames_user'] == '1') ? 1 : 0;
		$show_default_avatar = ($option['show_default_avatar'] == '1') ? 1 : 0;
		$inactive_opacity = $option['inactive_opacity'];
		$usernames_count_merged = ($option['usernames_count_merged'] == '1') ? 1 : 0;
		
		if ($enable_usernames_avatar) $user_avatar = $usernames_avatar_size;
		else $user_avatar = 0;
	
		$enable_search = ($option['enable_search'] == '1') ? 1 : 0;
		$search = $option['search'];
		$enable_search_avatar = ($option['enable_search_avatar'] == '1') ? 1 : 0;
		$search_avatar_size = $option['search_avatar_size'];
		$search_count_size = $option['search_count_size'];
		$enable_search_externals = ($option['enable_search_externals'] == '1') ? 1 : 0;
		$enable_search_source = ($option['enable_search_source'] == '1') ? 1 : 0;
		$enable_search_user = ($option['enable_search_user'] == '1') ? 1 : 0;
		$include_rts = ($option['include_rts'] == '1') ? 1 : 0;
		
		if ($enable_search_avatar) $search_avatar = $search_avatar_size;
		else $search_avatar = 0;
		if (!strlen($search)) $search = 0;
		else $search = '\''.$search.'\'';
		if (!$enable_search) $search = 0;
		
		$usernames = explode(",", $usernames);
		$usernames = "['".implode("', '", $usernames)."']";
		if (!$enable_usernames) $usernames = 0;
		
		$messages = self::request($option, $id, 'messages');
		$messages = json_encode(is_array($messages) && count($messages) > 0 ? $messages : null);

		$js_init = "<!--//--><![CDATA[//><!--
	window.addEvent('domready', function() {
		new RokTwittie({
			username: $usernames,
			query: $search,
			defaultAvatar: $show_default_avatar,
			avatar: { user: {$user_avatar}, query: {$search_avatar} },
			count: { user: {$usernames_count_size}, query: {$search_count_size}, merge: {$usernames_count_merged} },
			external: {	user: {$enable_usernames_externals}, query: {$enable_search_externals} },
			showSource: { user: {$enable_usernames_source}, query: {$enable_search_source} },
			showUser: {	user: {$enable_usernames_user},	query: {$enable_search_user} },
			includeRts: { user: {$include_rts}},
			inactiveOpacity: $inactive_opacity,
			lang: {
				viewTweet: '" . __('view tweet on twitter', 'roktwittie') . "',
				from: '" . __('From', 'roktwittie') . "',
				lessThanAMin: '" . __('less than a minute ago', 'roktwittie') . "',
				about: '" . __('about', 'roktwittie') . "',
				aboutAMin: '" . __('about a minute ago', 'roktwittie') . "',
				minutesAgo: '" . __('minutes ago', 'roktwittie') . "',
				aboutAHour: '" . __('about a hour ago', 'roktwittie') . "',
				hoursAgo: '" . __('hours ago', 'roktwittie') . "',
				oneDay: '" . __('1 day ago', 'roktwittie') . "',
				daysAgo: '" . __('days Ago', 'roktwittie') . "'
			},
			messages: {$messages}
		});
	});
	//--><!]]>";

		if(is_active_widget(false, false, 'widget-roktwittie', true) || preg_match('/\[roktwittie\]/i', $post->post_content)) {
			echo "<script type=\"text/javascript\">\n$js_init\n</script>\n";
		}
	
	}
	
	// Request data from twitter api
	function request($option, $id, $type) {
	 	$roktwittie = new rokTwittie($option, $id);
		
		$output = $roktwittie->makeRequest($type);
		
		return $output;
	}
	
	// Get Oauth library
	function getOauth($option, $oauth_token = null, $oauth_token_secret = null) {
		
		$consumer_key = trim($option['consumer_key']);
		$consumer_secret = trim($option['consumer_secret']);
		
		$oauth_token = isset($oauth_token) ? $oauth_token : $option['oauth_token'];
		$oauth_token_secret = isset($oauth_token_secret) ? $oauth_token_secret : $option['oauth_token_secret'];
		
		if ($consumer_key == '' || $consumer_secret == '' || $option['use_oauth'] != '1') {
			return false;
		}

		$oauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		
		return $oauth;
	}
	
	// RokTwittie Main
	function roktwittie_render() {
		global $roktwittie_plugin_path, $roktwittie_plugin_url;
		
		$option = get_option('roktwittie_options');
		$id = 'roktwittie';
		
		if ($option['enable_statuses'] == '1' || $option['enable_usernames'] == '1' || $option['enable_search'] == '1') {
			$status = self::request($option, $id, 'status');
			$friends = self::request($option, $id, 'friends');
		
			if (is_array($status) && is_array($friends)) {
				if(file_exists(TEMPLATEPATH . DS . 'html' . DS . 'plugins' . DS . 'wp_roktwittie' . DS . 'default.php')) :
			  		require(TEMPLATEPATH . DS . 'html' . DS . 'plugins' . DS . 'wp_roktwittie' . DS . 'default.php');
			  	else :
	  		  		require($roktwittie_plugin_path . DS . 'tmpl' . DS . 'default.php');
	  		  	endif;
			}
			else
				if(file_exists(TEMPLATEPATH . DS . 'html' . DS . 'plugins' . DS . 'wp_roktwittie' . DS . 'error.php')) :
			  		require(TEMPLATEPATH . DS . 'html' . DS . 'plugins' . DS . 'wp_roktwittie' . DS . 'error.php');
			  	else :
	  		  		require($roktwittie_plugin_path . DS . 'tmpl' . DS . 'error.php');
	  		  	endif;
		} else {
			if(file_exists(TEMPLATEPATH . DS . 'html' . DS . 'plugins' . DS . 'wp_roktwittie' . DS . 'error.php')) :
		  		require(TEMPLATEPATH . DS . 'html' . DS . 'plugins' . DS . 'wp_roktwittie' . DS . 'error.php');
		  	else :
  		  		require($roktwittie_plugin_path . DS . 'tmpl' . DS . 'error.php');
  		  	endif;
		}
		
	}
	
	function roktwittie_shortcode($atts, $content = null) {
		return self::roktwittie_render();
	}
	
	// Plugin settings button
	function roktwittie_admin() {
		add_plugins_page('RokTwittie Settings', 'RokTwittie', 'activate_plugins', 'roktwittie-settings', array('RokTwittiePlugin', 'roktwittie_settings'));  
	}
	
	// Add BackEnd Scripts & Styles
	function roktwittie_adminscripts() {
		global $roktwittie_plugin_url, $pagenow;
		
		if($pagenow == 'plugins.php' && $_GET['page'] == 'roktwittie-settings') {
			// Enqueue CSS
			wp_enqueue_style('roktwittieadmin_css', $roktwittie_plugin_url . '/admin/css/admin.css');
			// Enqueue JS
			wp_enqueue_script('roktwittie_oauth_js', $roktwittie_plugin_url . '/admin/js/oauth.js');
		}
	}
	
	// Register Settings	
	function roktwittie_regsettings() {
		register_setting('roktwittie_registered', 'roktwittie_options');
	}
	
	// Settings Page
	function roktwittie_settings() {
		global $roktwittie_plugin_url;
	
		$option = get_option('roktwittie_options');

		if(isset($_GET['message'])) echo '<div id="message" class="updated fade"><p>' . urldecode($_GET['message']) . '</p></div>';
		if(isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') echo '<div id="message" class="updated fade"><p>' . __('RokTwittie settings saved.', 'roktwittie') . '</p></div>';

		?>
		
		<div class="wrap" id="roktwittie-settings">
		
			<div id="icon-options-roktwittie" class="icon32"><br /></div>
			<h2><?php _e('RokTwittie Settings', 'roktwittie'); ?></h2>
			<div class="clear"></div>
			
			<form method="post" action="options.php">
				<?php settings_fields('roktwittie_registered'); ?>
				<table class="widefat fixed rokplugin" cellspacing="0">
					<thead>
						<tr>
							<th class="manage-column column-title desc" scope="col">
								<?php _e('Option Name', 'roktwittie'); ?>
							</th>
							<th class="manage-column column-title desc" scope="col">
								<?php _e('Value', 'roktwittie'); ?>
							</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>
								<a href="http://rockettheme.com" target="_blank" id="rtlogo"></a>				
							</th>
							<th>
								<input type="submit" class="button-primary" value="<?php _e('Save Changes', 'roktwittie'); ?>" />
							</th>
						</tr>
					</tfoot>
					<tbody>
						<tr>
							<td>
								<strong><?php _e('Status', 'roktwittie'); ?></strong>
							</td>
							<td>
								<?php echo self::getInput(); ?>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Use OAuth', 'roktwittie'); ?></strong>
							</td>
							<td>
								<p><?php _e('Enabling this requires registering your website as Twitter application, more about it', 'roktwittie'); ?> <a href="http://www.rockettheme.com/extensions-joomla/roktwittie#registration" target="_blank"><?php _e('here', 'roktwittie'); ?></a>.</p>
								<input id="use_oauth1" type="radio" <?php if ($option['use_oauth'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[use_oauth]"/>
								<label for="use_oauth1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="use_oauth0" type="radio" <?php if ($option['use_oauth'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[use_oauth]"/>
								<label for="use_oauth0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Twitter APP consumer key', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="consumer_key" type="text" size="50" maxlength="255" name="roktwittie_options[consumer_key]" value="<?php echo $option['consumer_key']; ?>" />
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Twitter APP consumer secret', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="consumer_secret" type="text" size="50" maxlength="255" name="roktwittie_options[consumer_secret]" value="<?php echo $option['consumer_secret']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Authenticate', 'roktwittie'); ?></strong>
							</td>
							<td>
								<?php

									($option['consumer_key'] != '' && $option['consumer_secret'] != '') ? $oauth_id = true : $oauth_id = false;
									$image = $roktwittie_plugin_url . '/admin/images/oauth.png';
									$url = $roktwittie_plugin_url . "/api.php?task=redirect&cid=roktwittie";

									if (!$oauth_id) {
										echo '<span id="signin-key">' . __('Save the settings first', 'roktwittie') . '</span>';
									} else {
										echo '<a id="signin-key" href="' . $url . '"><img src="' . $image . '" alt="Sign in with Twitter"/></a>';
									}
								
								?>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Load built-in StyleSheet', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="load_css1" type="radio" <?php if ($option['load_css'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[load_css]"/>
								<label for="load_css1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="load_css0" type="radio" <?php if ($option['load_css'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[load_css]"/>
								<label for="load_css0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Output Caching', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_cache1" type="radio" <?php if ($option['enable_cache'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_cache]"/>
								<label for="enable_cache1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_cache0" type="radio" <?php if ($option['enable_cache'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_cache]"/>
								<label for="enable_cache0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Timeout on connect (secs)', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[timeout_connect]" value="<?php echo $option['timeout_connect']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Timeout on response (secs)', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[timeout_response]" value="<?php echo $option['timeout_response']; ?>" />
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Cache time (mins)', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[enable_cache_time]" value="<?php echo $option['enable_cache_time']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Usernames, separated by comma', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[usernames]" value="<?php echo $option['usernames']; ?>" />
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Inactive users opacity', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[inactive_opacity]" value="<?php echo $option['inactive_opacity']; ?>" />
							</td>
						</tr>
						<tr class="separator">
							<td>
								<strong><?php _e('Username Statuses', 'roktwittie'); ?></strong>
							</td>
							<td>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Show default avatars', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_default_avatar1" type="radio" <?php if ($option['show_default_avatar'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_default_avatar]"/>
								<label for="show_default_avatar1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_default_avatar0" type="radio" <?php if ($option['show_default_avatar'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_default_avatar]"/>
								<label for="show_default_avatar0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Header style', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="header_style1" type="radio" <?php if ($option['header_style'] == 'light') : ?>checked="checked"<?php endif; ?> value="light" name="roktwittie_options[header_style]"/>
								<label for="header_style1"><?php _e('Light', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="header_style0" type="radio" <?php if ($option['header_style'] == 'dark') : ?>checked="checked"<?php endif; ?> value="dark" name="roktwittie_options[header_style]"/>
								<label for="header_style0"><?php _e('Dark', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Include ReTweets', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="include_rts1" type="radio" <?php if ($option['include_rts'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[include_rts]"/>
								<label for="include_rts1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="include_rts0" type="radio" <?php if ($option['include_rts'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[include_rts]"/>
								<label for="include_rts0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Enable usernames statuses', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_statuses1" type="radio" <?php if ($option['enable_statuses'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_statuses]"/>
								<label for="enable_statuses1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_statuses0" type="radio" <?php if ($option['enable_statuses'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_statuses]"/>
								<label for="enable_statuses0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Open links in new window', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="status_external1" type="radio" <?php if ($option['status_external'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[status_external]"/>
								<label for="status_external1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="status_external0" type="radio" <?php if ($option['status_external'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[status_external]"/>
								<label for="status_external0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Show the RSS Feed link', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_feed1" type="radio" <?php if ($option['show_feed'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_feed]"/>
								<label for="show_feed1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_feed0" type="radio" <?php if ($option['show_feed'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_feed]"/>
								<label for="show_feed0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Show follow updates link', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_follow_updates1" type="radio" <?php if ($option['show_follow_updates'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_follow_updates]"/>
								<label for="show_follow_updates1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_follow_updates0" type="radio" <?php if ($option['show_follow_updates'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_follow_updates]"/>
								<label for="show_follow_updates0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Show the bio description', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_bio1" type="radio" <?php if ($option['show_bio'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_bio]"/>
								<label for="show_bio1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_bio0" type="radio" <?php if ($option['show_bio'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_bio]"/>
								<label for="show_bio0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Show the URL', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_web1" type="radio" <?php if ($option['show_web'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_web]"/>
								<label for="show_web1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_web0" type="radio" <?php if ($option['show_web'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_web]"/>
								<label for="show_web0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Show the location', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_location1" type="radio" <?php if ($option['show_location'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_location]"/>
								<label for="show_location1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_location0" type="radio" <?php if ($option['show_location'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_location]"/>
								<label for="show_location0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Show user updates count', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_updates1" type="radio" <?php if ($option['show_updates'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_updates]"/>
								<label for="show_updates1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_updates0" type="radio" <?php if ($option['show_updates'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_updates]"/>
								<label for="show_updates0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Show user followers count', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_followers1" type="radio" <?php if ($option['show_followers'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_followers]"/>
								<label for="show_followers1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_followers0" type="radio" <?php if ($option['show_followers'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_followers]"/>
								<label for="show_followers0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Show user following count', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_following1" type="radio" <?php if ($option['show_following'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_following]"/>
								<label for="show_following1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_following0" type="radio" <?php if ($option['show_following'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_following]"/>
								<label for="show_following0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Show following icons', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_following_icons1" type="radio" <?php if ($option['show_following_icons'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_following_icons]"/>
								<label for="show_following_icons1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_following_icons0" type="radio" <?php if ($option['show_following_icons'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_following_icons]"/>
								<label for="show_following_icons0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Icons count to show', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[following_icons_count]" value="<?php echo $option['following_icons_count']; ?>" />
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Show View all after icons', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="show_viewall1" type="radio" <?php if ($option['show_viewall'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[show_viewall]"/>
								<label for="show_viewall1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="show_viewall0" type="radio" <?php if ($option['show_viewall'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[show_viewall]"/>
								<label for="show_viewall0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="separator">
							<td>
								<strong><?php _e('Username Tweets', 'roktwittie'); ?></strong>
							</td>
							<td>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Enable usernames tweets', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_usernames1" type="radio" <?php if ($option['enable_usernames'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_usernames]"/>
								<label for="enable_usernames1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_usernames0" type="radio" <?php if ($option['enable_usernames'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_usernames]"/>
								<label for="enable_usernames0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Show usernames avatars', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_usernames_avatar1" type="radio" <?php if ($option['enable_usernames_avatar'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_usernames_avatar]"/>
								<label for="enable_usernames_avatar1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_usernames_avatar0" type="radio" <?php if ($option['enable_usernames_avatar'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_usernames_avatar]"/>
								<label for="enable_usernames_avatar0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Size in pixel of the avatar', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[usernames_avatar_size]" value="<?php echo $option['usernames_avatar_size']; ?>" />
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Tweets count', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[usernames_count_size]" value="<?php echo $option['usernames_count_size']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Merge Tweets', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="usernames_count_merged1" type="radio" <?php if ($option['usernames_count_merged'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[usernames_count_merged]"/>
								<label for="usernames_count_merged1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="usernames_count_merged0" type="radio" <?php if ($option['usernames_count_merged'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[usernames_count_merged]"/>
								<label for="usernames_count_merged0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Open links in new window', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_usernames_externals1" type="radio" <?php if ($option['enable_usernames_externals'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_usernames_externals]"/>
								<label for="enable_usernames_externals1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_usernames_externals0" type="radio" <?php if ($option['enable_usernames_externals'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_usernames_externals]"/>
								<label for="enable_usernames_externals0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Show tweets sources', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_usernames_source1" type="radio" <?php if ($option['enable_usernames_source'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_usernames_source]"/>
								<label for="enable_usernames_source1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_usernames_source0" type="radio" <?php if ($option['enable_usernames_source'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_usernames_source]"/>
								<label for="enable_usernames_source0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Show usernames as prepended text', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_usernames_user1" type="radio" <?php if ($option['enable_usernames_user'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_usernames_user]"/>
								<label for="enable_usernames_user1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_usernames_user0" type="radio" <?php if ($option['enable_usernames_user'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_usernames_user]"/>
								<label for="enable_usernames_user0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="separator">
							<td>
								<strong><?php _e('Search Tweets', 'roktwittie'); ?></strong>
							</td>
							<td>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Enable search tweets', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_search1" type="radio" <?php if ($option['enable_search'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_search]"/>
								<label for="enable_search1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_search0" type="radio" <?php if ($option['enable_search'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_search]"/>
								<label for="enable_search0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Search string', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[search]" value="<?php echo $option['search']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Show search avatars', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_search_avatar1" type="radio" <?php if ($option['enable_search_avatar'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_search_avatar]"/>
								<label for="enable_search_avatar1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_search_avatar0" type="radio" <?php if ($option['enable_search_avatar'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_search_avatar]"/>
								<label for="enable_search_avatar0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Size in pixel of the avatar', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[search_avatar_size]" value="<?php echo $option['search_avatar_size']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Tweets count', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input type="text" size="50" maxlength="255" name="roktwittie_options[search_count_size]" value="<?php echo $option['search_count_size']; ?>" />
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Open links in new window', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_search_externals1" type="radio" <?php if ($option['enable_search_externals'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_search_externals]"/>
								<label for="enable_search_externals1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_search_externals0" type="radio" <?php if ($option['enable_search_externals'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_search_externals]"/>
								<label for="enable_search_externals0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr>
							<td>
								<strong><?php _e('Show tweets sources', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_search_source1" type="radio" <?php if ($option['enable_search_source'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_search_source]"/>
								<label for="enable_search_source1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_search_source0" type="radio" <?php if ($option['enable_search_source'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_search_source]"/>
								<label for="enable_search_source0"><?php _e('No', 'roktwittie'); ?></label>
							</td>
						</tr>
						<tr class="alternate">
							<td>
								<strong><?php _e('Show usernames as prepended text', 'roktwittie'); ?></strong>
							</td>
							<td>
								<input id="enable_search_user1" type="radio" <?php if ($option['enable_search_user'] == '1') : ?>checked="checked"<?php endif; ?> value="1" name="roktwittie_options[enable_search_user]"/>
								<label for="enable_search_user1"><?php _e('Yes', 'roktwittie'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
								<input id="enable_search_user0" type="radio" <?php if ($option['enable_search_user'] == '0') : ?>checked="checked"<?php endif; ?> value="0" name="roktwittie_options[enable_search_user]"/>
								<label for="enable_search_user0"><?php _e('No', 'roktwittie'); ?></label>
								
								<!-- Hidden Fields -->
								<input type="hidden" size="20" maxlength="255" name="roktwittie_options[oauth_token]" value="<?php echo $option['oauth_token']; ?>" />
								<input type="hidden" size="20" maxlength="255" name="roktwittie_options[oauth_token_secret]" value="<?php echo $option['oauth_token_secret']; ?>" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>
			
		</div>
		
		<?php
			
	}
	
	private function getStatus($message, $color = 'green') {
		switch($color) {
			case 'green':
				$color = 'green';
				break;
			case 'red':
				$color = 'red';
				break;
			case 'yellow':
				$color = '#FF9900';
				break;
		}
				
		return '<span style="color:' . $color . ';display:block;width: 100%;"><b>' . $message . '</b></span>';
	}

	public function getInput() {

		$option = get_option('roktwittie_options');

		if (!extension_loaded('curl')) {
			return self::getStatus(__('CURL extension is not enabled, contact your administrator.', 'roktwittie'), 'red');
		}

		if ($option['use_oauth'] == '0') {
			return self::getStatus(__('Using anonymous mode.', 'roktwittie'), 'green');
		}

		if ($option['consumer_key'] == '' || $option['consumer_secret'] == '') {
			return self::getStatus(__('Consumer keys are not setup! Using anonymous mode.', 'roktwittie'), 'red');
		}

		if ($option['oauth_token'] == '' || $option['oauth_token_secret'] == '') {
			return self::getStatus('Authentication is not completed! Using anonymous mode.', 'yellow');
		}

		return self::getStatus('Using authenticated mode.', 'green');
	}

}

// Widget
class RokTwittieWidget extends WP_Widget {

	// RocketTheme RokTwittie Widget
	// Port by Jakub Baran

    static $plugin_path;
    static $plugin_url;

    var $short_name = 'widget-roktwittie';
    var $long_name = 'RokTwittie';
    var $description = 'RocketTheme RokTwittie Widget';
    var $css_classname = 'widget_roktwittie';
    var $width = 200;
    var $height = 400;

    var $_defaults = array(
        'title' => ''				
    );

    function init() {
    	global $browser_platform;
    	
    	// Don't show RokTwittie on iPhone or Android platform
    	if($browser_platform != 'iphone' || $browser_platform != 'android') :
	        register_widget("RokTwittieWidget");
    	endif;
    }
	
    function render($args, $instance) {
        global $roktwittie_plugin_path, $roktwittie_plugin_url;
        
        ob_start();
        
        // Before Widget
        echo $args['before_widget'];
        
        // Widget Title
        if($instance['title'] != '')
 		echo $args['before_title'] . $instance['title'] . $args['after_title'];
 		
 		// Render RokTwittie

		do_shortcode('[roktwittie]');
              
        // After Widget
        echo $args['after_widget'];
        
        echo ob_get_clean();
    }
    
    function form($instance) {
    	global $roktwittie_plugin_path, $roktwittie_plugin_url;
        $defaults = $this->_defaults;
  		$instance = wp_parse_args((array) $instance, $defaults);
        foreach ($instance as $variable => $value)
        {
            $$variable = self::_cleanOutputVariable($variable, $value);
            $instance[$variable] = $$variable;
        }
        $this->_values = $instance;
        
        ob_start();
        
        ?>
		
		<!-- Begin RokTwittie Widget Admin -->
		
		<div class="roktwittie-admin-wrapper">
			<p>
		        <label for="<?php echo $this->get_field_id('title'); ?>">
		        	<?php _e('Title:', 'roktwittie'); ?>
		        </label>
		    	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	    	</p>
		</div>
		
		<!-- End RokTwittie Widget Admin -->
	
		<?php
	
        echo ob_get_clean();
    }
    
    /********** Bellow here should not need to be changed ***********/

    function __construct() {
        if (empty($this->short_name) || empty($this->long_name)) {
            die('A widget must have a valid type and classname defined');
        }
        $widget_options = array('classname' => $this->css_classname, 'description' => __($this->description));
        $control_options = array('width' => $this->width, 'height' => $this->height);
        parent::__construct($this->short_name, $this->long_name, $widget_options, $control_options);
    }

    function _cleanOutputVariable($variable, $value) {
        if (is_string($value)) {
        	return htmlspecialchars($value);
        }
        elseif (is_array($value)) {
            foreach ($value as $subvariable => $subvalue) {
                $value[$subvariable] = GantryWidgetRokMenu::_cleanOutputVariable($subvariable, $subvalue);
            }
            return $value;
        }
        return $value;
    }

    function _cleanInputVariable($variable, $value) {
        if (is_string($value)) {
            return stripslashes($value);
        }
        elseif (is_array($value)) {
            foreach ($value as $subvariable => $subvalue) {
                $value[$subvariable] = GantryWidgetRokMenu::_cleanInputVariable($subvariable, $subvalue);
            }
            return $value;
        }
        return $value;
    }

    function widget($args, $instance){
        global $gantry;
 		extract($args);
        $defaults = $this->_defaults;
        $instance = wp_parse_args((array) $instance, $defaults);
        foreach ($instance as $variable => $value)
        {
            $$variable = self::_cleanOutputVariable($variable, $value);
            $instance[$variable] = $$variable;
        }
        
        $this->render($args, $instance);
        
    }

}

RokTwittieWidget::$plugin_path = dirname($plugin);
RokTwittieWidget::$plugin_url = WP_PLUGIN_URL . '/' . basename(RokTwittieWidget::$plugin_path);

add_action('admin_menu', array('RokTwittiePlugin', 'roktwittie_admin'), 9);
add_action('admin_init', array('RokTwittiePlugin', 'roktwittie_regsettings'));
add_action('admin_enqueue_scripts', array('RokTwittiePlugin', 'roktwittie_adminscripts'));
add_action('init', array('RokTwittiePlugin', 'roktwittie_defaults'));

// Don't load RokTwittie on iPhone & Android
if($browser_platform != 'iphone' && $browser_platform != 'android') {
	add_action('widgets_init', array('RokTwittieWidget', 'init'));
	add_action('wp_enqueue_scripts', array('RokTwittiePlugin', 'roktwittie_scripts'));
	add_action('wp_head', array('RokTwittiePlugin', 'roktwittie_loadScripts'));
	add_shortcode('roktwittie', array('RokTwittiePlugin', 'roktwittie_shortcode'));
}

// Load Language
load_plugin_textdomain('roktwittie', false, basename($roktwittie_plugin_path) . DS . 'languages' . DS);

// MooTools Enqueue Script
add_action('init', 'roktwittie_mootools_init', -50);

function roktwittie_mootools_init(){
	global $roktwittie_plugin_url;
    wp_register_script('mootools.js', $roktwittie_plugin_url . '/js/mootools.js');
	wp_enqueue_script('mootools.js');
}

?>