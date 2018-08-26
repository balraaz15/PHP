<?php
	/*
	 * Base Controller
	 * Load models and views
	 */

	class Controller {
		// Load model
		public function model($model) {
			// Check if the model exists
			if(file_exists('../app/models/'.$model.'.php')) {
				// Require the model if exists
				require_once '../app/models/'.$model.'.php';
			} else {
				die('Model "'.$model.'" Not Found');
			}

			// Instantiate the model
			return new $model;
		}

		// Load view
		public function view($view, $data=[]) {
			// Check if the view exists
			if(file_exists('../app/views/'.$view.'.php')) {
				// Require view if exists
				require_once '../app/views/'.$view.'.php';
			} else {
				die('View "'.$view.'" does not exist.');
			}
		}
	}
?>