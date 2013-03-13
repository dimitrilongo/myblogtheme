<?php
/**
 * @version   1.5 November 13, 2012
 * @author    RocketTheme, LLC http://www.rockettheme.com
 * @copyright Copyright © 2007 - 2012 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */

/**
 * Interface of cache driver strategy
 *
 * @access public
 * @author Mateusz 'MatheW' Wójcik, <mat.wojcik@gmail.com>
 * @link http://mwojcik.pl
 * @license GPL
 * @version 1.0
 */
interface RokTwittie_CacheDriver
{
	/**
	 * Sets data to cache
	 *
	 * @param string $groupName Name of group of cache
	 * @param string $identifier Identifier of data
	 * @param mixed $data Data
	 * @return boolean
	 */
	public function set($groupName, $identifier, $data);

	/**
	 * Gets data from cache
	 *
	 * @param string $groupName Name of group
	 * @param string $identifier Identifier of data
	 * @return mixed
	 */
	public function get($groupName, $identifier);

	/**
	 * Clears cache of specified identifier of group
	 *
	 * @param string $groupName Name of group
	 * @param string $identifier Identifier
	 * @return boolean
	 */
	public function clearCache($groupName, $identifier);

	/**
	 * Clears cache of specified group
	 *
	 * @param string $groupName Name of group
	 * @return boolean
	 */
	public function clearGroupCache($groupName);

	/**
	 * Clears all cache generated by this class with this driver
	 *
	 * @return boolean
	 */
	public function clearAllCache();

	/**
	 * Gets last modification time of specified cache data
	 *
	 * @param string $groupName Name of group
	 * @param string $identifier Identifier
	 * @return int
	 */
	public function modificationTime($groupName, $identifier);

	/**
	 * Check if cache data exists
	 *
	 * @param string $groupName Name of group
	 * @param string $identifier Identifier
	 * @return boolean
	 */
	public function exists($groupName, $identifier);

} /* end of interface CacheDriver */

?>