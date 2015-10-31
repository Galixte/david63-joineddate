<?php
/**
*
* @package Joined Date Format Extension
* @copyright (c) 2015 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace david63\joineddate\migrations;

class version_1_0_1 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('david63\joineddate\migrations\version_1_0_0');
	}

	public function update_data()
	{
		return array(
			array('config.remove', array('version_joineddate')),
		);
	}
}
