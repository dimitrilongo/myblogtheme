<?php
 /**
  * @version   $Id$
  * @author    RocketTheme http://www.rockettheme.com
  * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
  * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
  */
// load up style sheets
RokCommon_Header::addStyle(RokCommon_Composite::get($that->context)->getUrl('gallery.css'));
RokCommon_Header::addStyle(RokCommon_Composite::get($that->style_context)->getUrl('style.css'));
RokCommon_Header::addInlineScript(RokCommon_Composite::get('rokgallery')->load('js-settings.php', array('that'=>$that)));
 
