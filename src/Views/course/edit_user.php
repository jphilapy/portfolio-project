<?php
/**
 * @var array $errors
 * @var array $user
 */
include(LAYOUTS . 'head.php');
?>

<main class="page">
    <section class="clean-block about-us">
        <div class="container">
            <div class="block-heading">
<!--                <h2 class="text-info">Users</h2>-->
            </div>
            <div class="container-fluid">
				<?php if(isset($errors)) { ?>
                    <div class="alert alert-warning text-danger">
                        <ul>
							<?php foreach($errors as $error) { ?>
                                <li><?php echo $error;?> </li>
							<?php } ?>
                        </ul>
                    </div>
				<?php } ?>
                <div class="card shadow">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <p class="text-primary m-0 fw-bold">Edit User</p>
                    </div>
                    <div class="card-body">
                        <form action="/update_user" method="post" class="d-flex gap-3">
                            <div>
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control" id="username" name="username" type="text" value="<?php echo $user['username']; ?>">
                            </div>
                            <div>
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="text" value="<?php echo $user['email']; ?>">
                            </div>
                            <div>
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" id="password" name="password" type="password">
                            </div>

                            <div>
                                <label class="form-label" for="password-confirmation">Password Confirmation</label>
                                <input class="form-control" id="password-confirmation" name="password_confirmation" type="password">
                            </div>


                            <?php if ($user['is_active'] === 1) {
								$value = 1;
								$label = 'Active';
							} else {
								$value = 0;
								$label = 'Not Active';
							} ?>
                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                            <div>
                                <label for="<?php echo $value; ?>" class="form-label"><?php echo $label; ?></label>
                                <input class="form-check" type="radio" id="<?php echo $value; ?>"
                                       value="<?php echo $value; ?>" <?php echo $value === 1 ? "checked" : ""; ?>
                                       name="is_active">
                            </div>

                            <button class="btn btn-info text-white">Send</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include(LAYOUTS . 'foot.php'); ?>
