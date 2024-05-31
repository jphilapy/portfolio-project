<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>About Us - Brand</title>
    <base href="<?php echo $_ENV['APP_URL']; ?>">

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Montserrat.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top bg-body clean-navbar navbar-light">
    <div class="container"><a class="navbar-brand logo" href="#">Brand</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="">Dashboard</a></li>

                <li class="nav-item"><a class="nav-link" href="users">Users</a></li>
<!--                <li class="nav-item"><a class="nav-link" href="pricing.html">Pricing</a></li>-->
<!--                <li class="nav-item"><a class="nav-link active" href="about-us.html">About Us</a></li>-->
				<?php if(!isset($_SESSION['loggedin_user'])): ?>
                    <li class="nav-item"><a class="nav-link active" href="login">Login</a></li>
                    <li class="nav-item"><a class="nav-link active" href="register">Register</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link active" href="logout">Logout</a></li>
				<?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
