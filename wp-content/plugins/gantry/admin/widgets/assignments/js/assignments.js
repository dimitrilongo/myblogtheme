/**
 * @version $Id: assignments.js 58644 2012-12-17 22:52:30Z djamil $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

Gantry.Assignments = {
	opacity: {
		'overlay': 0.7,
		'label': 0.5
	},
	init: function() {
		Gantry.Assignments.assigned = document.id('assigned_override_items').get('value').unserialize() || {};
		Gantry.Assignments.fireUp(); // 0ms
		Gantry.Assignments.overlays(); // 500ms
		Gantry.Assignments.blocks(); // 117ms
		Gantry.Assignments.loadDefaults();
	},



	overlays: function() {
		var divCopy = new Element('div', {'class': 'inherit-overlay'});
		var wrappers = $$('.gantry-field').getFirst('.wrapper').filter(function(wrapper) {
			if (!wrapper) return false;
			var input = wrapper.getParent('.gantry-field').getElement('.inherit-checkbox input[type=checkbox]');
			if (input) wrapper.store('gantry:inherit_input', input);
			else {
				var div = divCopy.clone().inject(wrapper, 'top');
				var label = wrapper.getParent('.gantry-field').getElement('label');
				div.setStyle('height', wrapper.getParent('.gantry-field').getSize().y - 2).setStyle('opacity', Gantry.Assignments.opacity.overlay);
				if (label) label.setStyle('opacity', Gantry.Assignments.opacity.label);
			}
			return input;
		});
		wrappers.each(function(wrapper) {
			var input = wrapper.retrieve('gantry:inherit_input');
			var label = input.getParent('.field-label').getElement('.base-label label');
			var div = divCopy.clone().inject(wrapper, 'top');

			var fields = input.getParent('.gantry-field').getElements('div.wrapper input, div.wrapper select'), obj = {};
			fields.each(function(field) {
				var id = field.get('id'), value = field.get('value');

				if (field.hasClass('toggle')) value = field.getPrevious().get('value');

				if (id) obj[id] = value;
				field.store('gantry:override_checkbox', input);
			});
			input.store('gantry:fields', obj);

			div.setStyle('height', wrapper.getParent('.gantry-field').getSize().y - 2).setStyle('opacity', Gantry.Assignments.opacity.overlay);
			input.addEvent('click', function() {
				if (this.get('checked')) {
					label.setStyle('opacity', 1);
					div.setStyles({'display': 'none', 'visibility': 'hidden'});
					Gantry.Assignments.updateBadge('+', this);

					fields.each(function(field) {
						if (field.hasClass('toggle-input')) field.fireEvent('set', [field.retrieve('details'), obj[field.id]]);
						else field.fireEvent('set', obj[field.id]);
					});
				}
				else {
					label.setStyle('opacity', Gantry.Assignments.opacity.label);
					div.setStyles({'display': 'block', 'visibility': 'visible'});
					Gantry.Assignments.updateBadge('-', this);

					fields.each(function(field) {
						obj[field.id] = field.get('value');
						if (field.hasClass('toggle-input')) field.fireEvent('set', [field.retrieve('details'), Gantry.Assignments.defaults.get(field.id)]);
						else field.fireEvent('set', Gantry.Assignments.defaults.get(field.id));
					});
				}
			});
			if (input.get('checked')) div.setStyles({'display': 'none', 'visibility': 'hidden'});
			else label.setStyles({'display': 'block', 'opacity': Gantry.Assignments.opacity.label});
		});
	},

	blocks: function() {
		Gantry.Assignments.blocks = $$('.assignments-block');
		Gantry.Assignments.List = document.id('assigned-list');
		Gantry.Assignments.ClearList = document.id('selection-list').getElement('.footer-block a');
		Gantry.Assignments.Empty = new Element('li', {'class': 'empty'}).set('text', 'No Item.');
		Gantry.Assignments.blocks.each(function(block) {
			Gantry.Assignments.manageBlock(block);
		});

		/*Gantry.Assignments.blocks.addEvents({
			'mouseenter': function() { if (this.getElements('li[class!=empty][class!=list-type]').length) this.addClass('hover'); },
			'mouseleave': function() { this.removeClass('hover'); }
		});*/

		if (Gantry.Assignments.ClearList) {
			Gantry.Assignments.ClearList.addEvent('click', function(e) {
				e.stop();
				var children = Gantry.Assignments.List.getChildren();
				if (children.length == 1 && children[0].hasClass('empty')) return;

				children.each(function(child) {
					child.getElement('.delete-assigned').fireEvent('click');
				});
			});
		}
	},

	loadDefaults: function() {
		Gantry.Assignments.defaultsXHR = new Request({
		    url: AdminURI,
			onSuccess: function(response) {
				Gantry.Assignments.defaults = new Hash(JSON.decode(response));
			}
		}).post({
		    action: 'gantry_admin',
		    model: 'overrides',
		    gantry_action: 'get_base_values'
		});
	},

	manageBlock: function(block, children) {
		var selectall = block.getElement('.select-all'), ata = block.getElement('.add-to-assigned'), title = block.getElement('h2 .assignment-checkbox');
		var inside = (children) ? block.getElements(children) : block.getElements('.inside ul .assignment-checkbox');

		block.getElements('a.no-link-item').addEvent('click', function(e) { e.stop(); });

		if (title) title.store('gantry:in_list', false);
		inside.store('gantry:in_list', false);

		if (!selectall || !ata) return;
		selectall.addEvent('click', function(e) {
			e.stop();
			var checked = inside.get('checked');
			if (!checked.contains(true) || !checked.contains(false)) inside.fireEvent('click');
			else {
				checked.each(function(check, i) {
					if (!check) inside[i].fireEvent('click');
				});
			}
		});

		if (title) {
			title.addEvent('click', function() {
				var labels = this.getParent('div').getElements('.inside label, .select-all');

				if (this.checked || this.retrieve('gantry:in_list')) labels.setStyle('display', 'none');
				else labels.setStyle('display', 'block');
			});
		}

		ata.addEvent('click', function(e) {
			var list = Gantry.Assignments.List;
			if (list) {
				e.stop();

				if (title && title.get('checked') && !title.retrieve('gantry:in_list')) {
					title.fireEvent('click');
					Gantry.Assignments.addAssigned(list, title, true);
				} else {
					var checked = inside.filter(function(li) {
						var status = li.get('checked') && !li.retrieve('gantry:in_list');
						if (li.get('checked')) li.fireEvent('click');
						return status;
					}).reverse();

					checked.each(function(item) {
						Gantry.Assignments.addAssigned(list, item);
					});
				}
			}
		});
	},

	updateBadge: function(type, el) {
		var panel = document.id(el).getParent('.gantry-panel').className.replace(/[panel|\-|\s|gantry]/g, '').toInt() - 1;
		var tab = Gantry.tabs[panel];
		if (tab) {
			var badgeWrap = tab.getElement('.overrides-involved');
			var badge = badgeWrap.getElement('span');
			var value = badge.get('text').toInt();
			if (type == '+') value += 1;
			else value -= 1;

			if (value < 0) value = 0;

			badge.set('text', value);
			if (!value) {
				badgeWrap.getParent('.badges-involved').removeClass('double-badge');
				badgeWrap.setStyle('display', 'none');
			}
			else {
				if (badgeWrap.getPrevious('.presets-involved').getStyle('display') == 'block') badgeWrap.getParent('.badges-involved').addClass('double-badge');
				else badgeWrap.getParent('.badges-involved').removeClass('double-badge');
				badgeWrap.setStyles({'display': 'block', 'opacity': 1, 'visibility': 'visible'});
			}
		}
	},

	fireUp: function() {
		for(var archetype in Gantry.Assignments.assigned) {
			for(var type in Gantry.Assignments.assigned[archetype]) {
				if (typeof Gantry.Assignments.assigned[archetype][type] == 'object') {
					var data = [];
					for(var value in Gantry.Assignments.assigned[archetype][type]) {
						data.push(Gantry.Assignments.assigned[archetype][type][value].toInt());
					}
					Gantry.Assignments.assigned[archetype][type] = data;
				}
			}
		}

		document.id('assigned-list').getElements('.link a, .link span').each(function(item) {
			var li = item.getParent('li'), list = document.id('assigned-list');
			var deleter = li.getElement('.delete-assigned');
			var data = (item.get('rel') || item.get('class'));
			var block = document.getElement('a[rel='+data+'], span[class='+data+']');
			var title = (item.get('tag') == 'span');

			if (block) {
				var ref = block;
				if (ref) {
					ref.store('gantry:in_list', true);
					deleter.addEvent('click', function() {
						Gantry.Assignments.exclude(li);
						li.empty().dispose();
						ref.store('gantry:in_list', false);

						if (title) {
							ref.getParent('.assignments-block').getElement('h2').removeClass('added');
							ref.getParent('.assignments-block').getElements('.inside, .inside li').removeClass('added');
							//ref.getParent().getElement('.assignment-checkbox').fireEvent('click');
							var labels = ref.getParent('div').getElements('.inside label, .select-all');
							labels.setStyle('display', 'block');

						} else {
							ref.getParent('li').removeClass('added');
						}
						if (!list.getChildren().length) {
							Gantry.Assignments.Empty.clone().inject(list);
							if (list.getNext('.footer-block')) list.getNext('.footer-block').setStyle('display', 'none');
						}
					});
				}
			} else {

			}
			//item.store('gantry:in_list', true);
		});
	},

	addAssigned: function(list, item, title) {
		item.store('gantry:in_list', true);
		item.getParent((title) ? 'h2' : 'li').addClass('added');
		if (title) item.getParent('.assignments-block').getElement('.inside').addClass('added');
		var deleter = new Element('span', {'class': 'delete-assigned'}), copy;
		if (!title) {
			copy = new Element('li').adopt(
				new Element('span', {'class': 'type'}).set('text', item.getParent('.assignments-block').getElement('h2').className.replace(/\-/g, " ")),
				deleter,
				new Element('span', {'class': 'link'}).adopt(item.getParent('li').getElement('a').clone())
			);
		} else {
			var titleSpan = item.getParent('h2').getElement('span');
			copy = new Element('li', {'class': 'list-type'}).adopt(
				new Element('span', {'class': 'type'}).set('text', "Type"),
				deleter,
				new Element('span', {'class': 'link'}).set('html', '<span class="'+titleSpan.className+'">'+titleSpan.get('text') + '</span>')
			);
		}
		deleter.addEvent('click', function() {
			var li = this.getParent('li');
			Gantry.Assignments.exclude(copy);
			li.empty().dispose();
			item.store('gantry:in_list', false);
			item.getParent((title) ? 'h2' : 'li').removeClass('added');
			if (title) item.getParent('.assignments-block').getElements('.inside, .inside li').removeClass('added');
			if (title) {
				var labels = item.getParent('div').getElements('.inside label, .select-all');
				labels.setStyle('display', 'block');

			};
			if (!list.getChildren().length) {
				Gantry.Assignments.Empty.clone().inject(list);
				if (list.getNext('.footer-block')) list.getNext('.footer-block').setStyle('display', 'none');
			}
		});
		copy.store('gantry:ref_item', item);
		if (list.getElement('.empty')) list.getElement('.empty').dispose();
		if (list.getNext('.footer-block')) list.getNext('.footer-block').setStyle('display', 'block');
		copy.inject(list, 'top');

		if (title) {
			var items = Gantry.Assignments.List.getElements('.link a[rel^='+titleSpan.className+'::]');
			items.getParent('li').getElement('.delete-assigned').fireEvent('click');
		}

		Gantry.Assignments.include(copy);
	},

	include: function(item, load) {
		var Assigned = Gantry.Assignments.assigned;
		var element = item.getElement('.link').getFirst();
		var value = element.get('rel') || element.className;
		value = value.split("::");
		var data = {'archetype': value[0], 'type': value[1], 'id': value[2] || -1};

		if (!Assigned[data.archetype]) Assigned[data.archetype] = {};
		if (!Assigned[data.archetype][data.type]) Assigned[data.archetype][data.type] = [];
		if (!Assigned[data.archetype][data.type].contains(data.id)) Assigned[data.archetype][data.type].push(data.id.toInt());
		if (Assigned[data.archetype][data.type].length == 1 && Assigned[data.archetype][data.type][0] == -1) Assigned[data.archetype][data.type] = true;

		if (!load) document.id('assigned_override_items').set('text', serialize(Assigned));
	},

	exclude: function(item, load) {
		var Assigned = Gantry.Assignments.assigned;
		var element = item.getElement('.link').getFirst();
		var value = element.get('rel') || element.className;
		value = value.split("::");
		var data = {'archetype': value[0], 'type': value[1], 'id': value[2] || -1};

		if (Assigned[data.archetype]) {
			if (typeof Assigned[data.archetype][data.type] == 'array') {
				Assigned[data.archetype][data.type].erase(data.id.toInt());
				if (!Assigned[data.archetype][data.type].length) delete Assigned[data.archetype][data.type];
			} else {
				delete Assigned[data.archetype][data.type];
			}
		}
		if (GantryObjIsEmpty(Assigned[data.archetype])) delete Assigned[data.archetype];

		//if (Assigned[data.archetype][data.type].length == 1 && Assigned[data.archetype][data.type][0] == -1) Assigned[data.archetype][data.type] = true;

		if (!load) document.id('assigned_override_items').set('text', serialize(Assigned));
	}
};

var GantryObjIsEmpty = function(obj) {
	for(var i in obj){ return false;}
  	return true;
};

window.addEvent('domready', Gantry.Assignments.init);
