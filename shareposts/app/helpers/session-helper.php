<?php
	session_start();

	// Flash messages helper
	// EXAMPLE - flash('register_success', 'You are now registered.');
	// DISPLAY IN VIEW - echo flash('register_success');
	function flash($name='', $message='', $classStr="success") {
		$class = 'alert alert-'.$classStr.' text-center alert-dismissible fade show';

		if(!empty($message) && empty($_SESSION[$name])) {
			$_SESSION[$name] = $message;
			$_SESSION[$name.'_class'] = $class;
		} elseif(empty($message) && !empty($_SESSION[$name])) {
			$class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
			echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
				  </div>';
			unset($_SESSION[$name]);
			unset($_SESSION[$name.'_class']);
		}
	}

	function isLoggedIn() {
		if(isset($_SESSION['user_id'])) {
			return true;
		} else {
			return false;
		}
	}
?>