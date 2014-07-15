<?php

abstract class Abstracts_ThemeBase {

	//-- All of the abstract (required) methods.
	abstract public function __construct($context, $sub_template_call);
	abstract public function head();
	abstract public function prepend();
	abstract public function header();
	abstract public function sidebar();
	abstract public function content();
	abstract public function footer();
	abstract public function append();

	public $settings;
	public $current_page, $theme_settings;
	public $context;

	//-- Common and accessible methods.
	public function titleUrl() {
		echo $this->current_page['url']['title'];
	}

	public function getWrapperId() {
		if (empty($this->current_page['wrapper_id'])) {
			$this->current_page['wrapper_id'] = $this->current_page['url']['key'];
		}
		echo $this->current_page['wrapper_id'];
	}

	public function getSettings() {
		$this->settings = array(
			'page' => array(
				'url' => 'index.php?page=' . $this->current_page['url']['key'],
			),
			'theme' => array(
				'assets_url' => 'Themes/' . $this->theme_settings['key'] . '/Assets/',
				'images_url' => 'Themes/' . $this->theme_settings['key'] . '/Assets/images/',
				'css_url' => 'Themes/' . $this->theme_settings['key'] . '/Assets/css/',
				'javascript_url' => 'Themes/' . $this->theme_settings['key'] . '/Assets/javascript/',
			),
		);
		return $this->settings;
	}

	public function setFormContext($for_template) {
		$this->context = $for_template;
	}
    
}