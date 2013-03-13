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
 
class GantryGizmoTypographyShortcodes extends GantryGizmo {

    var $_name = 'typographyshortcodes';
	
	function query_parsed_init() {
		add_shortcode('h1', array(&$this, 'roktypo_h1'));
		add_shortcode('h2', array(&$this, 'roktypo_h2'));
		add_shortcode('h3', array(&$this, 'roktypo_h3'));
		add_shortcode('h4', array(&$this, 'roktypo_h4'));
		add_shortcode('h5', array(&$this, 'roktypo_h5'));
		add_shortcode('contentheading', array(&$this, 'roktypo_contentheading'));
		add_shortcode('componentheading', array(&$this, 'roktypo_componentheading'));
		add_shortcode('notice', array(&$this, 'roktypo_notice'));
		add_shortcode('highlight', array(&$this, 'roktypo_highlight'));
		add_shortcode('icon', array(&$this, 'roktypo_icon'));
		add_shortcode('span', array(&$this, 'roktypo_span'));
		add_shortcode('contentbox', array(&$this, 'roktypo_contentbox'));
		add_shortcode('pre', array(&$this, 'roktypo_pre'));
		add_shortcode('pre2', array(&$this, 'roktypo_pre2'));
		add_shortcode('blockquote', array(&$this, 'roktypo_blockquote'));
		add_shortcode('list', array(&$this, 'roktypo_list'));
		add_shortcode('li', array(&$this, 'roktypo_li'));
		add_shortcode('emphasis', array(&$this, 'roktypo_emphasis'));
		add_shortcode('emphasisbold', array(&$this, 'roktypo_emphasisbold'));
		add_shortcode('emphasisbold2', array(&$this, 'roktypo_emphasisbold2'));
		add_shortcode('inset', array(&$this, 'roktypo_inset'));
		add_shortcode('dropcap', array(&$this, 'roktypo_dropcap'));
		add_shortcode('underline', array(&$this, 'roktypo_underline'));
		add_shortcode('bold', array(&$this, 'roktypo_bold'));
		add_shortcode('italic', array(&$this, 'roktypo_italic'));
		add_shortcode('clear', array(&$this, 'roktypo_clear'));
		add_shortcode('readon', array(&$this, 'roktypo_readon'));
		add_shortcode('readon2', array(&$this, 'roktypo_readon2'));
	}
	
	function roktypo_h1($atts, $content = null) {
		return '<h1>'.$content.'</h1>';
	}
	
	function roktypo_h2($atts, $content = null) {
		return '<h2>'.$content.'</h2>';
	}
	
	function roktypo_h3($atts, $content = null) {
		return '<h3>'.$content.'</h3>';
	}
	
	function roktypo_h4($atts, $content = null) {
		return '<h4>'.$content.'</h4>';
	}
	
	function roktypo_h5($atts, $content = null) {
		return '<h5>'.$content.'</h5>';
	}
	
	function roktypo_contentheading($atts, $content = null) {
		return '<div class="contentheading">'.$content.'</div>';
	}
	
	function roktypo_componentheading($atts, $content = null) {	
		return '<div class="componentheading">'.$content.'</div>';
	}
	
	function roktypo_notice($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		return '<p class="'.$class.'">'.do_shortcode($content).'</p>';
	}
	
	function roktypo_highlight($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		return '<em class="highlight '.$class.'">'.do_shortcode($content).'</em>';
	}
	
	function roktypo_icon($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		return '<span class="text-icon '.$class.'">'.do_shortcode($content).'</span>';
	}

	function roktypo_span($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		return '<span class="'.$class.'">'.do_shortcode($content).'</span>';
	}
	
	function roktypo_contentbox($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		return '<div class="'.$class.'">'.do_shortcode($content).'</div>';
	}
	
	function roktypo_pre($atts, $content = null) {	
		return '<pre>'.$content.'</pre>';
	}
	
	function roktypo_pre2($atts, $content = null) {	
		return '<pre class="lines">'.$content.'</pre>';
	}
	
	function roktypo_blockquote($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));
		return '<blockquote class="'.$class.'"><p>'.$content.'</p></blockquote>';
	}
	
	function roktypo_list($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => ''
		), $atts));

		return '<ul class="'.$class.'">'.do_shortcode($content).'</ul>';
	}
	
	function roktypo_li($atts, $content = null) {
		return '<li>'.do_shortcode($content).'</li>';
	}
	
	function roktypo_emphasis($atts, $content = null) {	
		return '<em class="italic">'.$content.'</em>';
	}
	
	function roktypo_emphasisbold($atts, $content = null) {	
		return '<em class="bold">'.$content.'</em>';
	}
	
	function roktypo_emphasisbold2($atts, $content = null) {	
		return '<em class="bold2">'.$content.'</em>';
	}
	
	function roktypo_inset($atts, $content = null) {
		extract(shortcode_atts(array(
			'title' => '',
			'side' => 'left'
		), $atts));

		return '<span class="inset-'.$side.'"><span class="inset-'.$side.'-title">'.$title.'</span>'.$content.'</span>';
	}
	
	function roktypo_dropcap($atts, $content = null) {
		extract(shortcode_atts(array(
			'class' => '',
		), $atts));

		return '<p class="'.$class.'">'.$content.'</p>';
	}
	
	function roktypo_underline($atts, $content = null) {	
		return '<span style="text-decoration:underline;">'.$content.'</span>';
	}
	
	function roktypo_bold($atts, $content = null) {	
		return '<strong>'.$content.'</strong>';
	}
	
	function roktypo_italic($atts, $content = null) {	
		return '<em>'.$content.'</em>';
	}
	
	function roktypo_clear($atts, $content = null) {	
		return '<div class="clear"></div>';
	}
	
	function roktypo_readon($atts, $content = null) {
		extract(shortcode_atts(array(
			'url' => ''
		), $atts));

		return '<p><a class="readon" href="'.$url.'"><span>'.$content.'</span></a></p>';
	}
	
	function roktypo_readon2($atts, $content = null) {
		extract(shortcode_atts(array(
			'url' => ''
		), $atts));

		return '<a class="readon" href="'.$url.'"><span>'.$content.'</span></a>';
	}
	
}