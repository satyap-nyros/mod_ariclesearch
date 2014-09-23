<?php
/**
 * @copyright	Copyright (c) 2014 Gsearch. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Gsearch - Ariclesearch Helper Class.
 *
 * @package		Joomla.Site
 * @subpakage	Gsearch.Ariclesearch
 */
class modAriclesearchHelper {
	
	public function searchArticles($art_id)
	{
		$db =& JFactory::getDBO();       
		$query  = $db->getQuery(true);
		$query->select('*')
		      ->from('#__content')
		      ->where('id = '.$art_id);
		$db->setQuery($query,0,1);
		$rows = $db->loadObject();
		return $rows;
	}
	
}
