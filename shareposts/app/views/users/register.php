<?php
	$title = $data['title'];
	require APPROOT . '/views/inc/header.php';
?>

	<div class="row">
		<div class="col-md-6 mx-auto">
			<div class="card card-body bg-white mt-3 shadow rounded">
				<h2>Create An Account</h2>
				<p class="text-muted">Please fill out all the fields ro register.</p>
				<form action="<?php echo URLROOT; ?>/users/register" method="POST">
					<div class="form-group">
						<label for="name">Name<sup>*</sup> : </label>
						<input type="text" name="name" id="name" class="form-control <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
						<span class="invalid-feedback"><?php echo $data['name_error']; ?></span>
					</div>

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

					<div class="form-group">
						<label for="confirm_password">Confirm Password<sup>*</sup> : </label>
						<input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
						<span class="invalid-feedback"><?php echo $data['confirm_password_error']; ?></span>
					</div>

					<div class="row">
						<div class="col">
							<input type="submit" name="register" value="Register" class="btn btn-success btn-block">
						</div>
						<div class="col">
							<a href="<?php echo URLROOT; ?>/users/signin" class="btn btn-light btn-block">Have an account? Sign in</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>