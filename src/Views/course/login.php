<?php include(LAYOUTS. 'head.php'); ?>


<main class="page login-page">
	<section class="clean-block clean-form dark">
		<div class="container">
			<div class="block-heading">
				<h2 class="text-info">Log In</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
			</div>
			<form>
				<div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control item" type="email" id="email" data-bs-theme="light"></div>
				<div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" type="password" id="password" data-bs-theme="light"></div>
				<div class="mb-3">
					<div class="form-check"><input class="form-check-input" type="checkbox" id="checkbox" data-bs-theme="light"><label class="form-check-label" for="checkbox">Remember me</label></div>
				</div><button class="btn btn-primary" type="submit">Log In</button>
			</form>
		</div>
	</section>
</main>



<?php include(LAYOUTS. 'foot.php'); ?>

