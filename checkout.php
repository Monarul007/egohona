<?php include 'includes/header.php'; ?>
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$cmrId = Session::get("cmrId");
		$insertOrder = $ct->ordersProduct($cmrId, $_POST);
		$delData = $ct->delCustomerCart();
		echo "<script>window.open('success.php','_SELF')</script>";
	}
?>
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guest'])) {
		$guestID = Session::get("guestID");
		$insertOrder = $ct->orderByGuest($guestID, $_POST);
		$delData = $ct->delCustomerCart();
		echo "<script>window.open('success.php','_SELF')</script>";
	}
?>
	<!-- Page info -->
	<div class="container" style="margin-top: 30px;">
		<div class="page-top-info">
			<div class="breadcrumb"> &nbsp;<a href="index.html">Home&nbsp;</a> » &nbsp;<a href="#">Checkout&nbsp;</a> </div>
			<div class="section-title">
				<h3><span>Checkout</span></h3>
			</div>
		</div>
	</div>
	<!-- Page info end -->
	<?php 
					$login = Session::get("custlogin");
					if ($login == false) {
						echo "<div class='container'>You are going to order as a guest. To get full access you can <a href='login.php'>Login here</a></div>";
					}
				?>

	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="wizard-v5-content">
				<div class="wizard-form">
					<form class="form-register needs-validation" id="form-register" action="#" method="post" novalidate>
					<?php 
                                                    if (isset($insertOrder)) {
                                                        echo $insertOrder;
                                                    }
                                                ?>
						<div id="form-total">
							<!-- SECTION 1 -->
							<h2>
								<span class="step-icon"><i class="fa fa-check"></i></span>
								<span class="step-text">BILLING DETAILS</span>
							</h2>
							<section>
								<div class="inner">
									<h3 style="margin-bottom: 18px; padding: 0;">Billing Details</h3>
									<?php 
										$id = Session::get("cmrId");
										$getData = $cmr->getCustomerData($id);
										if ($getData) {
											while ($result = $getData->fetch_assoc()) {
									?>
									<div class="form-row">
										<div class="form-holder">
											<input type="text" value="<?= $result['full_name']; ?>" class="form-control" id="name" name="name">
										</div>
										<div class="form-holder">
											<input type="email" name="email" class="email input-step-2-1" id="Email" value="<?= $result['email_address']; ?>" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder form-holder-2">
											<input type="text" value="<?= $result['billing_address']; ?>" class="form-control" id="address" name="address">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<input type="number" value="<?= $result['phone']; ?>" class="form-control" id="phone" name="phone">
										</div>
										<div class="form-holder">
											<input type="number" value="<?= $result['postcode']; ?>" class="form-control" id="code" name="code" pattern = "[0-9]{4}">
										</div>
									</div>
									<?php } }else { ?>								
	<div class="form-row">
										<div class="form-holder">
											<input type="text" placeholder="ex: Laura" class="form-control" id="name" name="name">
										</div>
										<div class="form-holder">
											<input type="email" name="email" class="email input-step-2-1" id="Email" placeholder="ex: example@email.com" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder form-holder-2">
											<input type="text" placeholder="622 Dixie Path, South Tobinchester, UT 98336" class="form-control" id="address" name="address">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<input type="number" placeholder="+1 777-888-8888" class="form-control" id="phone" name="phone">
										</div>
										<div class="form-holder">
											<input type="number" placeholder="ex: 1207" class="form-control" id="code" name="code" pattern = "[0-9]{4}">
										</div>
									</div>								<?php } ?>
								</div>
							</section>
							<!-- SECTION 2 -->
							<h2>
								<span class="step-icon"><i class="fa fa-check"></i></span>
								<span class="step-text">SHIPPING DETAILS</span>
							</h2>
							<section>
								<div class="inner">
									<h3 style="margin-bottom: 15px; padding: 0;">Shipping Address</h3>
									<input type="checkbox" id="same" name="same" onchange= "addressFunction()"/>			 
									<label for ="same">Same as Billing Details</label>
									<div class="form-row">
										<div class="form-holder">
											<input type="text" placeholder="Reciever name..." class="form-control" id="samename" name="samename">
										</div>
										<div class="form-holder">
											
											<input type="email" name="sameEmail" class="email input-step-2-1" id="sameEmail" placeholder="example@email.com" pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder form-holder-2">
										
											<input type="text" placeholder="Delivery address..." class="form-control" id="sameaddress" name="sameaddress" pattern="[0-9]{4}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<input type="number" placeholder="Reciever phone number..." class="form-control" id="samephone" name="samephone">
										</div>
										<div class="form-holder">
											<input type="number" placeholder="Postcode" class="form-control" id="samecode" name="samecode">
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder form-holder-2">
											<label for="notes" class="form-label">Special Notes</label>
											<textarea type="text" name="special_note" id="account_name" placeholder="Notes about your order, e.g. special notes for delivery." class="valid" aria-invalid="false"></textarea>
										</div>
									</div>
								</div>
								<script> 
									function addressFunction() 
									{ 
									if (document.getElementById('same').checked) 
									{ 
										document.getElementById('samename').value=document. 
												getElementById('name').value; 
										document.getElementById('sameaddress').value=document. 
												getElementById('address').value;
										document.getElementById('samephone').value=document. 
												getElementById('phone').value;
										document.getElementById('samecode').value=document. 
												getElementById('code').value;
										document.getElementById('sameEmail').value=document. 
												getElementById('Email').value;
									} 
										
									else
									{ 
										document.getElementById('samename').value=""; 
										document.getElementById('sameaddress').value=""; 
										document.getElementById('samephone').value=""; 
										document.getElementById('samecode').value=""; 
										document.getElementById('sameEmail').value="";
									} 
									} 
								</script> 
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
													<th>Full Name:</th>
													<td id="samename-val"> </td>
												</tr>
												<tr class="space-row">
													<th>Email Address:</th>
													<td id="sameEmail-val"></td>
												</tr>
												<tr class="space-row">
													<th>Phone Number:</th>
													<td id="samephone-val"></td>
												</tr>
												<tr class="space-row">
													<th>Shipping Address:</th>
													<td id="sameaddress-val"></td>
												</tr>
												<tr class="space-row">
													<th>Postcode / ZIP:</th>
													<td id="samecode-val"></td>
												</tr>
												<tr class="space-row">
													<th>Special Notes:</th>
													<td id="account-name-val"></td>
												</tr>
											</tbody>
										</table>
									</div>
									<h3>Your cart details</h3>
									<div class="checkout-product table-responsive" style="padding: 0 20px;">
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
                                        <tbody>
										<?php 
										$getPro = $ct->getCartProduct();
										if ($getPro) {
											$i = 0;
											$total = 0;
											while ($result = $getPro->fetch_assoc()) {
												$i++;
												$sub_total = $result['product_price'] * $result['product_qty'];
												$total +=$sub_total;
												$V_Total = $total + 60;
										?>
                                            <tr>
                                            <td class="name"><a href="product.php?id=<?= $result['product_id'] ?>"><?= $result['product_name'] ?></a></td>
                                            <td class="model"><?= $result['product_code'] ?></td>
                                            <td class="tquantity"><?= $result['product_qty'] ?></td>
                                            <td class="price">৳ <?= $result['product_price'] ?></td>
                                            <td class="total">৳ <?= $sub_total; ?></td>
                                            </tr>
											<?php } } ?>
                                        </tbody>
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
                                        </tfoot>
                                        </table>
									</div>
										<?php 
											$id = Session::get("cmrId");
											$getData = $cmr->getCustomerData($id);
											if ($getData) {
												echo '<div class="rright"><button type="submit" name="submit" class="site-btn">Place Order</a>
												</div>';
											}else{
												echo '<div class="rright"><button type="submit" name="guest" class="site-btn">Order As Guest</a>
												</div>';
											}
										?>
									<?php } else { 
												echo "<div class='cart-empty'>
												<p>Cart Empty! Please add product to cart.</p>
												<a href='index.php' style='color:#fff; padding: 10px 20px;' class='site-btn'>Continue Shopping</a>
												</div>
												";
											} ?>
								</div>
							</section>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->


<?php include 'includes/footer.php'; ?>