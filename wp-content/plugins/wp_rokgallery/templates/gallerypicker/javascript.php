<?php
 /**
  * @version   $Id$
  * @author    RocketTheme http://www.rockettheme.com
  * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
  * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
  */

$url = $that->base_ajax_url;
echo "
	if (typeof RokGallery == 'undefined') var RokGallery = {};
	RokGallery.url = '" . $that->base_ajax_url . "';
	RokGallery.ajaxVars = {action: 'model_action', model: 'model'};
	window.addEvent('domready', function(){
		new GalleryPicker('rokgallerypicker', {url: RokGallerySettings.modal_url});
	});
";
