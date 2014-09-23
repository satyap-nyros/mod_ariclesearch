<?php
/**
 * @copyright	@copyright	Copyright (c) 2014 Gsearch. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;


// include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';
if(isset($_POST['exe']))
{
if(isset($_POST['articles']) && !empty($_POST['articles']))
{
	$t = '';
	for($i=0;$i<count($_POST['articles']);$i++)
	{
		$res = modAriclesearchHelper::searchArticles($_POST['articles'][$i]['value']);		
		$t = $t .'<a href="index.php?option=com_content&view=article&id='.$res->id.'">'.$res->title.'</a><br /><br />';
		$t = $t . '<div class="comment more">'.$res->introtext.'</div><hr />';
	}
		
		echo $t;exit;
}
echo '';exit;
}
$class_sfx = htmlspecialchars($params->get('class_sfx'));
require(JModuleHelper::getLayoutPath('mod_ariclesearch', $params->get('layout', 'default')));




