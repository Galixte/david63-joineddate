<?php
/**
*
* @package Joined Date Format Extension
* @copyright (c) 2015 david63
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace david63\joineddate\controller;

use Symfony\Component\DependencyInjection\ContainerInterface;

use david63\joineddate\ext;

/**
* Admin controller
*/
class admin_controller implements admin_interface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var ContainerInterface */
	protected $container;

	/** @var string Custom form action */
	protected $u_action;

	/**
	* Constructor for admin controller
	*
	* @param \phpbb\config\config		$config		Config object
	* @param \phpbb\request\request		$request	Request object
	* @param \phpbb\template\template	$template	Template object
	* @param \phpbb\user				$user		User object
	* @param ContainerInterface			$container	Service container interface
	*
	* @return \phpbb\logsearches\controller\admin_controller
	* @access public
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, \phpbb\log\log $log)
	{
		$this->config	= $config;
		$this->request	= $request;
		$this->template	= $template;
		$this->user		= $user;
		$this->log		= $log;
	}

	/**
	* Display the options a user can configure for this extension
	*
	* @return null
	* @access public
	*/
	public function display_options()
	{
		// Create a form key for preventing CSRF attacks
		$form_key = 'joineddate';
		add_form_key($form_key);

		// Is the form being submitted
		if ($this->request->is_set_post('submit'))
		{
			// Is the submitted form is valid
			if (!check_form_key($form_key))
			{
				trigger_error($this->user->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			// If no errors, process the form data
			// Set the options the user configured
			$this->set_options();

			// Add option settings change action to the admin log
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'JOINED_DATE_LOG');

			// Option settings have been updated and logged
			// Confirm this to the user and provide link back to previous page
			trigger_error($this->user->lang('CONFIG_UPDATED') . adm_back_link($this->u_action));
		}

		$this->template->assign_vars(array(
			'FORMAT_MEMBERLIST'		=> $this->get_dateformat_select($this->config['joined_dateformat_memberlist'], 'joined_dateformat_memberlist'),
			'FORMAT_PROFILE'		=> $this->get_dateformat_select($this->config['joined_dateformat_profile'], 'joined_dateformat_profile'),
			'FORMAT_VIEWTOPIC'		=> $this->get_dateformat_select($this->config['joined_dateformat_viewtopic'], 'joined_dateformat_viewtopic'),
			'JOINED_DATE_VERSION'	=> ext::JOINED_DATE_FORMAT_VERSION,

			'U_ACTION'			=> $this->u_action,
		));
	}

	/**
	* Set the options a user can configure
	*
	* @return null
	* @access protected
	*/
	protected function set_options()
	{
		$this->config->set('joined_dateformat_memberlist', $this->request->variable('joined_dateformat_memberlist', ''));
		$this->config->set('joined_dateformat_profile', $this->request->variable('joined_dateformat_profile', ''));
		$this->config->set('joined_dateformat_viewtopic', $this->request->variable('joined_dateformat_viewtopic', ''));
	}

	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return null
	* @access public
	*/
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}

	/**
	* Select default dateformat
	*/
	protected function get_dateformat_select($value, $key)
	{
		$dateformat_options = '';

		foreach ($this->user->lang['dateformats'] as $format => $null)
		{
			$dateformat_options .= '<option value="' . $format . '"' . (($format == $value) ? ' selected="selected"' : '') . '>';
			$dateformat_options .= $this->user->format_date(time(), $format, false) . ((strpos($format, '|') !== false) ? $this->user->lang['VARIANT_DATE_SEPARATOR'] . $this->user->format_date(time(), $format, true) : '');
			$dateformat_options .= '</option>';
		}

		$dateformat_options .= '<option value="custom"';
		if (!isset($this->user->lang['dateformats'][$value]))
		{
			$dateformat_options .= ' selected="selected"';
		}
		$dateformat_options .= '>' . $this->user->lang['CUSTOM_DATEFORMAT'] . '</option>';

		return "<select name=\"dateoptions\" id=\"dateoptions\" onchange=\"if (this.value == 'custom') { document.getElementById('" . addslashes($key) . "').value = '" . addslashes($value) . "'; } else { document.getElementById('" . addslashes($key) . "').value = this.value; }\">$dateformat_options</select><br />
		<input type=\"text\" name=\"$key\" id=\"$key\" value=\"$value\" maxlength=\"30\" />";
	}
}
