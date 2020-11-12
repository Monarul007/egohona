<?php include '../classes/Adminlogin.php'; ?>
<?php 
	$al = new Adminlogin();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$adminEmail = $_POST['adminEmail'];
		$adminPass = md5($_POST['adminPass']);

		$loginChk = $al->adminLogin($adminEmail, $adminPass);
	}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>MSHOP - Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="./main.css" rel="stylesheet">
    <link href="css/stylesheet.css" rel="stylesheet">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
</head>
<body>
            <div class="app-container app-theme-white">
                <div class="app-main">
                    <div class="app-main__inner">
                        <div class="site-logo">
                            <a href="login.php"><img src="assets/images/logo.png" alt="" width="250px"></a>
                        </div>
                        <div class="admin-login main-card mb-3 card">
                            <div class="card-body">
                                <h5>WELCOME ADMIN</h5>
                                <p>LOGIN TO DASHBOARD ACCOUNT</p>
                                <span style="color: red;">
                                    <?php 
                                        if (isset($loginChk)) {
                                            echo $loginChk;
                                        }
                                    ?>
			                    </span>
                                <form action="" class="needs-validation" novalidate="" method=post>
                                    <label for="validationUsername">E-mail*</label>
                                    <div class="input-group mb-3">
                                        <input type="email" name="adminEmail" id="validationUsername" class="form-control" placeholder="Email" required="">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">Please enter a valid email address.</div>                                    
                                    </div>
                                    <label for="validationPassword">Password*</label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="adminPass" id="validationPassword" class="form-control" placeholder="Password" required="">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">Please enter your password</div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Sign In Now</button>
                                </form>
                                <p style="margin: 15px 0;">- OR -</p>
                                <p class="mb-1">
                                    <a href="forgot-password.html">I forgot my password</a>
                                </p>
                                <p class="mb-0">
                                    <a href="register.html" class="text-center">Register a new membership</a>
                                </p>
                                <script>
                                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                                    (function() {
                                        'use strict';
                                        window.addEventListener('load', function() {
                                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                            var forms = document.getElementsByClassName('needs-validation');
                                            // Loop over them and prevent submission
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
</body>
</html>