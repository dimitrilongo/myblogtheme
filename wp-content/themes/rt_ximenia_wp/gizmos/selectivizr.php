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
class GantryGizmoSelectivizr extends GantryGizmo {

    var $_name = 'selectivizr';

    function init() {
        global $gantry;
        
        if ($gantry->browser->name == 'ie' && $gantry->browser->shortversion <= '8') {
            if ($this->get('enabled')) {
                $gantry->addScript('selectivizr-min.js');
            }
        }
    }
	
}