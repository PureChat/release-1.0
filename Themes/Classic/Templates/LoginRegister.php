<?php

class Themes_Classic_Templates_LoginRegister {

	public $theme_settings, $settings, $template_layers, $sidebar_contnet;

	public function __construct($theme_settings, $settings) {
		$this->theme_settings  = $theme_settings;
		$this->settings        = $settings;
		$this->sidebar_content = array();
		$this->template_layers = array(
			'head' => true,
			'content' => true,
			'sidebar' => true,
		);
	}

	public function head() {
		echo '
		<style>
		#footer {
			display: none !important;
		}
		</style>';
	}

	public function prepend() {}
 
    public function header() {}

	public function sidebar() {
		$this->sidebar_content['header'] = '
		<form action="index.php?action=user&perform=login" method="post" id="login_form">
			<input type="text" id="login_username" name="login_username" class="dark_input" placeholder="Email Address" />
			<input type="password" id="login_password" name="login_password" class="dark_input" placeholder="Password" />
			<input type="submit" class="universal_submit" value="Login!" />
		</form>';

		$this->sidebar_content['user_name'] = 'Guest';
		$this->sidebar_content['append'] = '<span id="guest_advice">You are currently logged out. Please use the form above to log back in.</span>';
	}

	public function content() {
		echo '
			<div id="register_container">
				<span class="section_header">
					<h2>Create an Account</h2>
					<span class="subtext">Please fill out the form below to create your account.</span>
				</span>
				<form action="index.php?action=user&perform=register" method="post" id="register_form">
					<!-- Display Name -->
					<div id="display_name_cont" class="form_field">
						<input type="text" class="light_input" placeholder="Display Name">
					</div>
					<!-- Email Address -->
					<div id="email_address_cont" class="form_field">
						<input type="email" class="light_input" placeholder="Email Address">
					</div>
					<!-- Password -->
					<div id="password_cont" class="form_field">
						<input type="password" class="light_input" placeholder="Password">
					</div>
					<!-- Password Repeat -->
					<div id="password_repeat_cont" class="form_field">
						<input type="password" class="light_input" placeholder="Password Again">
					</div>
					<!-- Submit Button -->
					<div id="register_submit_cont" class="form_field">
						<input type="submit" class="universal_submit" value="Create Account">
					</div>
				</form>
			</div>
			<br class="clear">';
	}
 
    public function footer() {}

	public function append() {}

}