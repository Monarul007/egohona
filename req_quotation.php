<?php 
	include 'includes/header.php';
?>
<?php 
	$login = Session::get("custlogin");
	if ($login == false) {
		echo "<script>window.location = 'login.php';</script>";
	}
?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $cmrId = Session::get("cmrId");
        $insertReq = $cmr->CustomerRequest($cmrId, $_POST, $_FILES);
    }
?>

	<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
		<div class="row">
				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">ACCOUNT</h2>
						<?php 
						$id = Session::get("cmrId");
						$getData = $cmr->getCustomerData($id);
						if ($getData) {
							while ($result = $getData->fetch_assoc()) {
					?>
                        <div class="profile-card">
                            <div class="left">
                                <div class="avatar">
                                    <img src="<?= $result['profile_img'] ?>" alt="">
                                </div>
                                <div class="cust-name">
                                    <h4><?= $result['full_name'] ?></h4>
                                    <span><?= $result['city_town'] ?> - <?= $result['postcode'] ?></span>
                                </div>
                                <div class="cust-info">
                                    <span class="small"><?= $result['profile_bio'] ?></span>
                                </div>
                                <div class="buttons">
                                    <a href="" class="flw">Edit Account</a>
                                    <a href="index.php" class="msg">Go to shop</a>
                                </div>
                            </div>
                        </div>
						<ul class="category-menu">
							<li><a href="my_account.php" class="active">My Account</a></li>
							<li><a href="edit_account.php">Edit Account</a>
							<li><a href="order_history.php">Order History</a></li>
							<li><a href="change_pass.php">Change Password</a></li>
							<li><a href="log_out.php">Logout</a></li>
							<li><a href="req_quotation.php">Request Custom Design</a></li>
							<li><a href="delete_account.html">Delete Account</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<!-- Page info -->
					<div class="page-top-info">
						<div class="breadcrumb"> &nbsp;<a href="index.php">Home&nbsp;</a> » &nbsp;<a href="req_quotation.php">Request Custom Design&nbsp;</a> </div>
						<div class="section-title">
							<h3><span>Request Custom Design</span></h3>
						</div>
						<div class="category-info">
							<p>Welcome! <?= $result['full_name'] ?>. Here you can edit your account info, change password, see order history, manage orders, check order status etc.
                            </p>
						</div>
					</div>
                    <!-- Page info end -->
                    <div class="information_content">
                        <h3>Request a custom design for jewelry</h3>
                        <div class="content inner">
                        <?php 
                            if (isset($insertReq)) {
                                echo $insertReq;
                            }
                        ?>
						<form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-row">
								<div class="form-holder">
									<input type="text" placeholder="Name..." class="form-control" id="name" name="name">
								</div>
								<div class="form-holder">
									<input type="email" placeholder="Email Address..." class="form-control" id="email" name="email">
								</div>
                            </div>
                            <div class="form-row">
								<div class="form-holder">
									<label for="address">Contact Number</label>
									<input type="text" placeholder="Enter Contact Number" class="form-control" id="phone" name="ContactNumber">
								</div>
								<div class="form-holder">
                                    <label for="DesignImage">Upload images of the jewellery you'd like to repurpose.</label>
									<input type="file" name="image">
								</div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
									<label for="address">Address</label>
									<input type="text" name="req_address" placeholder="Enter your address">
								</div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder form-holder-2">
                                    <label for="details">Any other info you'd like to include?</label>
                                    <textarea name="details" placeholder="If you have any special instruction, query or sayings you can describe here..." cols="30" rows="5"></textarea>
                                </div>
                                <div class="form-holder form-holder-2">
                                    <button type="submit" name="submit" class="site-btn" style="float: right;margin-top: 30px;">Submit Request</a>
							    </div>
                            </div>
						</form>
                        </div>
					</div>
					<?php } } ?>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact section end -->


	<!-- Related product section -->
	<section class="related-product-section spad">
		<div class="container">
			<div class="section-title">
				<h2><span>YOU MAY ALSO LIKE</span></h2>
			</div>
			<div class="row display">
				<div class="col-lg-3 col-sm-6 col-6">
					<div class="product-item">
						<div class="pi-pic">
							<a href=""><img src="../img/product/5.jpg" alt=""></a>
						</div>
						<div class="pi-text">
							<a href=""><p class="pi-title">Flamboyant Pink Top </p></a>
							<p class="pi-desc">Flamboyant Pink Top lorem ipsum dolor sit amet and some text here to describe product....</p>
							<h6>$35,00 <span class="old-price"> $55,00</span></h6>
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-6">
					<div class="product-item">
						<div class="pi-pic">
							<a href=""><img src="../img/product/5.jpg" alt=""></a>
						</div>
						<div class="pi-text">
							<a href=""><p class="pi-title">Flamboyant Pink Top </p></a>
							<p class="pi-desc">Flamboyant Pink Top lorem ipsum dolor sit amet and some text here to describe product....</p>
							<h6>$35,00 <span class="old-price"> $55,00</span></h6>
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-6">
					<div class="product-item">
						<div class="pi-pic">
							<a href=""><img src="../img/product/5.jpg" alt=""></a>
						</div>
						<div class="pi-text">
							<a href=""><p class="pi-title">Flamboyant Pink Top </p></a>
							<p class="pi-desc">Flamboyant Pink Top lorem ipsum dolor sit amet and some text here to describe product....</p>
							<h6>$35,00 <span class="old-price"> $55,00</span></h6>
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6 col-6">
					<div class="product-item">
						<div class="pi-pic">
							<a href=""><img src="../img/product/5.jpg" alt=""></a>
						</div>
						<div class="pi-text">
							<a href=""><p class="pi-title">Flamboyant Pink Top </p></a>
							<p class="pi-desc">Flamboyant Pink Top lorem ipsum dolor sit amet and some text here to describe product....</p>
							<h6>$35,00 <span class="old-price"> $55,00</span></h6>
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Related product section end -->


<?php 
	include 'includes/footer.php';
?>
