<?php
/**
 * @version   $Id: widgets.php 57539 2012-10-14 17:29:59Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Model_Widgets extends RokSprocket_Model_AbstractModel
{
	protected $available_instances;

	/**
	 * @return mixed
	 */
	public function getAvailableInstances()
	{
        global $wpdb;
		if (!isset($this->available_instances)) {
			$query                     = 'SELECT id, title FROM ' . $wpdb->prefix . 'roksprocket AS a ORDER BY a.title';
			$this->available_instances = $wpdb->get_results($query, ARRAY_A);
		}
		return $this->available_instances;
	}


	public function getInstanceInfo($id)
	{
		$query = 'SELECT * FROM ' . $this->db->prefix . 'roksprocket AS a where a.id = ' . $id . ' ORDER BY a.title';
		$row   = $this->db->get_results($query, ARRAY_A);
		if (empty($row)) return null;
		$widget_instance = RokSprocket_Model_Object_Widget::genereateFromArray($row[0]);
		$registry = new RokCommon_Registry();
		if (!is_null($widget_instance->params)) {
			$registry->loadString($widget_instance->params);
		}
		$registry->set('module_id', $widget_instance->getId());
		$widget_instance->params   = $registry;
		return $widget_instance;
	}
}
