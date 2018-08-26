<?php
	$title = $data['title'];
	require APPROOT . '/views/inc/header.php';
?>

	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card card-body bg-white mt-3 shadow rounded">
				<?php flash('register_success'); ?>
				<?php flash('no_user'); ?>
				<h2>Login</h2>
				<p class="text-muted">Please fill out valid credentials to sign in.</p>
				<form action="<?php echo URLROOT; ?>/users/signin" method="POST">
					<div class="form-group">
						<label for="email">Email<sup>*</sup> : </label>
						<input type="email" name="email" id="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
						<span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
					</div>

					<div class="form-group">
						<label for="password">Password<sup>*</sup> : </label>
						<input type="password" name="password" id="password" class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
						<span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
					</div>

					<div class="row">
						<div class="col">
							<input type="submit" name="login" value="Sign In" class="btn btn-success btn-block">
						</div>
						<div class="col">
							<a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block">Not a member? Register</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>