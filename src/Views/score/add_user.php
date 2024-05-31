<?php include(LAYOUTS . 'head.php'); ?>

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
                        <p class="text-primary m-0 fw-bold">Add User</p>
                    </div>
                    <div class="card-body">

                        <form action="/save_user" method="post" class="d-flex gap-3">
                            <div>
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control" id="username" name="username" type="text">
                            </div>
                            <div>
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="text">
                            </div>

                            <div>
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" id="password" name="password" type="password">
                            </div>

                            <div>
                                <label class="form-label" for="password">Password Confirmation</label>
                                <input class="form-control" name="password_confirmation" type="password">
                            </div>

                            <label class="form-label" for="is_active">Active <input class="form-check" id="is_active"
                                                                                    type="radio" value="1"
                                                                                    name="is_active"></label>

                            <label class="form-label" for="not_active">Not Active <input class="form-check"
                                                                                         id="not_active" type="radio"
                                                                                         value="0" name="is_active"
                                                                                         checked></label>


                            <button class="btn btn-info text-white">Save User</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include(LAYOUTS . 'foot.php'); ?>
