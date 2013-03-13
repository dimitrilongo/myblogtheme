<?php
/**
 * @version   1.19 November 13, 2012
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
/*
Plugin Name: RokAjaxSearch
Plugin URI: http://www.rockettheme.com
Description: RokAjaxSearch is a truly powerful plugin that brings fantastic search functionality to WordPress, using the powerful and versatile javascript library, Mootools as well as full Google Search integration.
Author: RocketTheme, LLC
Version: 1.19
Author URI: http://www.rockettheme.com
License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// Define Directory Separator

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

// Globals

global $rokajaxsearch_plugin_path, $rokajaxsearch_plugin_url, $platform;
if(!is_multisite()) {
	$rokajaxsearch_plugin_path = dirname($plugin);
} else {
	if(!empty($network_plugin)) {
		$rokajaxsearch_plugin_path = dirname($network_plugin);
	} else {
		$rokajaxsearch_plugin_path = dirname($plugin);
	}
}
$rokajaxsearch_plugin_url = WP_PLUGIN_URL . '/' . basename($rokajaxsearch_plugin_path);

require(dirname(__FILE__) . '/rokbrowser_check.php');
 
$browser_check = new RokBrowserCheck;
$platform = $browser_check->platform;


add_action('widgets_init', array("RokAjaxSearch", "init"));

// Widget

class RokAjaxSearch extends WP_Widget {

	// RocketTheme RokAjaxSearch Widget
	// Port by Jakub Baran

	static $plugin_path;
	static $plugin_url;
	var $short_name = 'rokajaxsearch';
	var $long_name = 'RokAjaxSearch';
	var $description = 'RocketTheme RokAjaxSearch Widget';
	var $css_classname = 'widget_rokajaxsearch';
	var $width = 200;
	var $height = 400;
	var $_defaults = array(
		'title' => ''
	);

	function init() {
		global $platform, $gantry;
		if($platform != 'iphone' && $platform != 'android') :
			register_widget("RokAjaxSearch");
		endif;

		if(!is_admin() && $platform != 'iphone' && $platform != 'android') {
			add_action('wp_head', 'rokajaxsearch_script', 7);
			add_action('wp_head', 'rokajaxsearch_script_inline');
		}
	}

	function render($args, $instance) {
		global $more, $post, $rokajaxsearch_plugin_path, $rokajaxsearch_plugin_url;
		
		$get_id = $args['widget_id'];
		$option = get_option('rokajaxsearch_options');
		
		ob_start();
		
		echo $args['before_widget'];
		if($instance['title'] != '')
		echo $args['before_title'] . $instance['title'] . $args['after_title'];

		if(file_exists(TEMPLATEPATH . '/html/plugins/wp_rokajaxsearch/default.php')) :	
			require(TEMPLATEPATH . '/html/plugins/wp_rokajaxsearch/default.php');
		else :
			require($rokajaxsearch_plugin_path . '/tmpl/default.php'); 
		endif;
		
		echo $args['after_widget'];
		echo ob_get_clean();
	}
	
	function form($instance) {
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
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title :', 'rokajaxsearch'); ?>&nbsp;
		<input style="width: 185px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></label>
		<br /><br />
		
		<?php
		
		echo ob_get_clean();
	}
	
	 /********** Bellow here should not need to be changed***********/

	function __construct() {
		if (empty($this->short_name) || empty($this->long_name)) {
			die("A widget must have a valid type and classname defined");
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

RokAjaxSearch::$plugin_path = dirname($plugin);
RokAjaxSearch::$plugin_url = WP_PLUGIN_URL . '/' . basename(RokAjaxSearch::$plugin_path);

// Load Language

load_plugin_textdomain('rokajaxsearch', false, basename($rokajaxsearch_plugin_path) . '/languages/');

// Add AJAX
add_action('wp_ajax_rokajaxsearch', 'rokajaxsearch_callback');
add_action('wp_ajax_nopriv_rokajaxsearch', 'rokajaxsearch_callback');

function rokajaxsearch_callback() {
	global $query_string, $more, $post, $posts, $s;
	$option = get_option('rokajaxsearch_options');
	require(ABSPATH . '/wp-blog-header.php');
	
	?>
	
	<div id="page">
		<div class="rt-wp">
			<div class="results">
				<ol start="1" class="list">
				
					<?php query_posts($query_string.'&posts_per_page='.$option['limit'].'&post_status=publish');
					if(have_posts()) : while(have_posts()) : the_post();
					
						$more = 0;
						$content = strip_tags(strip_shortcodes(get_the_content(false)));
						$excerpt = strip_tags(strip_shortcodes(get_the_excerpt()));
						$keys = explode(" ",$s);
						$content = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="highlight">\0</span>', $content);
						$excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<span class="highlight">\0</span>', $excerpt);
		
					?>
					
					<li>
						<h4>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>
						<span class="small"><?php _e('Category:', 'rokajaxsearch'); ?> <?php the_category(', ') ?></span>
						<div class="description"><?php if($option['display_content'] == 'content') : echo $content; else: echo $excerpt; endif; ?></div>
						<span class="small"><?php the_time('l, d F, Y'); ?></span>
					</li>
					
					<?php endwhile; endif; ?>
					
					<?php wp_reset_query(); ?>
					
				</ol>
				<div class="rt-pagination"></div>
				<br />
			</div>
		</div>
	</div>
	
	<?php die();
}

// MooTools Enqueue Script

add_action('init','rokajaxsearch_mootools_init',-50);
function rokajaxsearch_mootools_init(){
	global $rokajaxsearch_plugin_path, $rokajaxsearch_plugin_url;
	wp_register_script('mootools.js', $rokajaxsearch_plugin_url.'/js/mootools.js');
	wp_enqueue_script('mootools.js');
}

// RokNewsPager defaults

function rokajaxsearch_options() {
	
	$rokajaxsearch_options = array(
	
		'theme' => 'light',
		'load_custom_css' => 0,
		'google_api' => '',
		'order' => 'date',
		'limit' => '10',
		'per_page' => '3',
		'google_web' => 1,
		'google_blog' => 1,
		'google_images' => 0,
		'google_video' => 0,
		'pagination' => 1,
		'safesearch' => 'MODERATE',
		'image_size' => 'MEDIUM',
		'show_estimated' => 1,
		'show_category' => 1,
		'hide_divs' => '',
		'include_link' => 1,
		'show_description' => 1,
		'show_readmore' => 1,
		'read_more' => 'Read More ...',
		'display_content' => 'excerpt'
		
	);
	
	add_option('rokajaxsearch_options', $rokajaxsearch_options);
}

add_action('init','rokajaxsearch_options');
	
// RokAjaxSearch Admin Stuff Settings

function rokajaxsearch_admin_stuff() {
	register_setting('rokajaxsearch_options_array', 'rokajaxsearch_options');
}

if(is_admin()) {
	add_action('admin_init', 'rokajaxsearch_admin_stuff');
}

// Add scripts

function rokajaxsearch_script() {
	
	global $rokajaxsearch_plugin_path, $rokajaxsearch_plugin_url;

	$option = get_option('rokajaxsearch_options');
	$theme = $option['theme'];

	wp_register_script('rokajaxsearch.js', $rokajaxsearch_plugin_url.'/js/rokajaxsearch.js');
	wp_register_script('google_ajax_api', 'http://www.google.com/jsapi?key='.$option['google_api']);

	wp_register_style('rokajaxsearch.css', $rokajaxsearch_plugin_url.'/css/rokajaxsearch.css');
	wp_register_style('rokajaxsearch-theme.css', $rokajaxsearch_plugin_url.'/themes/'.$theme.'/rokajaxsearch-theme.css');

	// Load style for ie6 or ie7 if exist

	$iebrowser = getBrowser();
	if ($iebrowser && !$option['load_custom_css']) {
		if (file_exists("$rokajaxsearch_plugin_path/themes/$theme/rokajaxsearch-theme-ie$iebrowser.php")) {
			wp_register_style('rokajaxsearch-theme-ie'.$iebrowser.'.php', $rokajaxsearch_plugin_url.'/themes/'.$theme.'/rokajaxsearch-theme-ie'.$iebrowser.'.php');
			wp_enqueue_style('rokajaxsearch-theme-ie'.$iebrowser.'.php');
		}
		elseif (file_exists("$rokajaxsearch_plugin_path/themes/$theme/rokajaxsearch-theme-ie$iebrowser.css")) {
			wp_register_style('rokajaxsearch-theme-ie'.$iebrowser.'.css', $rokajaxsearch_plugin_url.'/themes/'.$theme.'/rokajaxsearch-theme-ie'.$iebrowser.'.css');
			wp_enqueue_style('rokajaxsearch-theme-ie'.$iebrowser.'.css');
		}
	}

	if(!$option['load_custom_css']) :
		wp_enqueue_style('rokajaxsearch.css');
		wp_enqueue_style('rokajaxsearch-theme.css');
	endif;
	
	wp_enqueue_script('rokajaxsearch.js');

	if ($option['google_web'] && $option['google_api'] != '') {
		wp_enqueue_script('google_ajax_api');
	}

}

function rokajaxsearch_script_inline() {

	$option = get_option('rokajaxsearch_options');

	/* RokAjaxSearch Init */

	$rokajaxsearch_url = '?orderby='.$option['order'];

	$websearch = $option['google_web'];
	$blogsearch = $option['google_blog'];
	$imagesearch = $option['google_images'];
	$videosearch = $option['google_video'];
	$ras_init = "window.addEvent((window.webkit) ? 'load' : 'domready', function() {
			if(document.id('roksearch_search_str')) {
				window.rokajaxsearch = new RokAjaxSearch({
					'results': '".__('Results', 'rokajaxsearch')."',
					'close': '',
					'websearch': ".$websearch.",
					'blogsearch': ".$blogsearch.",
					'imagesearch': ".$imagesearch.",
					'videosearch': ".$videosearch.",
					'imagesize': '".$option['image_size']."',
					'safesearch': '".$option['safesearch']."',
					'search': '".__('Search', 'rokajaxsearch')."',
					'readmore': '".$option['read_more']."',
					'noresults': '".__('No Results', 'rokajaxsearch')."',
					'advsearch': '".__('Advanced Search', 'rokajaxsearch')."',
					'page': '".__('Page', 'rokajaxsearch')."',
					'page_of': '".__('Page of', 'rokajaxsearch')."',
					'searchlink': '".$rokajaxsearch_url."',
					'advsearchlink': '".$rokajaxsearch_url."',
					'uribase': '".get_bloginfo('wpurl')."/wp-admin/admin-ajax.php"."',
					'limit': '".$option['limit']."',
					'perpage': '".$option['per_page']."',
					'ordering': '".$option['order']."',
					'phrase': 'any',
					'hidedivs': '".$option['hide_divs']."',
					'includelink': ".$option['include_link'].",
					'viewall': '".__('View All', 'rokajaxsearch')."',
					'estimated': '".__('Estimated', 'rokajaxsearch')."',
					'showestimated': ".$option['show_estimated'].",
					'showpagination': ".$option['pagination'].",
					'showcategory': ".$option['show_category'].",
					'showreadmore': ".$option['show_readmore'].",
					'showdescription': ".$option['show_description'].",
					'wordpress': true
				});
			}
		});";

	echo "<script type=\"text/javascript\">\n$ras_init";
	if ($option['google_web'] == 1 && $option['google_api'] != '') {
		echo "\n"."google.load('search', '1.0', {nocss: true});";
	}
	echo "\n</script>\n";

}


