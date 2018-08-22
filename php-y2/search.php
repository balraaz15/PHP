<?php
	class Book {
		public $title;
		public $author;
		public $isbn;
		public $type = 'paperback';
		public $chapters = [];

		public function searchChapters($word) {
			$found = [];
			foreach($this->chapters as $c) {
				if(strpos($c, $word)) {
					$found[] = $c;
				}
			}
			return $found;
		}
	}

	$book2 = new Book();
	$book2->title = 'Treasure Island';
	$book2->author = 'Robert Louis Stevenson';
	$book2->isbn = '1505297400';
	$book2->type = 'hardback';

	$book2->chapters[0] = 'Introduction';
	$book2->chapters[1] = 'The Old Sea-dog at the Admiral Benbow';
	$book2->chapters[2] = 'Black Dog Appears and Disappears';
	$book2->chapters[3] = 'The Black Spot';
	$book2->chapters[4] = 'The Sea-chest';
	$book2->chapters[5] = 'The Last of the Blind Man';
	$book2->chapters[6] = 'The Captain\'s Papers';

	$results = $book2->searchChapters('The');

	foreach ($results as $result) {
		echo '<p>' . $result . '</p>';
	}
?>