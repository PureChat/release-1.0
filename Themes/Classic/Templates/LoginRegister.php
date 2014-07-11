<?php

class Themes_Classic_Templates_LoginRegister {

	public $theme_settings, $settings, $template_layers, $sidebar_contnet;

	public function __construct($theme_settings, $settings) {
		$this->theme_settings  = $theme_settings;
		$this->settings        = $settings;
		$this->sidebar_content = array();
		$this->template_layers = array(
			'content' => true,
			'sidebar' => true,
		);
	}

	public function head() {}

	public function prepend() {}
 
    public function header() {}

	public function sidebar() {
		$this->sidebar_content['header'] = '
		<label>Display Name:</label><br /><input type="text" />
		<br />
		<label>Password:</label><br /><input type="password" />';
	}

	public function content() {
		echo '
			<div id="site_description" class="floatleft">
				<h2>Welcome to PureChat!</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis blandit neque. Praesent risus sem, bibendum non nisi eu, eleifend feugiat massa. Mauris leo dui, suscipit vel imperdiet sed, volutpat at lacus. Proin vehicula ante id enim vehicula rutrum. Etiam lobortis purus at ante ultrices mollis. Suspendisse varius sagittis nunc, a scelerisque tellus vestibulum ut. Sed quis vestibulum diam. Fusce vitae elit eget ante malesuada cursus vel et lectus. Proin laoreet, velit sit amet rhoncus ornare, nunc ipsum accumsan justo, ut luctus nisi diam id libero. In vel posuere dui, ut ullamcorper dolor. Mauris vel metus libero. Sed luctus in nibh id ornare. Praesent ut ultrices felis, sit amet blandit purus. Nulla tincidunt ligula nec mauris facilisis, a vulputate risus eleifend.<br><br>Duis et malesuada quam, non tincidunt urna. Donec gravida, diam nec cursus viverra, magna elit lacinia ligula, nec viverra nisi urna et risus. Quisque iaculis convallis massa ac bibendum. In eget imperdiet lorem. Pellentesque pellentesque aliquet venenatis. Phasellus porta facilisis erat, nec laoreet leo feugiat sed. Aenean posuere est sit amet risus blandit, id scelerisque tortor sollicitudin. Praesent pretium arcu vel tellus egestas, eu pretium nisl pellentesque. Quisque elementum massa leo, sit amet lobortis nunc mattis bibendum. Morbi et libero eu erat sagittis venenatis eu in metus. Fusce egestas dui ut mattis pharetra. Nullam vel lacus dapibus, dapibus quam id, dapibus purus. Suspendisse eleifend varius risus, at tempor est faucibus at. Praesent in magna imperdiet, viverra justo et, sodales turpis.
				</p>
			</div>
			<div id="register" class="floatright">
				<span class="section_header">
					<h2>Create an Account</h2>
					<span class="subtext">Please fill out the form below to create your account.</span>
				</span>
				<form action="#" method="post" id="registration_form">
					<!-- Display Name -->
					<div id="display_name_cont" class="form_field">
						<div class="floatleft left_column">
							<label for="display_name">Display Name</label>
							<span class="field_desc">This is the screen name that others will see.</span>
						</div>
						<div class="floatright right_column">
							<input type="text">
						</div>
						<br class="clear">
					</div>
					<!-- Email Address -->
					<div id="email_address_cont" class="form_field">
						<div class="floatleft left_column">
							<label for="email_address">Email</label>
							<span class="field_desc">We use this address to send you a confirmation email.</span>
						</div>
						<div class="floatright right_column">
							<input type="email">
						</div>
						<br class="clear">
					</div>
					<!-- Password -->
					<div id="password_cont" class="form_field">
						<div class="floatleft left_column">
							<label for="password">Password</label>
							<span class="field_desc">Please enter the password you wish to use. Note that all passwords are encrypted.</span>
						</div>
						<div class="floatright right_column">
							<input type="password">
						</div>
						<br class="clear">
					</div>
					<!-- Password Repeat -->
					<div id="password_repeat_cont" class="form_field">
						<div class="floatleft left_column">
							<label for="password_repeat">Password Again</label>
							<span class="field_desc">Enter the same password again.</span>
						</div>
						<div class="floatright right_column">
							<input type="password">
						</div>
						<br class="clear">
					</div>
					<!-- Submit Button -->
					<div id="register_submit_cont" class="form_field">
						<div class="floatleft left_column">
							<span id="registration_terms">By creating an account, you certify that you have read and agree to follow the <a href="#">User Agreement</a>.</span>
						</div>
						<div class="floatright right_column">
							<input type="submit" value="Create Account">
						</div>
						<br class="clear">
					</div>
				</form>
			</div>
			<br class="clear">';
	}
 
    public function footer() {}

	public function append() {}

}