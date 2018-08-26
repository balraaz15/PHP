<?php
	$title = $data['title'];
	require APPROOT . '/views/inc/header.php';
?>
	<h1>About Us</h1>
	<p><?php echo $data['description']; ?></p>
	<p>Version: <strong><?php echo APPVERSION; ?></strong></p>

<?php require APPROOT . '/views/inc/footer.php'; ?>