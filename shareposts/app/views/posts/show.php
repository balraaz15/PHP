<?php
	$title = $data['post']->title;
	require APPROOT . '/views/inc/header.php';
?>
	<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light">
		<i class="fa fa-backward"></i> Back
	</a>
	<div class="card card-body bg-white mt-3 shadow rounded">
		<h1><?php echo $data['post']->title; ?></h1>
		<div class="bg-secondary text-white p-2 mb-3">
			Written by: <strong><?php echo $data['user']->name; ?></strong> on <?php echo $data['post']->created_at; ?>
		</div>
		<p><?php echo $data['post']->body; ?></p>

		<?php if($data['post']->user_id == $_SESSION['user_id']): ?>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">
					Edit
				</a>
				</div>
				<div class="col-md-6">
					<form class="pull-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST">
						<input type="submit" name="delete" value="Delete" class="btn btn-danger">
					</form>
				</div>
			</div>
		<?php endif; ?>
	</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>