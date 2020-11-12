<?php 
	include 'includes/header.php';
?>
<?php 
	$login = Session::get("custlogin");
	if ($login == false) {
		header("Location: login.php");
	}
?>
<?php 
	if (isset($_GET['customerId']) && isset($_GET['time']) && isset($_GET['price']) && isset($_GET['prodId'])) {
		$id 		= $_GET['customerId'];
		$time 		= $_GET['time'];
		$price 		= $_GET['price'];
		$prodId 	= $_GET['prodId'];
		$confirm 	= $ct->productShiftConfirm($id, $time, $price, $prodId);
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
                                    <img src="
                                    <?php
                                        if (empty ($result['profile_img'])){
                                            echo "img/customers/default_400x400.jpg";
                                        }else{
                                            echo $result['profile_img'];
                                        }
                                    ?>" alt="">
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
						<div class="breadcrumb"> &nbsp;<a href="index.php">Home&nbsp;</a> » &nbsp;<a href="order_history.php">Your Orders&nbsp;</a> </div>
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
                        <h3>Order History</h3>
                        <div class="table-responsive">
                        <table class="table table-sm table-hover table-bordered">
                            <thead style="background-color: #fff;">
                                <tr>
                                    <td class="left">SL.</td>
                                    <td class="left">Product</td>
                                    <td class="left">Quantity</td>
                                    <td class="left">Amount</td>
                                    <td class="left">Order Date</td>
                                    <td class="left">Status</td>
                                    <td class="left">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $cmrId = Session::get("cmrId");
                                $getOrder = $ct->getOrderProduct($cmrId);
                                if ($getOrder) {
                                    $i = 0;
                                    while ($result = $getOrder->fetch_assoc()) {
                                        $i++;
                            ?>
                                <tr>
                                    <td class="left"><?= $i ?></td>
                                    <td class="left"><?= $result['product_title']; ?></td>
                                    <td class="left"><?= $result['product_qty']; ?></td>
                                    <td class="left"><?= 'TK. '.$result['due_amount']; ?></td>
                                    <td class="left"><?= $fm->formatDate($result['order_date']); ?></td>
                                    <td class="left">
                                    <?php 
                                        if ($result['order_status'] == '0') {
                                            echo "Pending";
                                        } elseif ($result['order_status'] == '1') {
                                            echo "Shifted";
                                        } else {
                                            echo "OK";
                                        }
                                    ?>
                                    </td>
                                    <?php if ($result['order_status'] == '1') { ?>
                                        <td><a href="?customerId=<?php echo $cmrId; ?>&price=<?php echo $result['product_qty']; ?>&time=<?php echo $result['order_date']; ?>&prodId=<?php echo $result['product_id']; ?>">Confirm</a></td>
                                    <?php } elseif ($result['order_status'] == '2') { ?>
                                        <td>OK</td>
                                    <?php } elseif ($result['order_status'] == '0') { ?>
                                        <td>N/A</td>
                                    <?php } ?>
                                </tr>
                            <?php } } ?>
                            </tbody>
                        </table>
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
                <?php 
					$getRelatedPd = $pd->getFeaturedProduct();
					if ($getRelatedPd) {
						while ($result = $getRelatedPd->fetch_assoc()) {
				?>
				<div class="col-lg-3 col-sm-6 col-6">
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
				</div>
                <?php } }?>
			</div>
		</div>
	</section>
	<!-- Related product section end -->


<?php include 'includes/footer.php' ?>
