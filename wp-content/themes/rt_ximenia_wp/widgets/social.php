<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetSocial","init"));

class GantryWidgetSocial extends GantryWidget {
    var $short_name = 'social';
    var $wp_name = 'gantry_social';
    var $long_name = 'Gantry Social Buttons';
    var $description = 'Gantry Social Buttons Widget';
    var $css_classname = 'widget_gantry_social';
    var $width = 200;
    var $height = 400;

    function init() {
        register_widget("GantryWidgetSocial");
    }
    
    function render_widget_open($args, $instance){
	}
	
	function render_widget_close($args, $instance){
	}
	
	function pre_render($args, $instance) {
	}
	
	function post_render($args, $instance) {
	}

    function render($args, $instance){
        global $gantry;
	    ob_start();

	    ?>

	    <div class="rt-block">
		    <div class="rt-social-buttons">
		    	<div class="rt-social-text"><?php echo $instance['social-text']; ?></div>
		    	<?php if ($instance['social-facebook'] != '') : ?>
					<a class="social-button rt-facebook-btn" href="<?php echo $instance['social-facebook']; ?>">
					<span></span>
				</a>
				<?php endif; ?>
				<?php if ($instance['social-twitter'] != '') : ?>
					<a class="social-button rt-twitter-btn" href="<?php echo $instance['social-twitter']; ?>">
					<span></span>
				</a>
				<?php endif; ?>
				<?php if ($instance['social-google'] != '') : ?>
					<a class="social-button rt-google-btn" href="<?php echo $instance['social-google']; ?>">
					<span></span>
				</a>
				<?php endif; ?>
				<?php if ($instance['social-rss'] != '') : ?>
					<a class="social-button rt-rss-btn" href="<?php echo $instance['social-rss']; ?>">
					<span></span>
				</a>
				<?php endif; ?>
			</div>
		</div>

		<?php

		echo ob_get_clean();
	    
	}
}