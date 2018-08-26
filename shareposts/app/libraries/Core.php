<?php
	/*
	 * App Core Class
	 * Creates URL and loads controllers
	 * URL Format - /controller/method/params
	 */

	class Core {
		protected $currentController = 'Pages';
		protected $currentMethod = 'index';
		protected $params = [];

		public function __construct() {
			// print_r($this->getUrl());

			$url = $this->getUrl();

			// look in the controller for first value as a controller
			if(file_exists('../app/controllers/'.ucwords($url[0]). '.php')) {
				// If controller exists, set that to current controller
				$this->currentController = ucwords($url[0]);
				// Unset 0 index
				unset($url[0]);
			}

			// Require controller
			require_once '../app/controllers/'.$this->currentController. '.php';

			// Instantiate the controller
			$this->currentController = new $this->currentController;

			// Check for the second part of the url
			if(isset($url[1])) {
				// Look in the controller for the second value as a method.
				if(method_exists($this->currentController, $url[1])) {
					// If method exists, set that to current method
					$this->currentMethod = $url[1];
					// unset 1 index
					unset($url[1]);
				}
			}

			// Get params
			$this->params = $url ? array_values($url) : [];

			// Call a callback with the array of params
			call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
		}

		public function getUrl() {
			if(isset($_GET['url'])) {
				$url = rtrim($_GET['url'], '/'); // Remove the last forward slash from URL
				$url = filter_var($url, FILTER_SANITIZE_URL); // Making sure the url does not contain anything that it should not.
				// Converting the URL to array
				$url = explode('/', $url);
				return $url;
			}
		}
	}
?>