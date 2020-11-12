<?php include 'includes/header.php'; ?>
<?php 
	$login = Session::get("custlogin");
	if ($login == true) {
	    echo "<script>window.open('cart.php','_SELF')</script>";
	}
?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $CustomerLogin = $cmr->customerLogin($_POST);
    }
?>

    <link href="admin/css/stylesheet.css" rel="stylesheet">
    <link href="admin/main.css" rel="stylesheet">

            <div class="app-container app-theme-white">
                <div class="app-main">
                    <div class="app-main__inner">
                        <div class="admin-login main-card mb-3 card">
                            <div class="card-body">
                                <h5>WELCOME!</h5>
                                <p>LOGIN TO USER ACCOUNT</p>
                                <span style="color: red;">
                                <?php 
                                    if (isset($CustomerLogin)) {
                                        echo $CustomerLogin;
                                    }
                                ?>
			                    </span>
                                <form action="" class="needs-validation" novalidate="" method="POST">
                                    <label for="validationUsername">E-mail*</label>
                                    <div class="input-group mb-3">
                                        <input type="email" name="email" id="validationUsername" class="form-control" placeholder="Email" required="">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">Please enter a valid email address.</div>                                    
                                    </div>
                                    <label for="validationPassword">Password*</label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="pass" id="validationPassword" class="form-control" placeholder="Password" required="">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">Please enter your password</div>
                                    </div>
                                    <button name="submit" class="btn btn-primary" type="submit">Sign In Now</button>
                                </form>
                                <p style="margin: 15px 0;">- OR -</p>
                                <p class="mb-1">
                                    <a href="forgot-password.html">I forgot my password</a>
                                </p>
                                <p class="mb-0">
                                    <a href="signup.php" class="text-center">Register a new account</a>
                                </p>
                                <script>
                                    (function() {
                                        'use strict';
                                        window.addEventListener('load', function() {
                                            var forms = document.getElementsByClassName('needs-validation');
                                            var validation = Array.prototype.filter.call(forms, function(form) {
                                                form.addEventListener('submit', function(event) {
                                                    if (form.checkValidity() === false) {
                                                        event.preventDefault();
                                                        event.stopPropagation();
                                                    }
                                                    form.classList.add('was-validated');
                                                }, false);
                                            });
                                        }, false);
                                    })();
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include 'includes/footer.php'; ?>