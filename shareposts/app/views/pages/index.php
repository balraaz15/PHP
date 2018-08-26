<?php
	$title = $data['title'];
	require APPROOT . '/views/inc/header.php';
?>
	<div class="jumbotron jumbotron-fluid text-center">
	  <div class="container">
	    <h1 class="display-4"><?php echo SITENAME; ?></h1>
	    <p class="lead"><?php echo $data['description']; ?></p>
	    <hr class="my-4">
	    <p>An open source project by Balraaz.</p>
  		<a class="btn btn-primary" href="<?php echo URLROOT.'/posts' ?>" role="button">View Posts</a>
	  </div>
	</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>