// Identify browser

if(!function_exists('getBrowser')) {

	function getBrowser() {
	
		$agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : false;
		$ie_version = false;
				
		if (preg_match("/msie/", $agent) && !preg_match("/opera/", $agent)){
			$val = explode(" ",stristr($agent, "msie"));
			$ver = explode(".", $val[1]);
			$ie_version = $ver[0];
			$ie_version = preg_replace("#[^0-9,.,a-z,A-Z]#i", "", $ie_version);
		}
		
		return $ie_version;
	
	}

}

// Add Settings

function rokajaxsearch_settings_add($links) {
	$settings_link = '<a href="plugins.php?page=rokajaxsearch-settings">'.__('Settings', 'rokajaxsearch').'</a>';
	array_unshift($links, $settings_link);
	return $links;
}

function rokajaxsearch_settings_action() {
	$plugin = plugin_basename(__FILE__); 
	add_filter('plugin_action_links_'.$plugin, 'rokajaxsearch_settings_add');
}

add_action('admin_menu', 'rokajaxsearch_settings_action');

// Plugin settings page

function rokajaxsearch_menu() {
	add_plugins_page('RokAjaxSearch', 'RokAjaxSearch', 'activate_plugins', 'rokajaxsearch-settings', 'rokajaxsearch_settings_showup');  
}

