<?php
 /**
  * @version   $Id$
  * @author    RocketTheme http://www.rockettheme.com
  * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
  * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
  */

RokCommon_Header::addStyle(RokCommon_Composite::get($that->context)->getUrl('gallerymanager.css'), 1);
RokCommon_Header::addScript(RokCommon_Composite::get($that->context)->getUrl('../../assets/application/Scrollbar.js'), 1);
RokCommon_Header::addScript(RokCommon_Composite::get($that->context)->getUrl('gallerymanager.js'), 1);
RokCommon_Header::addInlineScript(RokCommon_Composite::get($that->context)->load('javascript.php', array('that'=>$that)));
