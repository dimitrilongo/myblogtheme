<?php
/**
 * @version   $Id: smartload.php 58623 2012-12-15 22:01:32Z btowles $
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
class GantryGizmoSmartLoad extends GantryGizmo
{
	var $_name = 'smartload';

	function query_parsed_init()
	{
		global $gantry, $option;

		//TODO make this ignore certain page types   maybe have ignore code for things like is_404
		//$ignores = explode(",",$this->get('ignores'));
		if (!is_array($ignores)) $ignores = array();

		//if ($this->get('enabled') && !in_array($option,$ignores)) {
		$blank  = $gantry->templateUrl . '/images/blank.gif';
		$offset = "{'x': " . $this->get('text') . ", 'y': " . $this->get('text') . "}";
		$gantry->addScript('gantry-smartload.js');
		$gantry->addDomReadyScript("new GantrySmartLoad({'offset': " . $offset . ", 'placeholder': '" . $blank . "', 'exclusion': ['" . $this->get('exclusion') . "']});\n");

	}

	function isOrderable()
	{
		return false;
	}
}