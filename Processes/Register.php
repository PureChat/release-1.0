<?php

/* TODO: We might want to make a new abstract class "FormsBase"
 * TODO: which has validateForm, getFormErrors, and $this->valid_fields, $this->form_errors built-in.
*/
class Processes_Register {

	public $database;
	public $valid_fields;
	public $form_errors;

	public function __construct(PDO $database) {
		$this->database     = $database;
		$this->form_errors  = array();
		$this->valid_fields = array(
			'display_name',
			'email_address',
			'password',
			'password_repeat',
		);
	}

	public function validateForm() {

		//-- Basic data sanitation.
		$_POST['display_name'] = !empty($_POST['display_name']) ? $_POST['display_name'] : '';
		$_POST['email_address'] = !empty($_POST['email_address']) ? $_POST['email_address'] : '';
		$_POST['password'] = !empty($_POST['password']) ? $_POST['password'] : '';
		$_POST['password_repeat'] = !empty($_POST['password_repeat']) ? $_POST['password_repeat'] : '';

		//-- All this block does is complains and tries to catch problems.
		if (!empty($_POST['display_name'])) {
			if ($_POST['display_name'] == 'Labradoodle-360') {
				$this->form_errors['existing_display_name'] = 'The display name "' . $_POST['display_name'] . '" is already in use.';
			} else if (strlen($_POST['display_name']) > 35) {
				$this->form_errors['exceeds_length_display_name'] = 'Your display name is ' . strlen($_POST['display_name']) . ' characters long, while the maximum length allowed is 35.';
			}
		} else {
			$this->form_errors['empty_display_name'] = 'Enter a display name.';
		}

		if (!empty($_POST['email_address']) && filter_var($_POST['email_address'], FILTER_VALIDATE_EMAIL) === false) {
			$this->form_errors['invalid_email_address'] = 'Enter a valid email address.';
		} else if (empty($_POST['email_address'])) {
			$this->form_errors['empty_email_address'] = 'Enter an email address.';
		}

		if (!empty($_POST['password']) && !empty($_POST['password_repeat']) && $_POST['password'] !== $_POST['password_repeat']) {
			$this->form_errors['mismatching_passwords'] = 'The two passwords you entered do not match.';
		} else if (empty($_POST['password'])) {
			$this->form_errors['empty_password'] = 'Enter a password.';
		} else if (empty($_POST['password_repeat'])) {
			$this->form_errors['empty_password_repeat'] = 'Enter your password a second time.';
		}

		//-- Success!
		if (empty($this->form_errors)) {
			echo 'It appears you are a good kid!';
		}

	}

	public function getFormErrors() {
		return $this->form_errors;
	}

}