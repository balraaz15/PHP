<?php
	class Users extends Controller {
		public function __construct() {
			$this->userModel = $this->model('User');
		}

		public function register() {
			// Check for POST
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				//Process Form for registration

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'title' => 'Register',
					'name' => trim($_POST['name']),
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'confirm_password' => trim($_POST['confirm_password']),
					'name_error' => '',
					'email_error' => '',
					'password_error' => '',
					'confirm_password_error' => ''
				];

				// Validate email
				if(empty($data['email'])) {
					$data['email_error'] = 'Please enter email.';
				} else {
					// Check existing email
					if($this->userModel->findUserByAttr('email', $data['email'])) {
						$data['email_error'] = 'Email is already taken';
					}
				}
				// Validate name
				if(empty($data['name'])) {
					$data['name_error'] = 'Please enter name.';
				}
				// Validate password
				if(empty($data['password'])) {
					$data['password_error'] = 'Please enter password.';
				} else if(strlen($data['password']) < 6) {
					$data['password_error'] = 'Password must be at least 6 characters.';
				}
				// Validate confirm_password
				if(empty($data['confirm_password'])) {
					$data['confirm_password_error'] = 'Please confirm password';
				} else {
					if($data['password'] != $data['confirm_password']) {
						$data['confirm_password_error'] = 'Passwords do not match.';
					}
				}

				// Make sure there are no errors
				if(empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
					// Validated
					// Hash Password
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

					// Register User and store in database
					if($this->userModel->register($data)) {
						flash('register_success', 'You are now registered. Please log in to continue.');
						redirect('users/signin');
					} else {
						die('Something went wrong');
					}

				} else {
					// Load view with errors
					$this->view('users/register', $data);
				}

			} else {
				// Load register form
				// Init data
				$data = [
					'title' => 'Register',
					'name' => '',
					'email' => '',
					'password' => '',
					'confirm_password' => '',
					'name_error' => '',
					'email_error' => '',
					'password_error' => '',
					'confirm_password_error' => ''
				];

				// Load register view
				$this->view('users/register', $data);
			}
		}

		public function signin() {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Process login for login

				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

				// Init data
				$data = [
					'title' => 'Login',
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'email_error' => '',
					'password_error' => ''
				];

				// Validate email
				if(empty($data['email'])) {
					$data['email_error'] = 'Please enter email.';
				} else {
					// Check for user/email
					if($this->userModel->findUserByAttr('email', $data['email'])) {
						// User found
					} else {
						flash('no_user', 'There are no user with that email.', 'warning');
						$data['email_error'] = 'Enter valid email.';
					}
				}
				// Validate password
				if(empty($data['password'])) {
					$data['password_error'] = 'Please enter password.';
				}

				// Make sure there are no errors
				if(empty($data['email_error']) && empty($data['password_error'])) {
					// Validated
					// Check and set logged in user
					$loggedInUser = $this->userModel->login($data['email'], $data['password']);
					if($loggedInUser) {
						// Create session
						$this->createUserSession($loggedInUser);
					} else {
						$data['password_error'] = 'Password Incorrect';
						$this->view('users/signin', $data);
					}

				} else {
					// Load view with errors
					$this->view('users/signin', $data);
				}
			} else {
				// Load login form
				// Init data
				$data = [
					'title' => 'Login',
					'email' => '',
					'password' => '',
					'email_error' => '',
					'password_error' => ''
				];
			}

			// Load login view
			$this->view('users/signin', $data);
		}

		public function createUserSession($user) {
			$_SESSION['user_id'] = $user->id;
			$_SESSION['user_email'] = $user->email;
			$_SESSION['user_name'] = $user->name;
			redirect('pages');
		}

		public function logout() {
			unset($_SESSION['user_id']);
			unset($_SESSION['user_email']);
			unset($_SESSION['user_name']);
			session_destroy();

			redirect('users/signin');
		}
	}
?>