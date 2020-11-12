<?php 
	include 'includes/header.php';
?>
<?php 
	$login = Session::get("custlogin");
	if ($login == false) {
		header("Location: login.php");
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
						<div class="breadcrumb"> &nbsp;<a href="index.php">Home&nbsp;</a> » &nbsp;<a href="my_account.php">My Account&nbsp;</a> </div>
						<div class="section-title">
							<h3><span>Manage Your Account</span></h3>
						</div>
						<div class="category-info">
							<p>Welcome! <?= $result['full_name'] ?>. Here you can edit your account info, change password, see order history, manage orders, check order status etc.
                            </p>
						</div>
					</div>
                    <!-- Page info end -->
                    <div class="information_content">
                        <h3>Account Details</h3>
                        <div class="content inner">
							<div class="table-responsive">
								<table class="table table-hover table-bordered table-sm">
									<tbody>
										<tr class="space-row">
											<th>Full Name:</th>
											<td id="fullname-val"><?= $result['full_name'] ?></td>
										</tr>
										<tr class="space-row">
											<th>Username:</th>
											<td id="username-val"><?= $result['username'] ?></td>
										</tr>
										<tr class="space-row">
											<th>Email Address:</th>
											<td id="email-val"><?= $result['email_address'] ?></td>
										</tr>
										<tr class="space-row">
											<th>Phone Number:</th>
											<td id="phone-val"><?= $result['phone'] ?></td>
										</tr>
										<tr class="space-row">
											<th>Billing Address:</th>
											<td id="address-val"><?= $result['billing_address'] ?></td>
										</tr>
										<tr class="space-row">
											<th>Postcode / ZIP:</th>
											<td id="account-number-val"><?= $result['postcode'] ?></td>
										</tr>
										<tr class="space-row">
											<th>Special Notes:</th>
											<td id="account-name-val"><?= $result['profile_bio'] ?></td>
										</tr>
									</tbody>
								</table>
							</div>
                        </div>
                        <h3>My Requests</h3>
                        <div class="content inner">
							<div class="table table-sm table-hover table-bordered">
                                <table class="mb-0 table">
                                    <thead style="background-color: antiquewhite;">
                                            <tr>
                                                <th>SL.</th>
                                                <th>Request Date</th>
                                                <th>Requested By</th>
                                                <th>Design Image</th>
                                                <th>Design Type</th>
                                                <th>Design For</th>
                                                <th>Phone</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											$cmrId = Session::get("cmrId");
											$getRequest = $cmr->getRequests($cmrId);
											if ($getRequest) {
												$i = 0;
												while ($result = $getRequest->fetch_assoc()) {
													$i++;
										?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $fm->formatDate($result['req_date']); ?></td>
                                                <td><?= $result['req_name']; ?></td>
                                                <td><img src="<?= $result['req_image']; ?>" alt="" width="60px"></td>
                                                <td><?= $result['req_type']; ?></td>
                                                <td><?= $result['req_whoom']; ?></td>
                                                <td><?= $result['req_phone']; ?></td>
                                                <td><?= $result['req_details']; ?></td>
											</tr>
										<?php } } ?>
                                        </tbody>
								</table>
                            </div>
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


<?php include 'includes/footer.php' ?>
