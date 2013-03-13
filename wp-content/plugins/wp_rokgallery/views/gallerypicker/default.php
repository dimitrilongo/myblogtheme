<?php
/**
 * @version   $Id$
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
RokCommon_Composite::get($view->context)->load('includes.php', array('that' => $view));
echo RokCommon_Composite::get($view->context)->load('default.php', array('that' => $view));