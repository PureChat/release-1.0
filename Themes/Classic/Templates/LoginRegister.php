<?php

class Themes_Classic_Templates_LoginRegister {

	public $theme_settings, $settings, $context;
	public $template_layers, $sidebar_content;

	public function __construct($theme_settings, $settings, $context) {
		$this->theme_settings  = $theme_settings;
		$this->settings        = $settings;
		$this->context         = $context;
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
		<form action="index.php?action=login" method="post" id="login_form">
			<input type="text" id="login_username" name="login_username" class="dark_input" maxlength="80" placeholder="Email Address" required autofocus>
			<input type="password" id="login_password" name="login_password" class="dark_input" maxlength="150" placeholder="Password" required>
			<input type="submit" class="universal_submit" value="Login">
		</form>';

		$this->sidebar_content['user_name'] = 'Guest';
		$this->sidebar_content['append'] = '<span id="guest_advice">You are currently logged out. Please use the form above to log back in.</span>';
	}

	public function content() {
		if (!empty($this->context['activation_status']) && $this->context['activation_status'] == 'account_active') {
			echo '
			<div id="account_activated" class="success_box">
			Your account is now activated! You can now login on the sidebar.
			</div>';
		}
		echo '
			<div id="register_container">
				<span class="section_header">
					<h2>Create an Account</h2>
					<span class="subtext">Please fill out the form below to create your account.</span>
				</span>';
				if (!empty($this->context['registration_errors'])) {
					echo '
					<div id="registration_errors" class="error_box">
						The following error', count($this->context['registration_errors']) > 1 ? 's were encountered' : ' was encountered', ':
						<ul>';
						foreach ($this->context['registration_errors'] as $key => $value) {
							echo '<li id="', $key, '">', $value, '</li>';
						}
						echo '
						</ul>
					</div>';
				}
				echo '
				<form action="index.php?action=register" method="post" id="register_form">
					<!-- Display Name -->
					<div id="display_name_cont" class="form_field">
						<input type="text" id="display_name" name="display_name" class="light_input" maxlength="35" placeholder="Display Name" required', !empty($_POST['display_name']) ? ' value="' . $_POST['display_name'] . '"' : '', '>
					</div>
					<!-- Email Address -->
					<div id="email_address_cont" class="form_field">
						<input type="email" id="email_address" name="email_address" class="light_input" maxlength="80" placeholder="Email Address" required', !empty($_POST['email_address']) ? ' value="' . $_POST['email_address'] . '"' : '', '>
					</div>
					<!-- Password -->
					<div id="password_cont" class="form_field">
						<input type="password" id="password" name="password" class="light_input" maxlength="150" placeholder="Password" required', !empty($_POST['password']) ? ' value="' . $_POST['password'] . '"' : '', '>
					</div>
					<!-- Password Repeat -->
					<div id="password_repeat_cont" class="form_field">
						<input type="password" id="password_repeat" name="password_repeat" class="light_input" maxlength="150" placeholder="Password Again" required', !empty($_POST['password_repeat']) ? ' value="' . $_POST['password_repeat'] . '"' : '', '>
					</div>
					<!-- Submit Button -->
					<div id="submit_cont" class="form_field">
						<input type="submit" class="universal_submit" value="Create Account">
					</div>
					<!-- Hidden Fields -->
					<input type="hidden" id="registering" name="registering" value="1">
				</form>
			</div>
			<br class="clear">';
	}
 
    public function footer() {}

	public function append() {}

}