<?php
	class Post {
		private $db;

		public function __construct() {
			$this->db = new Database('posts');
		}

		public function getPosts() {
			$this->db->query('SELECT *,
								posts.id as postId,
								users.id as userId,
								posts.created_at as postCreated,
								users.created_at as userCreated
								FROM posts
								INNER JOIN users
								ON posts.user_id = users.id
								ORDER BY posts.created_at DESC');
			$results = $this->db->resultSet();
			return $results;
		}

		public function getSinglePost($id) {
			return $this->db->find('id', $id);
		}

		public function addPost($data) {
			$data = array_slice($data, 1, 3);
			$insert = $this->db->save($data, 'id');

			if($insert) {
				return true;
			} else {
				return false;
			}
		}

		public function editPost($data) {
			$data = array_slice($data, 1, 3);
			$insert = $this->db->save($data, 'id');

			if($insert) {
				return true;
			} else {
				return false;
			}
		}

		public function deletePost($id) {
			$delete = $this->db->delete('id', $id);

			if($delete) {
				return true;
			} else {
				return false;
			}
		}
	}
?>