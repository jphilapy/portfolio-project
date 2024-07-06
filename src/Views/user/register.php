<?php include(LAYOUTS. 'head.php'); ?>


<main class="page login-page">
	<section class="clean-block clean-form dark">
		<div class="container">
			<div class="block-heading">
				<h2 class="text-info">Register</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
			</div>
			<form method="post">
				<?php if (!empty($errors)): ?>
                    <div class="errors mb-3 pb-0 alert alert-danger">
                        <ul>
							<?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
							<?php endforeach; ?>
                        </ul>
                    </div>
				<?php endif; ?>
				<div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control item" type="email" name="username" id="email" data-bs-theme="light"></div>
				<div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" type="password" name="password" id="password" data-bs-theme="light"></div>
				<div class="mb-3"><label class="form-label" for="password">Confirm Password</label><input class="form-control" type="password" name="confirm_password" id="confirm_password" data-bs-theme="light"></div>
				<div class="mb-3">
					<div class="form-check"><input class="form-check-input" type="checkbox" id="checkbox" data-bs-theme="light"><label class="form-check-label" for="checkbox">Remember me</label></div>
				</div>
				<div class="mb-3 d-flex justify-content-between">
					<button class="btn btn-primary" type="submit">Register</button>  <a href="login_google" class="btn btn-primary">Register with Google</a>
				</div>
			</form>
		</div>
	</section>
</main>



<?php include(LAYOUTS. 'foot.php'); ?>

