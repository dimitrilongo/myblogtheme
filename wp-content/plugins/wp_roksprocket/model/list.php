<?php
/**
 * @version   $Id: list.php 57482 2012-10-12 20:43:26Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/**
 *
 */
class RokSprocket_Model_List extends RokSprocket_Model_AbstractModel
{
	/**
	 * @param $id
	 *
	 * @return bool
	 */
	public function delete($id)
	{
		if ($this->db->delete($this->db->prefix.self::MAIN_TABLE, array('id'=> $id)) !== false) {
			$this->db->delete($this->db->prefix.self::ITEMS_TABLE, array('widget_id'=> $id));
			return true;
		}
		return false;
	}
}
