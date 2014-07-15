<?php

/* TODO: We might want to make a new abstract class "FormsBase"
 * TODO: which has validateForm, getFormErrors, and $this->valid_fields, $this->context built-in.
*/
class Processes_Register {

	public $database;
	public $valid_fields;
	public $context;

	public function __construct($database) {
		$this->database     = $database;
		$this->context      = array();
		$this->valid_fields = array(
			'display_name',
			'email_address',
			'password',
			'password_repeat',
		);
	}

	public function validateForm() {

		$register_user = new Storage_MySQL_Guest($this->database);

		//-- Basic data sanitation.
		$_POST['display_name'] = !empty($_POST['display_name']) ? $_POST['display_name'] : '';
		$_POST['email_address'] = !empty($_POST['email_address']) ? $_POST['email_address'] : '';
		$_POST['password'] = !empty($_POST['password']) ? $_POST['password'] : '';
		$_POST['password_repeat'] = !empty($_POST['password_repeat']) ? $_POST['password_repeat'] : '';

		//-- All this block does is complains and tries to catch problems.
		if (!empty($_POST['display_name'])) {
			if ($register_user->checkDisplayExists($_POST['display_name']) === true) {
				$this->context['registration_errors']['existing_display_name'] = 'The display name "' . $_POST['display_name'] . '" is already in use.';
			} else if (strlen($_POST['display_name']) > 35) {
				$this->context['registration_errors']['exceeds_length_display_name'] = 'Your display name is ' . strlen($_POST['display_name']) . ' characters long, while the maximum length allowed is 35.';
			}
		} else {
			$this->context['registration_errors']['empty_display_name'] = 'Enter a display name.';
		}

		if (!empty($_POST['email_address']) && filter_var($_POST['email_address'], FILTER_VALIDATE_EMAIL) === false) {
			$this->context['registration_errors']['invalid_email_address'] = 'Enter a valid email address.';
		} else if (!empty($_POST['email_address']) && $register_user->checkEmailExists($_POST['email_address']) === true) {
			$this->context['registration_errors']['existing_email_address'] = 'The email address you entered is already in use.';
		} else if (empty($_POST['email_address'])) {
			$this->context['registration_errors']['empty_email_address'] = 'Enter an email address.';
		}

		if (!empty($_POST['password']) && !empty($_POST['password_repeat']) && $_POST['password'] !== $_POST['password_repeat']) {
			$this->context['registration_errors']['mismatching_passwords'] = 'The two passwords you entered do not match.';
		} else if (empty($_POST['password'])) {
			$this->context['registration_errors']['empty_password'] = 'Enter a password.';
		} else if (empty($_POST['password_repeat'])) {
			$this->context['registration_errors']['empty_password_repeat'] = 'Enter your password a second time.';
		}

		//-- Success!
		if (empty($this->context['registration_errors'])) {

			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip_address = $_SERVER['HTTP_CLIENT_IP'];
			} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip_address = $_SERVER['REMOTE_ADDR'];
			}

			$form_data = array(
				'display_name' => $_POST['display_name'],
				'email_address' => $_POST['email_address'],
				'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
				'roles_id' => 3, //-- TODO: Implement roles. Right now 3 = Regular Member
				'activation_code' => sha1(mt_rand(10000, 99999) . time() . $_POST['email_address']),
				'ip_address' => $ip_address,
				'hostname' => gethostname(),
			);

			$register_user->registerUser($form_data);
			//$user_id = $register_user->getNewUserId();

			mail($form_data['email_address'], 'PureChat Activation', 'Please click the following link to activate your account: ' . BASE_URL . '?action=activate_user&code=' . $form_data['activation_code']);
			$this->context['registration_complete'] = true;
			unset($_POST);
		}

	}

	public function getFormErrors() {
		return $this->context;
	}

}