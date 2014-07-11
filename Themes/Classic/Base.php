<?php

class Themes_Classic_Base extends Abstracts_ThemeBase {

	public $sub_template;

	public function __construct($sub_template_call = false) {

		$this->theme_settings = array(
			'key' => 'classic',
			'name' => 'Classic',
			'css_id' => 'classic',
			'creator' => 'The PureChat Team',
			'version' => '0.0.1 Alpha',
			'release-date' => 'May 28th, 2014',
		);

		$this->theme_settings['safe_name'] = htmlspecialchars($this->theme_settings['name'], ENT_QUOTES);

		$this->current_page = array(
			'url' => array(
				'title' => 'Login or Register | PureChat',
				'key' => 'main',
			),
			'wrapper_id' => 'main', //-- Optional: if left off, key will be used.
		);

		$this->getSettings();

		if (!isset($_REQUEST['page']) || $_REQUEST['page'] == 'main') {
			if (!isset($_SESSION['is_authenticated'])) {
				$this->sub_template = new Themes_Classic_Templates_Login($this->theme_settings, $this->settings);
			} else {
				$this->sub_template = new Themes_Classic_Templates_Chat();
			}
		}
	}

	public function head() {
		echo '
		<link rel="stylesheet" type="text/css" href="', $this->settings['theme']['css_url'], 'classic.css" />';
	}

	public function prepend() {}

	public function header() {}

    public function sidebar() {
		echo '
			<div id="logo">
				<a href="index.php?page=main" title="PureChat"></a>
			</div>';

		if ($this->sub_template->template_layers['sidebar'] === true) {
			$this->sub_template->sidebar();
		}
    }

	public function content() {
	}
 
    public function footer() {
        //-- Copyright and such here
    }

	public function append() {}

}