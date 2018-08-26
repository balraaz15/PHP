<?php
	class Pages extends Controller {
		public function __construct() {

		}

		public function index() {
			$data = [
				'title' => 'Home Page',
				'description' => 'A simple social networking site build on PHP usig MVC design pattern.'
			];
			$this->view('pages/index', $data);
		}

		public function about() {
			$data = [
				'title' => 'About Us',
				'description' => 'App to share posts with other users.'
			];
			$this->view('pages/about', $data);
		}
	}
?>