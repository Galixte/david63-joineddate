<?php
/**
*
* @package Joined Date Format Extension
* @copyright (c) 2015 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace david63\joineddate\acp;

class joineddate_options_module
{
	public $u_action;

	function main($id, $mode)
	{
		global $phpbb_container, $user;

		$this->tpl_name		= 'joineddate_options';
		$this->page_title	= $user->lang('JOINED_DATE_FORMAT');

		// Get an instance of the admin controller
		$admin_controller = $phpbb_container->get('david63.joineddate.admin.controller');

		$admin_controller->display_options();
	}
}
