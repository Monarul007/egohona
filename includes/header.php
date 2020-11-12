<?php 
    include 'lib/Session.php';
    Session::init();
    include 'lib/Database.php';
    include 'helpers/Format.php';
    spl_autoload_register(function($class){
    	include_once "classes/".$class.".php";
    });

    $db = new Database();
    $fm = new Format();
    $pd = new Product();
	$bd = new Brand();
	$ct = new Cart();
    $cat = new Category();
    $sldr = new Slider();
    $cmr = new Customer();
    $bnnr = new Banner();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>eGohona | Jewelry at your door step</title>
	<meta charset="UTF-8">
	<meta name="description" content=" mshop | eCommerce Jewelry Shop">
	<meta name="keywords" content="mshop, eCommerce, creative, html, jewelry">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv='refresh'/>
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="./css/style.css"/>

</head>
<body>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="./index.php" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form action="search.php" method="get" class="header-search-form">
							<input name="search" type="text" placeholder="Search on eGohona ....">
							<button type="submiit" name="submit" value="search"><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item dropdown">
								<i class="flaticon-profile"></i>
								<?php $login = Session::get("custlogin");
									if ($login == false) { ?>
										<a href="login.php">Login</a>
								<?php } else { ?>
									<a href="" style="padding: 10px 0;" class="dropdown-toggle" id="account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
									<div class="dropdown-menu" aria-labelledby="account">
										<a href="my_account.php" class="dropdown-item">My Account</a>
										<a href="cart.php" class="dropdown-item">My Cart</a>
										<a href="order_history.php" class="dropdown-item">Order History</a>
										<a href="edit_account.php" class="dropdown-item">Edit Profile</a>
										<a href="req_quotation.php" class="dropdown-item">Submit New Design</a>
										<a href="?customerid=<?php Session::get('cmrId'); ?>" class="dropdown-item">Log Out</a>
									</div>
								<?php } ?>
							</div>
							<div class="up-item dropdown">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span>
										<?php 
											$getData = $ct->checkCartTable();
											if ($getData) {
												$qty = 0;
												while ($result = $getData->fetch_assoc()) {
													$qty = $qty + $result['product_qty'];
												}
												Session::set("qty", $qty);
												echo $qty;
											}else{
												echo "0";
											}
										?>
									</span>
								</div>
								<?php 
									if (isset($_GET['customerid'])) {
										$cmrId = Session::get("cmrId");
										$delData = $ct->delCustomerCart();
										Session::destroy();
									}
								?>
								<a href="#" style="padding: 10px 0;" class="dropdown-toggle" id="cart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shopping Cart</a>
								<div class="inner dropdown-menu dropdown-menu-right" aria-labelledby="cart">
									<div class="shopping-cart col-12 table-responsive" style="padding: 0 10px;">
									<?php 
											$getData = $ct->checkCartTable();
											if ($getData) { 
											?>
									<table class="table table-sm table-hover table-bordered">
                                        <thead style="background-color: antiquewhite;">
                                            <tr>
                                            <td class="name">Product Name</td>
                                            <td class="model">Model</td>
                                            <td class="tquantity">Qty.</td>
                                            <td class="price">Price</td>
                                            <td class="total">Total</td>
                                            </tr>
                                        </thead>
										<?php 
										$getPro = $ct->getCartProduct();
										if ($getPro) {
											$i = 0;
											$sum = 0;
											$qty = 0;
											$total = 0;
											while ($result = $getPro->fetch_assoc()) {
												$i++;
												$sub_total = $result['product_price'] * $result['product_qty'];
												$total +=$sub_total;
												$V_Total = $total + 60;
										?>
                                        <tbody>
										
                                            <tr>
                                            <td class="name"><a href="product.php?id=<?= $result['product_id'] ?>"><?= $result['product_name'] ?></a></td>
                                            <td class="model"><?= $result['product_code'] ?></td>
                                            <td class="tquantity"><?= $result['product_qty'] ?></td>
                                            <td class="price">৳ <?= $result['product_price'] ?></td>
                                            <td class="total">৳ <?= $sub_total; ?></td>
                                            </tr>
											
                                        </tbody>
										
										<?php } } ?>
                                        <tfoot>
                                            <tr>
                                            <td colspan="4" class="price"><b>Sub-Total:</b></td>
                                            <td class="total">৳ <?= $total; ?></td>
                                            </tr>
                                            <tr>
                                            <td colspan="4" class="price"><b>Flat Shipping Rate:</b></td>
                                            <td class="total">৳ 60</td>
                                            </tr>
                                            <tr>
                                            <td colspan="4" class="price"><b>Total:</b></td>
                                            <td class="total">৳ <?= $V_Total; ?></td>
                                            </tr>
											<?php 
												$sum = $sum + $total;
												$qty = $qty + $result['product_qty'];
												Session::set("qty", $qty);
												Session::set("sum", $sum);
											?>
											
                                        </tfoot>
                                        </table>
										<div class="btn-group dropup" style="float: right;margin-bottom: 20px;">
											<a href="cart.php" class="site-btn" style="color: #fff;">View Cart</a>
											<a href="checkout.php" class="site-btn" style="color: #fff; margin-left: 10px;">Checkout</a>
										</div>
										<?php } else { 
												echo "<div class='cart-empty'>
												<p>Cart Empty! Please add product to cart.</p>
												<a href='index.php' style='color:#fff; padding: 10px 20px;' class='site-btn'>Continue Shopping</a>
												</div>
												";
											} ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="#">Rings</a>
						<ul class="sub-menu">
						<?php 
							$getRingsCat = $cat->getRings();
							if ($getRingsCat) {
								while ($result = $getRingsCat->fetch_assoc()) {
						?>
							<li><a href="category.php?id=<?= $result['id'] ?>"><?= $result['cat_name'] ?></a></li>
						<?php } } ?>
						</ul>
					</li>
					<li><a href="#">Earrings</a>
						<ul class="sub-menu">
						<?php 
							$getEarringsCat = $cat->getEarrings();
							if ($getEarringsCat) {
								while ($result = $getEarringsCat->fetch_assoc()) {
						?>
							<li><a href="category.php?id=<?= $result['id'] ?>"><?= $result['cat_name'] ?></a></li>
						<?php } } ?>
						</ul>
					</li>
					<li><a href="#">Bracelets & Bangles</a>
						<ul class="sub-menu">
						<?php 
							$getBraceletsCat = $cat->getBracelts();
							if ($getBraceletsCat) {
								while ($result = $getBraceletsCat->fetch_assoc()) {
						?>
							<li><a href="category.php?id=<?= $result['id'] ?>"><?= $result['cat_name'] ?></a></li>
						<?php } } ?>
						</ul>
					</li>
					<li><a href="category.php">Shop Page
						<span class="new">New</span>
					</a></li>
					<li><a href="req_quotation.php">Submit Design</a></li>
					<li><a href="about.php">About Us</a></li>
					<li><a href="./contact.php">Contact Us</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->