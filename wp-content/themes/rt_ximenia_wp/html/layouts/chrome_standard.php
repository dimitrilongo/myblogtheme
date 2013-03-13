<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('GANTRY_VERSION') or die();

gantry_import('core.gantrylayout');

/**
 *
 * @package gantry
 * @subpackage html.layouts
 */
class GantryLayoutChrome_Standard extends GantryLayout {
	var $render_params = array(
		'gridCount'     =>  null,
		'prefixCount'   =>  0,
		'extraClass'      =>  ''
	);

	function render($params = array()){
		global $gantry, $wp_registered_widgets;
		$rparams = $this-> _getParams($params[0]);
		$instance_params = $this->_getWidgetInstanceParams($params[0]['widget_id']);
		
		$id =  $params[0]['widget_id'];
		$classname = $wp_registered_widgets[$params[0]['widget_id']]['classname'];

		// gantry render params
		$params[0]['pre_widget'] ='';
		$params[0]['widget_open'] ='';
		$params[0]['title_open'] ='';
		$params[0]['title_close'] ='';
		$params[0]['widget_close'] ='';
		$params[0]['post_widget'] ='';
		$params[0]['pre_render'] ='';
		$params[0]['post_render'] ='';

		// normal wp widget params
		$params[0]['before_widget'] = '';
		$params[0]['before_title']  = '';
		$params[0]['after_title']  = '';
		$params[0]['after_widget']  = '';

		$widget_variations = '';

		if ((array_key_exists('widget-style', $instance_params) && $instance_params['widget-style'] != '') || 
			(array_key_exists('box-variation', $instance_params) && $instance_params['box-variation'] != '') ||
			(array_key_exists('title-variation', $instance_params) && $instance_params['title-variation'] != '') ||
			(array_key_exists('block-variation', $instance_params) && $instance_params['block-variation'] != '') ||
			(array_key_exists('shadow-variation', $instance_params) && $instance_params['shadow-variation'] != '') ||
			(array_key_exists('corner-variation', $instance_params) && $instance_params['corner-variation'] != '') ||
			(array_key_exists('align-variation', $instance_params) && $instance_params['align-variation'] != '') ||
			(array_key_exists('margin-variation', $instance_params) && $instance_params['margin-variation'] != '') ||
			(array_key_exists('padding-variation', $instance_params) && $instance_params['padding-variation'] != '') ||
			(array_key_exists('title-style', $instance_params) && $instance_params['title-style'] != '') ||
			(array_key_exists('custom-variations', $instance_params) && $instance_params['custom-variations'] != '')) {
			
			$widget_variations = $instance_params['widget-style'];
			
			if ($instance_params['box-variation'] != '') : $widget_variations .= ' '.$instance_params['box-variation']; endif;
			if ($instance_params['title-variation'] != '') : $widget_variations .= ' '.$instance_params['title-variation']; endif;
			if ($instance_params['block-variation'] != '') : $widget_variations .= ' '.$instance_params['block-variation']; endif;
			if ($instance_params['shadow-variation'] != '') : $widget_variations .= ' '.$instance_params['shadow-variation']; endif;
			if ($instance_params['corner-variation'] != '') : $widget_variations .= ' '.$instance_params['corner-variation']; endif;
			if ($instance_params['align-variation'] != '') : $widget_variations .= ' '.$instance_params['align-variation']; endif;
			if ($instance_params['margin-variation'] != '') : $widget_variations .= ' '.$instance_params['margin-variation']; endif;
			if ($instance_params['padding-variation'] != '') : $widget_variations .= ' '.$instance_params['padding-variation']; endif;
			if ($instance_params['title-style'] != '') : $widget_variations .= ' '.$instance_params['title-style']; endif;
			if ($instance_params['custom-variations'] != '') : $widget_variations .= ' '.$instance_params['custom-variations']; endif;
			
			$widget_variations = trim($widget_variations);
			
			$params[0]['pre_widget'] = '<div class="' . $widget_variations . '">';
			$params[0]['post_widget'] = '</div>';
		}

		if ($classname == 'widget_gantry_menu' && $instance_params['menu_classes'] != '') {
		
			$params[0]['widget_open'] = sprintf('<div id="%1$s" class="widget %2$s rt-block %3$s">', $id, $classname, $instance_params['menu_classes']);
			$params[0]['widget_close'] = '</div>';

			$params[0]['title_open'] =  '<div class="module-title"><h2 class="title">';
			$params[0]['title_close'] = '</h2></div>';  
			
			$params[0]['pre_render'] = '';
			$params[0]['post_render'] = '<div class="clear"></div>';     
		
		} else {

			// Widget Open
			ob_start(); ?>

			<div id="<?php echo $id; ?>" class="widget <?php echo $classname; ?> rt-block">
				<div class="module-surround">
			
			<?php

			$widget_open = ob_get_clean();

			$params[0]['widget_open'] = $widget_open;

			// Widget Close
			ob_start(); ?>

				</div>
			</div>

			<?php

			$widget_close = ob_get_clean();
			
			$params[0]['widget_close'] = $widget_close;

			// Title Open
			ob_start(); ?>

			<div class="module-title">
				<?php if (preg_match("/title[2,4]{1,}/i", $widget_variations)) : ?>
				<div class="arrow-box"></div>
	        	<?php endif; ?>
				<h2 class="title">

			<?php

			$title_open = ob_get_clean();

			$params[0]['title_open'] =  $title_open;

			// Title Close
			ob_start(); ?>

				</h2>
			</div>

			<?php

			$title_close = ob_get_clean();

			$params[0]['title_close'] = $title_close;  
			
			$params[0]['pre_render'] = '<div class="module-content">';       
			$params[0]['post_render'] = '<div class="clear"></div></div>';

		}

		if($instance_params['title'] != '') :
			$params[0]['before_widget'] = $params[0]['pre_widget'].$params[0]['widget_open'];
			$params[0]['before_title'] = $params[0]['title_open'];
			$params[0]['after_title'] =  $params[0]['title_close'].$params[0]['pre_render'];
			$params[0]['after_widget'] = $params[0]['post_render'].$params[0]['widget_close'].$params[0]['post_widget'];
		else :
			$params[0]['before_widget'] = $params[0]['pre_widget'].$params[0]['widget_open'].$params[0]['pre_render'];
			$params[0]['before_title'] = $params[0]['title_open'];
			$params[0]['after_title'] =  $params[0]['title_close'];
			$params[0]['after_widget'] = $params[0]['post_render'].$params[0]['widget_close'].$params[0]['post_widget'];
		endif;
		
		return $params;
		
	}
}