<?php

class Themes_Modern_Templates_LoginRegister {

	public $theme_settings, $settings, $template_layers;

	public function __construct($theme_settings, $settings) {
		$this->theme_settings  = $theme_settings;
		$this->settings        = $settings;
		$this->template_layers = array(
			'header' => true
		);
	}

	public function head() {}

	public function prepend() {}
 
    public function header() {
		echo '
			<div id="login" class="floatright">
				<input type="text" name="user" id="user" placeholder="Username or Email" class="login_field" />
				<span id="password_cont">
					<input type="password" name="password" id="password" placeholder="Password" class="login_field" />
				</span>
				<input type="submit" value="Login" id="login_submit" class="login_field" />
			</div>
			<br class="clear" />';
    }

	public function content() {}
 
    public function footer() {}

	public function append() {}

}