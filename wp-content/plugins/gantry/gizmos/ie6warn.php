<?php
/**
 * @version   $Id: ie6warn.php 58623 2012-12-15 22:01:32Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

defined('GANTRY_VERSION') or die();

gantry_import('core.gantrygizmo');
/**
 * @package     gantry
 * @subpackage  features
 */
class GantryGizmoIE6Warn extends GantryGizmo
{
	var $_name = 'ie6warn';

	function query_parsed_init()
	{
		global $gantry;

		if ($gantry->browser->name == 'ie' && $gantry->browser->shortversion == '6') {
			if ($this->get('enabled')) {
				$gantry->addScript('gantry-ie6warn.js');
				$gantry->addDomReadyScript($this->_ie6Warn());
			}
		}
	}

	function _ie6Warn()
	{
		global $gantry;

		$delay = $this->get('delay');
		$msg   = $gantry->ie6Warning;

		$js = "if (Browser.Engine.trident4) { (function() {var iewarn = new RokIEWarn(\"$msg\");}).delay($delay); }\n";

		return $js;
	}
}