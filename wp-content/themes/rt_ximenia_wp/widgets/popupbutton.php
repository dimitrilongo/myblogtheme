<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
 
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrywidget');

add_action('widgets_init', array("GantryWidgetPopupButton","init"));

class GantryWidgetPopupButton extends GantryWidget {
    var $short_name = 'popupbutton';
    var $wp_name = 'gantry_popupbutton';
    var $long_name = 'Gantry Popup Button';
    var $description = 'Gantry Popup Button Widget';
    var $css_classname = 'widget_gantry_popupbutton';
    var $width = 200;
    var $height = 400;

    function init() {
        register_widget("GantryWidgetPopupButton");
    }
    
    function render_widget_open($args, $instance) {
    }
    
    function render_widget_close($args, $instance) {
    }
    
    function pre_render($args, $instance) {
    }
    
    function post_render($args, $instance) {
    }
    
    function render_title($args, $instance) {
    }

    function render($args, $instance){
        global $gantry, $current_user;
	    ob_start();
	    ?>
    	
    	<div id="<?php echo $this->id; ?>" class="widget <?php echo $this->css_classname; ?> rt-block">
	    	<div id="rt-popupmodule-button">
				<a href="#" class="buttontext button" rel="rokbox[<?php echo $instance['width']; ?> <?php echo $instance['height']; ?>][module=rt-popup]">
					<span class="desc"><?php echo $instance['text']; ?></span>
				</a>
			</div>
		</div>
    	
	    <?php 
	    
	    echo ob_get_clean();
	
	}
}