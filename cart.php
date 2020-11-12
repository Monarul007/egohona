<?php include 'includes/header.php'; ?>

<?php 
	if (isset($_GET['delpro'])) {
        $delId = preg_replace('[^A-Za-z0-9_]', '', $_GET['delpro']);
        $delProduct = $ct->delProductByCart($delId);
    }
?>
<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cartId 	= $_POST['cartId'];
        $quantity 	= $_POST['quantity'];
        $updateCart = $ct->updateCartQuantity($cartId, $quantity);
        if ($quantity <= 0) {
        	$delProduct = $ct->delProductByCart($cartId);
        }
    }
?>
<?php 
	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=eGohona'/>";
	}
?>
	<!-- Page info -->
	<div class="container" style="margin-top: 30px;">
		<div class="page-top-info">
			<div class="breadcrumb"> &nbsp;<a href="index.html">Home&nbsp;</a> » &nbsp;<a href="#">Clothes For Girls&nbsp;</a> </div>
			<div class="section-title">
				<h3><span>Your Cart</span></h3>
			</div>
		</div>
	</div>
	<!-- Page info end -->

	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
							<?php 
								$getData = $ct->checkCartTable();
								if ($getData) { 
							?>
						<div class="cart-table-warp">
						<?php 
			    		if (isset($updateCart)) {
			    			echo $updateCart;
			    		}
			    		if (isset($delProduct)) {
			    			echo $delProduct;
			    		}
			    	?>
							<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="size-th">Price</th>
									<th class="total-th">Total</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$getPro = $ct->getCartProduct();
							if ($getPro) {
								$i = 0;
								$sum = 0;
								$qty = 0;
								while ($result = $getPro->fetch_assoc()) {
									$i++;
							?>
								<tr>
									<td class="product-col">
										<img src="admin/<?= $result['product_image']; ?>" alt="">
										<div class="pc-title">
											<h4><?= $result['product_name']; ?></h4>
											<p><?= $result['product_price']; ?></p>
										</div>
									</td>
									<td class="quy-col">
										<div class="quantity">
											<form action="" method="POST">
												<input type="hidden" name="cartId" value="<?php echo $result['id']; ?>"/>
												<div class="pro-qty">
													<input type="text" name="quantity" value="<?= $result['product_qty']; ?>"> <br>
												</div>
												<button title="Update Quantity" class="icon" type="submit" name="submit"><i class="fa fa-refresh"></i></button>
												<a title="Delete from cart" class="icon" onclick="return confirm('Are you sure to delete !')" href="?delpro=<?php echo $result['id']; ?>"><i class="fa fa-times"></i></a>
											</form>
                    					</div>
									</td>
									<td class="size-col"><h4>TK. <?= $result['product_price']; ?></h4></td>
									<td class="total-col"><h4>TK. <?php 
								$total = $result['product_price'] * $result['product_qty'];
								echo $total; 
								?></h4></td>
								</tr>
								<?php 
								$sum = $sum + $total;
								$qty = $qty + $result['product_qty'];
								Session::set("qty", $qty);
								Session::set("sum", $sum);
								?>
							<?php } } ?>
							</tbody>
						</table>
						</div>
						<div class="total-cost">
							<h6>Total <span>TK. <?php echo $sum; ?></span></h6>
						</div>
						<?php } else { 
												echo "<div class='empty-cart'>
												<p>Cart Empty! Please add product to cart.</p>
												<a href='index.php' style='color:#fff; padding: 10px 20px;' class='site-btn'>Continue Shopping</a>
												</div>
												";
											} ?>
					</div>
				</div>
				<div class="col-lg-4 card-right">
					<a href="checkout.php" class="site-btn">Proceed to checkout</a>
					<a href="category.php" class="site-btn sb-dark">Continue shopping</a>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->

	<!-- Related product section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title text-uppercase">
				<h2><span>CONTINUE SHOPPING</span></h2>
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