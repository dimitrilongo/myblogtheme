<?php
/**
 * @version   $Id: iview.php 57372 2012-10-11 00:14:44Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

interface RokSprocket_Views_IView
{
	public function renderHeader();
	public function renderInlines();
	public function render();
	public function initialize();
}
