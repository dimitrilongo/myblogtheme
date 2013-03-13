/**
* @version   $Id: gantry-totop.js 1115 2012-06-20 02:43:12Z kevin $
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

window.addEvent('domready', function() {
	var handle = document.getElements('.rt-totop');
	if (handle.length) {
		var scroller = new Fx.Scroll(window);
		handle.setStyle('outline', 'none').addEvent('click', function(e) {
			e.stop();
			scroller.toTop();
		});
	}
});