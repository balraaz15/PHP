<?php
	require '../functions/loadTemplate.php';

	if(isset($_GET['page'])) {
		require '../pages/'.$_GET['page'].'.php';
	} else {
		require '../pages/home.php';
	}

	$templateVars = [
		'title' => $title,
		'content' => $content
	];

	echo loadTemplate('../views/layout.php', $templateVars);
?>