<?php
/**
 * @version   $Id: abstractmodel.php 57411 2012-10-11 19:45:54Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

class RokSprocket_Model_AbstractModel
{
	/**
	 *
	 */
	const MAIN_TABLE = 'roksprocket';
	/**
	 *
	 */
	const ITEMS_TABLE = 'roksprocket_items';

	/**
	 * @var wpdb
	 */
	protected $db;

	/**
	 *
	 */
	public function __construct()
	{
		global $wpdb;
		$this->db = $wpdb;
	}

	/**
	 * @return string
	 */
	public function getLastError()
	{
		return $this->db->last_error;
	}
}
