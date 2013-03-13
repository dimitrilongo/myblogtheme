<?php
/**
 * @version   1.0 February 16, 2013
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

require_once(dirname(__FILE__).'/ximenia_fusion/theme.php');
GantryWidgetMenu::registerTheme(dirname(__FILE__).'/ximenia_fusion','ximenia_fusion', __('Ximenia Fusion'), 'XimeniaFusionMenuTheme');

require_once(dirname(__FILE__).'/ximenia_splitmenu/theme.php');
GantryWidgetMenu::registerTheme(dirname(__FILE__).'/ximenia_splitmenu','ximenia_splitmenu', __('Ximenia SplitMenu'), 'XimeniaSplitMenuTheme');