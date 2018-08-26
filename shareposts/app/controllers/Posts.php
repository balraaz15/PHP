<?php
	class Posts extends Controller {
		public function __construct() {
			$this->postModel = $this->model('Post');
			$this->userModel = $this->model('User');
		}

		public function index(){
			// Get posts
			$posts = $this->postModel->getPosts();

			$data = [
				'title' => 'Posts',
				'posts' => $posts
			];
			$this->view('posts/index', $data);
		}

		public function add() {
			if(!isLoggedIn()) {
				flash('not_logged_in_to_add_post', 'You must be a logged in user to add a new post.', 'info');
				redirect('posts');
			} else {
				if($_SERVER['REQUEST_METHOD'] == 'POST') {
					// Sanitize POST
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
					$data = [
						'page_title' => 'Add New Post',
						'title' => trim($_POST['title']),
						'body' => trim($_POST['body']),
						'user_id' => $_SESSION['user_id'],
						'title_error' => '',
						'body_error' => ''
					];

					// Validate title
					if(empty($data['title'])) {
						$data['title_error'] = 'Please enter title.';
					}
					// Validate body
					if(empty($data['body'])) {
						$data['body_error'] = 'Please enter post body.';
					}

					// Check if no errors
					if(empty($data['title_error']) && empty($data['body_error'])) {
						// Validated
						if($this->postModel->addPost($data)) {
							flash('post_msg', 'New Post Added!');
							redirect('posts');
						} else {
							die('Something went wrong');
						}

					} else {
						// Load view with errors
						$this->view('posts/add', $data);
					}

				} else {
					$data = [
						'page_title' => 'Add New Post',
						'title' => '',
						'body' => ''
					];
					$this->view('posts/add', $data);
				}
			}
		}

		public function edit($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize POST
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'page_title' => 'Edit Post',
					'id' => $id,
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],
					'title_error' => '',
					'body_error' => ''
				];

				// Validate title
				if(empty($data['title'])) {
					$data['title_error'] = 'Please enter title.';
				}
				// Validate body
				if(empty($data['body'])) {
					$data['body_error'] = 'Please enter post body.';
				}

				// Check if no errors
				if(empty($data['title_error']) && empty($data['body_error'])) {
					// Validated
					if($this->postModel->editPost($data)) {
						flash('post_msg', 'Post Updated!');
						redirect('posts');
					} else {
						die('Something went wrong');
					}

				} else {
					// Load view with errors
					$this->view('posts/edit', $data);
				}

			} else {
				// Fetch the post
				$post = $this->postModel->getSinglePost($id);

				// Check for owner
				if($post->user_id != $_SESSION['user_id']) {
					redirect('posts');
				}

				$data = [
					'page_title' => 'Edit Post',
					'id' => $id,
					'title' => $post->title,
					'body' => $post->body
				];
				$this->view('posts/edit', $data);
			}
		}

		public function show($id) {
			$post = $this->postModel->getSinglePost($id);
			$user = $this->userModel->findUserByAttr('id', $post->user_id);
			$data = [
				'post' => $post,
				'user' => $user
			];
			$this->view('posts/show', $data);
		}

		public function delete($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				if($this->postModel->deletePost($id)) {
					flash('post_msg', 'Post Removed!');
					redirect('posts');
				} else {
					die('Something went wrong.');
				}
			} else {
				redirect('posts');
			}
		}
	}
?>