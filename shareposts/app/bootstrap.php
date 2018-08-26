<?php
	// Include config file
	require_once 'config/config.php';
	// load helpers
	require_once 'helpers/redirect.php';
	require_once 'helpers/session-helper.php';

	// Autoload core libraries
	spl_autoload_register(function($className){
		require_once 'libraries/'.$className.'.php';
	});
?>