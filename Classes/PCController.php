<?php
/**
 * PureChat (PC)
 *
 * @file ~./Classes/PCController.php
 * @author The PureChat Team
 * @copyright 2012-2014 PureChat.org <http://www.purechat.org>
 * @license GPL <http://www.gnu.org/licenses/>
 *
 * @version 0.0.1 (Alpha)
 * @file version 0.0.1 (Alpha)
 */
/**
 * This file is part of PureChat.

 * PureChat is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * PureChat is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with PureChat.  If not, see <http://www.gnu.org/licenses/>.
 */

define('PC_VERSION', 'v0.0.1 r1');
define('PC_COPYRIGHT', '&copy; 2012-2014 <a href="http://purechat.org/" target="_blank">PureChat</a>');

class Classes_PCController {

	public $database, $pc_utilities;

	//-- Utility Modules
	public $pc_buffer;

	public $pc_template;

	public function __construct() {

		$this->pc_utilities = new Classes_PCUtilities();

		$this->pc_buffer = $this->pc_utilities->loadModule('PCBuffer');
		$this->pc_buffer->sanitizeUserMethods();

		//-- Initiate our Storage System!
		$this->db_interperter = new Classes_PCDatabase('mysql');
		$this->db_storage     = $this->db_interperter->getStorageSystem();
		$this->database = $this->db_storage->startConnection();

		$form_errors = array();
		if (!empty($_REQUEST['action']) && $_REQUEST['action'] == 'register') {
			$registration = new Processes_Register($this->database);
			$registration->validateForm();
			$form_errors = $registration->getFormErrors();
		}

		//-- This is a very temporary theme switching technique.
		$theme_key   = 'Classic'; # Modern | Classic
		$theme_class = 'Themes_' . $theme_key . '_' . $theme_key . 'Base';
		$this->pc_template = new $theme_class($form_errors);
		//$this->pc_template->setFormErrors($form_errors);

	}

	public function initialize() {
		$template = $this->pc_template;
		echo '
<DOCTYPE html>
<html>
	<head>
		<title>', $template->titleUrl(), '</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="Assets/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="Assets/css/global.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- ', $template->theme_settings['safe_name'], ' Start Head -->', $template->head(), '
	</head>
	<!-- TODO: Add action_WHATEVER as a class to the body-->
	<body class="theme_', $template->theme_settings['css_id'], '">
		<!-- ', $template->theme_settings['safe_name'], ' Start Prepend -->', $template->prepend(), '
		<div id="header">
			<!-- ', $template->theme_settings['safe_name'], ' Start Header -->', $template->header(), '
		</div>
		<div id="sidebar">
			<!-- ', $template->theme_settings['safe_name'], ' Start Sidebar -->', $template->sidebar(), '
		</div>
		<div id="content">
			<!-- ', $template->theme_settings['safe_name'], ' Start Content -->', $template->content(), '
		</div>
		<div id="footer">
			<!-- ', $template->theme_settings['safe_name'], ' Start Footer -->', $template->footer(), '
		</div>
		<!-- ', $template->theme_settings['safe_name'], ' Start Append -->', $template->append(), '
	</body>
</html>
';
	}
}