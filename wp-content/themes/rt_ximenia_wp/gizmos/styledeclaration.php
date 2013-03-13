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
class GantryGizmoStyleDeclaration extends GantryGizmo {

	var $_name = 'styledeclaration';
	
	function isEnabled(){
		global $gantry;
		$menu_enabled = $this->get('enabled');

		if (1 == (int)$menu_enabled) return true;
		return false;
	}

	function query_parsed_init() {
		global $gantry;
		$browser = $gantry->browser;

		// COLORCHOOSER
		$accentColor = new Color($gantry->get('main-accent'));
		$css = 'a, .menutop.fusion-js-container ul li > .item:hover, .splitmenu li .item:hover, .splitmenu li a:hover, .menutop.fusion-js-container li.f-menuparent-itemfocus > .item, .menutop li.root:hover > .item, .menutop li.root.f-mainparent-itemfocus > .item, #rt-subnavigation .splitmenu .item:hover, #rt-subnavigation .menu li.active .item, #rt-subnavigation .menutop li.active .item, a.rt-totop:hover, .rt-totop:hover .totop-desc, .sprocket-tabs-nav li.active .sprocket-tabs-inner, .component-content .item h2 a:hover, .fusion-js-container .active > .item, .module-content ul.menu li.parent > li a:hover, .module-content ul.menu li.parent > li .nolink:hover, .module-content ul.menu li.parent li .item:hover, .module-content ul.menu li.parent li a:hover, .module-content ul.menu li.parent li .separator:hover, .module-content ul.menu li.parent .separator:hover, #rt-main .module-content ul.menu > li > a:hover, #rt-main .module-content ul.menu > li > .separator:hover, .component-content .items-leading h2 a:hover, .component-content .item-page h2 a:hover, #rt-menu a:hover, #k2Container .latestItemTitle a:hover, .horizmenu .menu li a:hover, .horizmenu .menu li .separator:hover {color:'.$gantry->get('main-accent').';}'."\n";
		$css .= '.button:hover, .readon:hover, .readmore:hover, button.validate:hover, #member-profile a:hover, #member-registration a:hover, .formelm-buttons button:hover, .layout-showcase .sprocket-features-arrows .arrow:hover, .sprocket-mosaic-loadmore:hover, .title1 .module-title, .layout-showcase .readon, #k2Container .itemCommentsForm .button:hover, .sprocket-mosaic .sprocket-mosaic-filter li:hover, .sprocket-mosaic .sprocket-mosaic-order li:hover, .sprocket-mosaic .sprocket-mosaic-filter li.active, .sprocket-mosaic .sprocket-mosaic-order li.active, .fronttabs .image-description, .title4 .arrow-box, .menutop.level1 > li.active .item {background-color:'.$accentColor->lighten('5%').';}'."\n";
		$css .= '.rt-totop:hover .totop-arrow, .module-content .menu li > a:hover > span > .menu-arrow, .module-content .menu li > .nolink:hover > span > .menu-arrow, .sprocket-lists-title, .sprocket-lists-arrows .arrow:hover, .sprocket-headlines-navigation .arrow:hover, .layout-slideshow .sprocket-features-arrows .arrow, .title2 .arrow-box, .module-content .menu li.current.active > a span .menu-arrow, .module-content .menu li.active#current > a span .menu-arrow, .module-content ul.menu li > a:hover:before, .module-content ul.menu li.active.current > a:before, .module-content ul.menu li.active#current > a:before, .module-content ul.menu li > .separator:hover:before, .module-content ul.menu li.active.current > .separator:before, .module-content ul.menu li.active#current > .separator:before {background-color: '.$gantry->get('main-accent').';}'."\n";
		$css .= '.block-module .title3 .module-surround .module-title, #rt-main .title3 .module-surround .module-title, .title3 .module-surround .module-title, .component-content .item h2, #rt-footer .title, .component-content h1, .component-content .items-leading h2, .component-content .item-page h2, .component-content .item-page h2:after, .component-content .blog h2:after, .component-block .component-content h2, .component-content .weblink-category h2:after, .component-content .contact h2:after, .component-content .login h1:after, .component-content h2:after, .component-content h1:after, .title3.noblock .title:after, .component-content h2, .component-content .weblink-category h2, .title3.noblock .module-title:after, .component-block .component-content h1, .title3 .module-title:after {border-color: '.$gantry->get('main-accent').';}'."\n";
		$css .= '.layout-showcase .readon:hover {border-color: '.$accentColor->darken('13%').';background-color: '.$gantry->get('main-accent').';}'."\n";
		$css .= '.layout-showcase .readon {border-color: '.$accentColor->darken('13%').';background-color: '.$this->_RGBA($gantry->get('main-accent'), '0.9').'}'."\n";
		$css .= '.login-fields #username:focus, .login-fields #password:focus, #contact-form dd input:focus, #contact-form dd textarea:focus, #modlgn-username:focus, #modlgn-passwd:focus, input#jform_email:focus, #rokajaxsearch .inputbox:focus, #member-registration dd input:focus, #search-searchword:focus, .finder .inputbox:focus, #rt-contact-form #rt-contact-name:focus, #rt-contact-form #rt-contact-email:focus, #rt-contact-form #rt-contact-message:focus, #comments-form #author:focus, #comments-form #email:focus, #comments-form #url:focus, #comments-form textarea:focus {border: 1px solid '.$gantry->get('main-accent').'; box-shadow: inset 0 1px 3px '.$this->_RGBA($gantry->get('main-accent'), '0.3').', 0 0 8px '.$this->_RGBA($gantry->get('main-accent'), '0.6').';}'."\n";
		$css .= 'body ul.checkmark li::after, body ul.circle-checkmark li::before, body ul.square-checkmark li::before, body ul.circle-small li::after, body ul.circle li::after, body ul.circle-large li::after, .title5 .title::before, .sprocket-headlines-badge::after {border-color: '.$gantry->get('main-accent').';}'."\n";
		$css .= 'body ul.triangle-small li::after, body ul.triangle li::after, body ul.triangle-large li::after {border-color: transparent transparent transparent '.$gantry->get('main-accent').';}'."\n";
		$css .= '#rt-showcase a {color:'.$accentColor->lighten('25%').';}'."\n";
		$css .= '.fronttabs .cornertab {border-right-color: '.$gantry->get('main-accent').';}'."\n";
		$css .= '.item-page div.tags a:hover, .widget_tag_cloud .tagcloud a:hover {background-color:'.$accentColor->lighten('5%').';}'."\n";

		// Logo
		$css .= $this->buildLogo();

		if ($gantry->get('static-enabled')) {
			// do file stuff
			$filename = $gantry->templatePath . '/css/static-styles.css';
			$css_path = $gantry->templatePath . '/css/';

			if (file_exists($filename)) {
				if ($gantry->get('static-check')) {
					//check to see if it's outdated

					$md5_static = md5_file($filename);
					$md5_inline = md5($css);

					if ($md5_static != $md5_inline) {
						if (is_writable($css_path)) {
							$styles_file = fopen($filename, 'w');
							fwrite($styles_file, $css);
							fclose($styles_file);
						} else {
							_re('Unable to write "static-styles.css" in the "/css" folder.');
						}
					}
				}
			} else {
				// file missing, save it
				if (is_writable($css_path)) {
					$styles_file = fopen($filename, 'w');
					fwrite($styles_file,$css);
					fclose($styles_file);
				} else {
					_re('Unable to write "static-styles.css" in the "/css" folder.');
				}
			}
			// add reference to static file
			$gantry->addStyle('static-styles.css',99);

		} else {
			// add inline style
			$gantry->addInlineStyle($css);
		}

		$this->_disableRokBoxForiPhone();

		// Style Inclusion
        $mainstyle = $gantry->get('main-body');
        $gantry->addStyle('gantry-core.css');
        $gantry->addStyle('wordpress-core.css');
        $gantry->addStyle('main-'.$mainstyle.".css");
        $gantry->addStyle('utilities.css');
        if ($gantry->get('typography-enabled')) $gantry->addStyle('typography.css');
        if ($gantry->get('typography-enabled')) $gantry->addStyle('font-awesome.css');

        // Responsive or Fixed Layout Selector
        if ($gantry->get('layout-mode')=="responsive") $gantry->addStyle('responsive.css');
        if ($gantry->get('layout-mode')=="960fixed") $gantry->addStyle('960fixed.css');
        if ($gantry->get('layout-mode')=="1200fixed") $gantry->addStyle('1200fixed.css');   

		// add inline css from the Custom CSS field
		$gantry->addInlineStyle($gantry->get('customcss'));

	}