add_action('admin_menu', 'rokajaxsearch_menu', 9);

function rokajaxsearch_admin_css() {

	global $rokajaxsearch_plugin_path, $rokajaxsearch_plugin_url; ?>
	
	<style type="text/css">
	#icon-rokajaxsearch {
		background: url(<?php echo $rokajaxsearch_plugin_url.'/rokajaxsearch_big.png'; ?>) no-repeat 0 0;
	}
	.rokajaxsearch-table table tr {height: 35px;}
	.rokajaxsearch-table table td {vertical-align: middle;}
	</style>

<?php }

if(is_admin() && (isset($_GET['page']) && $_GET['page'] == 'rokajaxsearch-settings')) {
	add_action('admin_head', 'rokajaxsearch_admin_css');
}

// RokAjaxSearch settings page

function rokajaxsearch_settings_showup() {
	
	$option = get_option('rokajaxsearch_options');
	
	if(isset($_GET['updated']) && $_GET['updated'] == 'true') { ?><div id="message" class="updated fade"><p><?php _e('RokAjaxSearch settings saved.', 'rokajaxsearch'); ?></p></div><?php } ?>
	
	<div class="wrap">
		<div class="icon32" id="icon-rokajaxsearch"><br /></div>
		<h2>RokAjaxSearch</h2><br />
		
		<div style="margin: 0 auto; width: 50%;" class="rokajaxsearch-table">
		
			<form method="post" action="options.php">
				<?php settings_fields('rokajaxsearch_options_array'); ?>
				
				<table cellspacing="0" class="widefat fixed">
					<thead>
						<tr>
							<th></th>
							<th>
								<input type="submit" class="button" value="<?php _e('Save Changes', 'rokajaxsearch'); ?>" style="padding: 3px; float: right;" />
							</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th>
								<input type="submit" class="button" value="<?php _e('Save Changes', 'rokajaxsearch'); ?>" style="padding: 3px; float: right;" />
							</th>
						</tr>
					</tfoot>
					<tbody>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Preset Themes', 'rokajaxsearch'); ?></b></td>
							<td>
								<select id="theme" name="rokajaxsearch_options[theme]">
									<option value="blue" <?php if ($option['theme'] == "blue") : ?>selected="selected"<?php endif; ?>><?php _e('Blue', 'rokajaxsearch'); ?></option>
									<option value="light" <?php if ($option['theme'] == "light") : ?>selected="selected"<?php endif; ?>><?php _e('Light', 'rokajaxsearch'); ?></option>
									<option value="dark" <?php if ($option['theme'] == "dark") : ?>selected="selected"<?php endif; ?>><?php _e('Dark', 'rokajaxsearch'); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Load Default CSS', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="roknewspagercss-0" type="radio" value="0" name="rokajaxsearch_options[load_custom_css]" <?php if(!$option['load_custom_css']) echo 'checked="checked"'; ?>/>
								<label for="roknewspagercss-0"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="roknewspagercss-1" type="radio" value="1" name="rokajaxsearch_options[load_custom_css]" <?php if($option['load_custom_css']) echo 'checked="checked"'; ?>/>
								<label for="roknewspagercss-1"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Google API', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="google_api" type="text" value="<?php echo $option['google_api']; ?>" size="50" name="rokajaxsearch_options[google_api]" />
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Show Description', 'rokajaxsearch'); ?></b></td>
							<td>
								<input id="show_description-1" type="radio" value="1" name="rokajaxsearch_options[show_description]" <?php if($option['show_description']) echo 'checked="checked"'; ?>/>
								<label for="show_description-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="show_description-0" type="radio" value="0" name="rokajaxsearch_options[show_description]" <?php if(!$option['show_description']) echo 'checked="checked"'; ?>/>
								<label for="show_description-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Show Read More', 'rokajaxsearch'); ?></b></td>
							<td>
								<input id="show_readmore-1" type="radio" value="1" name="rokajaxsearch_options[show_readmore]" <?php if($option['show_readmore']) echo 'checked="checked"'; ?>/>
								<label for="show_readmore-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="show_readmore-0" type="radio" value="0" name="rokajaxsearch_options[show_readmore]" <?php if(!$option['show_readmore']) echo 'checked="checked"'; ?>/>
								<label for="show_readmore-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Read More Label', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="read_more" type="text" value="<?php echo $option['read_more']; ?>" size="20" name="rokajaxsearch_options[read_more]" />
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Hide Divs', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="hide_divs" type="text" value="<?php echo $option['hide_divs']; ?>" size="20" name="rokajaxsearch_options[hide_divs]" />
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Display Content', 'rokajaxsearch'); ?></b></td>
							<td>
								<select id="display_content" name="rokajaxsearch_options[display_content]">
									<option value="content" <?php if ($option['display_content'] == "content") : ?>selected="selected"<?php endif; ?>><?php _e('Content', 'rokajaxsearch'); ?></option>
									<option value="excerpt" <?php if ($option['display_content'] == "excerpt") : ?>selected="selected"<?php endif; ?>><?php _e('Excerpt', 'rokajaxsearch'); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Order', 'rokajaxsearch'); ?></b></td>
							<td>
								<select id="order" name="rokajaxsearch_options[order]">
									<option value="author" <?php if ($option['order'] == "author") : ?>selected="selected"<?php endif; ?>><?php _e('Author', 'rokajaxsearch'); ?></option>
									<option value="date" <?php if ($option['order'] == "date") : ?>selected="selected"<?php endif; ?>><?php _e('Date', 'rokajaxsearch'); ?></option>
									<option value="title" <?php if ($option['order'] == "title") : ?>selected="selected"<?php endif; ?>><?php _e('Title', 'rokajaxsearch'); ?></option>
									<option value="modified" <?php if ($option['order'] == "modified") : ?>selected="selected"<?php endif; ?>><?php _e('Modified', 'rokajaxsearch'); ?></option>
									<option value="menu_order" <?php if ($option['order'] == "menu_order") : ?>selected="selected"<?php endif; ?>><?php _e('Menu Order', 'rokajaxsearch'); ?></option>
									<option value="parent" <?php if ($option['order'] == "parent") : ?>selected="selected"<?php endif; ?>><?php _e('Parent', 'rokajaxsearch'); ?></option>
									<option value="id" <?php if ($option['order'] == "id") : ?>selected="selected"<?php endif; ?>><?php _e('ID', 'rokajaxsearch'); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Items Per Page', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="per_page" type="text" value="<?php echo $option['per_page']; ?>" size="5" name="rokajaxsearch_options[per_page]" />
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Limit Items', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="limit" type="text" value="<?php echo $option['limit']; ?>" size="5" name="rokajaxsearch_options[limit]" />
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Google Web Search', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="google_web-1" type="radio" value="1" name="rokajaxsearch_options[google_web]" <?php if($option['google_web']) echo 'checked="checked"'; ?>/>
								<label for="google_web-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="google_web-0" type="radio" value="0" name="rokajaxsearch_options[google_web]" <?php if(!$option['google_web']) echo 'checked="checked"'; ?>/>
								<label for="google_web-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Google Blog Search', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="google_blog-1" type="radio" value="1" name="rokajaxsearch_options[google_blog]" <?php if($option['google_blog']) echo 'checked="checked"'; ?>/>
								<label for="google_blog-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="google_blog-0" type="radio" value="0" name="rokajaxsearch_options[google_blog]" <?php if(!$option['google_blog']) echo 'checked="checked"'; ?>/>
								<label for="google_blog-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Google Image Search', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="google_images-1" type="radio" value="1" name="rokajaxsearch_options[google_images]" <?php if($option['google_images']) echo 'checked="checked"'; ?>/>
								<label for="google_images-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="google_images-0" type="radio" value="0" name="rokajaxsearch_options[google_images]" <?php if(!$option['google_images']) echo 'checked="checked"'; ?>/>
								<label for="google_images-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Google Video Search', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="google_video-1" type="radio" value="1" name="rokajaxsearch_options[google_video]" <?php if($option['google_video']) echo 'checked="checked"'; ?>/>
								<label for="google_video-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="google_video-0" type="radio" value="0" name="rokajaxsearch_options[google_video]" <?php if(!$option['google_video']) echo 'checked="checked"'; ?>/>
								<label for="google_video-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Image Size to Search', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<select id="image_size" name="rokajaxsearch_options[image_size]">
									<option value="SMALL" <?php if ($option['image_size'] == "SMALL") : ?>selected="selected"<?php endif; ?>><?php _e('Small', 'rokajaxsearch'); ?></option>
									<option value="MEDIUM" <?php if ($option['image_size'] == "MEDIUM") : ?>selected="selected"<?php endif; ?>><?php _e('Medium', 'rokajaxsearch'); ?></option>
									<option value="LARGE" <?php if ($option['image_size'] == "LARGE") : ?>selected="selected"<?php endif; ?>><?php _e('Large', 'rokajaxsearch'); ?></option>
									<option value="EXTRA_LARGE" <?php if ($option['image_size'] == "EXTRA_LARGE") : ?>selected="selected"<?php endif; ?>><?php _e('Extra Large', 'rokajaxsearch'); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Safe Search', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<select id="safesearch" name="rokajaxsearch_options[safesearch]">
									<option value="STRICT" <?php if ($option['safesearch'] == "STRICT") : ?>selected="selected"<?php endif; ?>><?php _e('Strict', 'rokajaxsearch'); ?></option>
									<option value="MODERATE" <?php if ($option['safesearch'] == "MODERATE") : ?>selected="selected"<?php endif; ?>><?php _e('Moderate', 'rokajaxsearch'); ?></option>
									<option value="OFF" <?php if ($option['safesearch'] == "OFF") : ?>selected="selected"<?php endif; ?>><?php _e('Off', 'rokajaxsearch'); ?></option>
								</select>
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Show Pagination', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="pagination-1" type="radio" value="1" name="rokajaxsearch_options[pagination]" <?php if($option['pagination']) echo 'checked="checked"'; ?>/>
								<label for="pagination-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="pagination-0" type="radio" value="0" name="rokajaxsearch_options[pagination]" <?php if(!$option['pagination']) echo 'checked="checked"'; ?>/>
								<label for="pagination-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Show Category', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="show_category-1" type="radio" value="1" name="rokajaxsearch_options[show_category]" <?php if($option['show_category']) echo 'checked="checked"'; ?>/>
								<label for="show_category-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="show_category-0" type="radio" value="0" name="rokajaxsearch_options[show_category]" <?php if(!$option['show_category']) echo 'checked="checked"'; ?>/>
								<label for="show_category-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="iedit">
							<td>
								<b><?php _e('Show Estimated', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="show_estimated-1" type="radio" value="1" name="rokajaxsearch_options[show_estimated]" <?php if($option['show_estimated']) echo 'checked="checked"'; ?>/>
								<label for="show_estimated-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="show_estimated-0" type="radio" value="0" name="rokajaxsearch_options[show_estimated]" <?php if(!$option['show_estimated']) echo 'checked="checked"'; ?>/>
								<label for="show_estimated-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
						<tr valign="middle" class="alternate iedit">
							<td>
								<b><?php _e('Include Link', 'rokajaxsearch'); ?></b>
							</td>
							<td>
								<input id="include_link-1" type="radio" value="1" name="rokajaxsearch_options[include_link]" <?php if($option['include_link']) echo 'checked="checked"'; ?>/>
								<label for="include_link-1"><?php _e('Yes', 'rokajaxsearch'); ?></label>&nbsp;&nbsp;
								<input id="include_link-0" type="radio" value="0" name="rokajaxsearch_options[include_link]" <?php if(!$option['include_link']) echo 'checked="checked"'; ?>/>
								<label for="include_link-0"><?php _e('No', 'rokajaxsearch'); ?></label>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		
		</div>
		
	</div>

<?php
 
}

?>