/**
 * @version   1.5 November 13, 2012
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright © 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

var OAuthToggle = {
	init: function() {
		var no = document.id('use_oauth0'), yes = document.id('use_oauth1');
		
		OAuthToggle.rows = no.getParent('#roktwittie-settings').getElements('#consumer_key, #consumer_secret, #signin-key').getParent('tr');
		[yes, no].each(function(radio, i) {
			radio.addEvent('click', function() {
				if (!i && radio.checked) OAuthToggle.show();
				if (i && radio.checked) OAuthToggle.hide();	
			});
		});
		
		if (no.checked) no.fireEvent('click');
		if (yes.checked) yes.fireEvent('click');
	},
	
	show: function() {
		OAuthToggle.rows.setStyle('display', 'table-row');
	},
	
	hide: function() {
		OAuthToggle.rows.setStyle('display', 'none');		
	}
};

window.addEvent('domready', OAuthToggle.init);