	function buildLogo(){
		global $gantry;

		if ($gantry->get('logo-type')!="custom") return "";

		$source = $width = $height = "";

		$logo = str_replace("&quot;", '"', str_replace("'", '"', $gantry->get('logo-custom-image')));
		$data = json_decode($logo);

		if (!$data){
			if (strlen($logo)) $source = $logo;
			else return "";
		} else {
			$source = $data->path;
		}

		$baseUrl = trailingslashit(get_bloginfo('wpurl'));

		if (substr($baseUrl, 0, strlen($baseUrl)) == substr($source, 0, strlen($baseUrl))){
			$file = ABSPATH . substr($source, strlen($baseUrl));
		} else {
			$file = ABSPATH . $source;
		}

		if (isset($data->width) && isset($data->height)){
			$width = $data->width;
			$height = $data->height;
		} else {
			$size = @getimagesize($file);
			$width = $size[0];
			$height = $size[1];
		}

		$output = "";
		$output .= "#rt-logo {background: url(".$source.") 50% 0 no-repeat !important;}"."\n";
		$output .= "#rt-logo {width: ".$width."px;height: ".$height."px;}"."\n";

		$file = preg_replace('/\//i', DS, $file);

		return (file_exists($file)) ?$output : '';
	}

	function _createGradient($direction, $from, $fromOpacity, $fromPercent, $to, $toOpacity, $toPercent){
		global $gantry;
		$browser = $gantry->browser;

		$fromColor = $this->_RGBA($from, $fromOpacity);
		$toColor = $this->_RGBA($to, $toOpacity);
		$gradient = $default_gradient = '';

		$default_gradient = 'background: linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';

		switch ($browser->engine) {
			case 'gecko':
				$gradient = ' background: -moz-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
				break;

			case 'webkit':
				if ($browser->shortversion < '5.1'){

					switch ($direction){
						case 'top':
							$from_dir = 'left top'; $to_dir = 'left bottom'; break;
						case 'bottom':
							$from_dir = 'left bottom'; $to_dir = 'left top'; break;
						case 'left':
							$from_dir = 'left top'; $to_dir = 'right top'; break;
						case 'right':
							$from_dir = 'right top'; $to_dir = 'left top'; break;
					}
					$gradient = ' background: -webkit-gradient(linear, '.$from_dir.', '.$to_dir.', color-stop('.$fromPercent.','.$fromColor.'), color-stop('.$toPercent.','.$toColor.'));';
				} else {
					$gradient = ' background: -webkit-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
				}
				break;

			case 'presto':
				$gradient = ' background: -o-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
				break;

			case 'trident':
				if ($browser->shortversion >= '10'){
					$gradient = ' background: -ms-linear-gradient('.$direction.', '.$fromColor.' '.$fromPercent.', '.$toColor.' '.$toPercent.');';
				} else if ($browser->shortversion <= '6'){
					$gradient = $from;
					$default_gradient = '';
				} else {

					$gradient_type = ($direction == 'left' || $direction == 'right') ? 1 : 0;
					$from_nohash = str_replace('#', '', $from);
					$to_nohash = str_replace('#', '', $to);

					if (strlen($from_nohash) == 3) $from_nohash = str_repeat(substr($from_nohash, 0, 1), 6);
					if (strlen($to_nohash) == 3) $to_nohash = str_repeat(substr($to_nohash, 0, 1), 6);

					if ($fromOpacity == 0 || $fromOpacity == '0' || $fromOpacity == '0%') $from_nohash = '00' . $from_nohash;
					if ($toOpacity == 0 || $toOpacity == '0' || $toOpacity == '0%') $to_nohash = '00' . $to_nohash;

					$gradient = " filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#".$to_nohash."', endColorstr='#".$from_nohash."',GradientType=".$gradient_type." );";

					$default_gradient = '';

				}
				break;

			default:
				$gradient = $from;
				$default_gradient = '';
				break;
		}

		return  $default_gradient . $gradient;
	}

	function _HEX2RGB($hexStr, $returnAsString = false, $seperator = ','){
		$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr);
		$rgbArray = array();
	
		if (strlen($hexStr) == 6){
			$colorVal = hexdec($hexStr);
			$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
			$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
			$rgbArray['blue'] = 0xFF & $colorVal;
		} elseif (strlen($hexStr) == 3){
			$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
			$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
			$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
		} else {
			return false;
		}
	
		return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray;
	}
	
	function _RGBA($hex, $opacity){
		return 'rgba(' . $this->_HEX2RGB($hex, true) . ','.$opacity.')';
	}

	function _disableRokBoxForiPhone() {
		global $gantry;

		if ($gantry->browser->platform == 'iphone' || $gantry->browser->platform == 'android') {
			$gantry->addInlineScript("window.addEvent('domready', function() {\$\$('a[rel^=rokbox]').removeEvents('click');});");
		}
	}
}