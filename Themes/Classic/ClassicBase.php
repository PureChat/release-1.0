<?php

class Themes_Classic_ClassicBase extends Abstracts_ThemeBase {

	public $sub_template;

	public function __construct($sub_template_call = false) {

		$this->theme_settings = array(
			'key' => 'Classic',
			'name' => 'Classic',
			'css_id' => 'classic',
			'creator' => 'The PureChat Team',
			'version' => '0.0.1 Alpha',
			'release-date' => 'July 11th, 2014',
		);

		$this->theme_settings['safe_name'] = htmlspecialchars($this->theme_settings['name'], ENT_QUOTES);

		$this->current_page = array(
			'url' => array(
				'title' => 'PureChat | Login or Register',
				'key' => 'main',
			),
			'wrapper_id' => 'main', //-- Optional: if left off, key will be used.
		);

		$this->getSettings();

		if (!isset($_REQUEST['page']) || $_REQUEST['page'] == 'main') {
			if (!isset($_SESSION['is_authenticated'])) {
				$this->sub_template = new Themes_Classic_Templates_LoginRegister($this->theme_settings, $this->settings);
			} else {
				$this->sub_template = new Themes_Classic_Templates_Chat();
			}
		}
	}

	public function head() {
		echo '
		<link rel="shortcut icon" href="', $this->settings['theme']['images_url'], 'icon.ico" />
		<link rel="stylesheet" type="text/css" href="', $this->settings['theme']['css_url'], 'classic.css" />
		<script src="', $this->settings['theme']['javascript_url'], 'classic.js"></script>';
	}

	public function prepend() {}
 
	public function header() {
		if (isset($this->sub_template->template_layers['header'])) {
			$this->sub_template->header();
		}
	}

	public function sidebar() {

		if (isset($this->sub_template->template_layers['sidebar'])) {
			$this->sub_template->sidebar();
		}

		echo '
			<div id="sidebar_header_padded">
				', $this->sub_template->sidebar_content['header'], '
			</div>
			<div id="sidebar_user_info">
				<span id="sidebar_user_name">', $this->sub_template->sidebar_content['user_name'], '</span>
				', $this->sub_template->sidebar_content['append'], '
			</div>
			<div id="sidebar_user_status" class="user_status_guest">
				<div id="shine_overlay"></div>
			</div>
		';
	}

	public function content() {
		if (isset($this->sub_template->template_layers['content'])) {
			$this->sub_template->content();
		}
	}
 
	public function footer() {
		if (isset($this->sub_template->template_layers['footer'])) {
			$this->sub_template->footer();
		}
	}

	public function append() {}

}