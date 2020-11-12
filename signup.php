<?php include 'includes/header.php'; ?>

	<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
			<div class="row">
			<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
						<ul class="category-menu">
							<li><a href="category.php?cat_id=13" class="active">Rings</a>
								<ul class="sub-menu">
									<?php 
										$getRingsCat = $cat->getRings();
										if ($getRingsCat) {
											while ($result = $getRingsCat->fetch_assoc()) {
									?>
										<li><a href="category.php?cat_id=<?= $result['id'] ?>"><?= $result['cat_name'] ?></a></li>
									<?php } } ?>
								</ul>
							</li>
							<li><a href="category.php?cat_id=18" class="active">Earrings</a>
								<ul class="sub-menu">
									<?php 
										$getEarringsCat = $cat->getEarrings();
										if ($getEarringsCat) {
											while ($result = $getEarringsCat->fetch_assoc()) {
									?>
										<li><a href="category.php?cat_id=<?= $result['id'] ?>"><?= $result['cat_name'] ?></a></li>
									<?php } } ?>
								</ul>
							</li>
							<?php 
								$getParentCats = $cat->getParentCat();
								if ($getParentCats) {
									while ($result = $getParentCats->fetch_assoc()) {
								?>
							<li><a href="category.php?cat_id=<?= $result['id']; ?>"><?= $result['cat_name']; ?></a></li>
							<?php } } ?> 
						</ul>
					</div>
					<div class="filter-widget">
						<h2 class="fw-title">Latest Products</h2>
						<ul class="category-menu">
							<li>
							<?php 
								$getRelatedPd = $pd->getFeaturedProduct();
								if ($getRelatedPd) {
									while ($result = $getRelatedPd->fetch_assoc()) {
							?>
								<div class="lp-item">
									<div class="lp-thumb">
										<a href=""><img src="admin/<?= $result['product_img']; ?>" alt=""></a> 
									</div>
								<div class="lp-content">
									<a href="" class="title"><?= $result['product_title']; ?></a>
									<span><?= $result['new_price']; ?> <span class="old-price"> <?= $result['regular_price']; ?></span>
									<a href="product.php?id=<?= $result['id']; ?>" class="readmore">Read More</a>
								</div>
								</div>
							<?php } } ?>
							</li>
						</ul>
					</div>
				</div>
				<?php 
						$cmr = new Customer();
						if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
							$customerReg = $cmr->customerRegistration($_POST, $_FILES);
						}
					?>
				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<!-- Page info -->
					<div class="page-top-info">
						<div class="breadcrumb"> &nbsp;<a href="index.php">Home&nbsp;</a> » &nbsp;<a href="signup.php">Create New Account&nbsp;</a> </div>
						<div class="section-title">
							<h3><span>Create New Account</span></h3>
						</div>
						<div class="category-info">
							<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ulla. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						</div>
					</div>
					<!-- Page info end -->
					<?php 
						if (isset($customerReg)) {
							echo $customerReg;
						}
					?>
                    <div class="wizard-v5-content">
				<div class="wizard-form">
					<form class="form-register" id="form-register" action="" method="POST" enctype="multipart/form-data">
						<div id="form-total">
							<!-- SECTION 1 -->
							<h2>
								<span class="step-icon"><i class="fa fa-check"></i></span>
								<span class="step-text">Account Information</span>
							</h2>
							<section>
								<div class="inner">
									<div class="form-row">
										<div class="form-holder">
											<label class="" for="first_name">First Name</label>
                                            <input type="text" placeholder="ex: Ranzu" class="form-control" id="first_name" name="first_name">
                                            
										</div>
										<div class="form-holder">
											<label for="last_name">Last Name</label>
											<input type="text" placeholder="ex: Alam" class="form-control" id="last_name" name="last_name">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label for="phone">Phone Number</label>
											<input type="number" placeholder="Enter Phone Number" class="form-control" id="phone" name="phone">
										</div>
										<div class="form-holder">
											<label for="email">Email Address</label>
											<input type="email" name="email" class="email input-step-2-1" id="email" placeholder="ex: example@email.com" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label for="phone">Username</label>
											<input type="text" placeholder="enter username" class="form-control" id="username" name="username">
										</div>
										<div class="form-holder">
											<label for="password">Password</label>
											<input type="password" name="password" class="form-control" id="password" placeholder="enter password">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label for="product_image" class="">Upload Profile Image</label>
											<input name="image" id="product_image" type="file" class="form-control-file">
										</div>
									</div>
								</div>
							</section>
							<!-- SECTION 2 -->
							<h2>
								<span class="step-icon"><i class="fa fa-check"></i></span>
								<span class="step-text">Billing Information</span>
							</h2>
							<section>
								<div class="inner">
									<div class="form-row">
										<div class="form-holder form-holder-2">
											<label for="address">Billing Address</label>
											<input type="text" placeholder="622 Dixie Path, South Tobinchester, UT 98336" class="form-control" id="address" name="address">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label for="city">City / Town</label>
											<input type="text" placeholder="ex: Dhaka" class="form-control" id="city" name="city">
										</div>
										<div class="form-holder">
											<label for="code">Zip Code</label>
											<input type="number" placeholder="ex: 1207" class="form-control" id="account_number" name="code">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder form-holder-2">
											<label for="notes" class="form-label">Special Notes</label>
											<textarea type="text" name="special_note" id="account_name" placeholder="Notes about your order, e.g. special notes for delivery." class="valid" aria-invalid="false"></textarea>
										</div>
									</div>
								</div>
							</section>
							<!-- SECTION 3 -->
							<h2>
								<span class="step-icon"><i class="fa fa-check"></i></span>
								<span class="step-text">Confirm Details</span>
							</h2>
							<section>
								<div class="inner">
									<h3>Comfirm Details</h3>
									<div class="table-responsive" style="padding: 0 20px;">
										<table class="table table-hover table-bordered table-sm">
											<tbody>
												<tr class="space-row">
													<th>Username:</th>
													<td id="username-val" name="username"> </td>
												</tr>
												<tr class="space-row">
													<th>Full Name:</th>
													<td id="fullname-val" name="fullname"> </td>
												</tr>
												<tr class="space-row">
													<th>Email Address:</th>
													<td id="email-val" name="email"></td>
												</tr>
												<tr class="space-row">
													<th>Phone Number:</th>
													<td id="phone-val" name="phone"></td>
												</tr>
												<tr class="space-row">
													<th>Billing Address:</th>
													<td id="address-val" name="billing"></td>
												</tr>
												<tr class="space-row">
													<th>City / Town:</th>
													<td id="city-val" name="city"></td>
												</tr>
												<tr class="space-row">
													<th>Postcode / ZIP:</th>
													<td id="account-number-val" name="postcode"></td>
												</tr>
												<tr class="space-row">
													<th>Special Notes:</th>
													<td id="account-name-val" name="bio"></td>
												</tr>
											</tbody>
										</table>
										<p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
									</div>
									<div class="rright">
                                        <input value="Create Account" type="submit" name="submit" class="site-btn">
                                    </div>
								</div>
							</section>
						</div>
					</form>
				</div>
			</div>	
				</div>
			</div>
		</div>
	</section>
	<!-- Contact section end -->


	<!-- Related product section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2><span>RELATED PRODUCTS</span></h2>
			</div>
			<div class="product-slider owl-carousel" style="display: inline-block;">
				<?php 
					$getRelatedPd = $pd->getAllProduct();
					if ($getRelatedPd) {
						while ($result = $getRelatedPd->fetch_assoc()) {
				?>
				<div class="product-item">
					<div class="pi-pic">
						<a href=""><img src="admin/<?= $result['product_img']; ?>" alt=""></a>
					</div>
					<div class="pi-text">
						<a href=""><p class="pi-title"><?= $result['product_title']; ?></p></a>
						<p class="pi-desc"><?= substr($result['product_desc'], 0, 80) ?></p>
						<h6><?= $result['new_price'] ?> <span class="old-price"> <?= $result['regular_price'] ?></span></h6>
						<div class="pi-links">
							<a href="product.php?id=<?= $result['id'] ?>" class="add-card"><i class="flaticon-bag"></i><span>VIEW DETAILS</span></a>
						</div>
					</div>
				</div>	
			<?php } }?>
			</div>
		</div>
	</section>
    <!-- Related product section end -->

<?php include 'includes/footer.php'; ?>