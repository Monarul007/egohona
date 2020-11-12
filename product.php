<?php include 'includes/header.php'; ?>
<?php
    if (isset($_GET['id'])) {
        $id = preg_replace('/[^A-Za-z0-9_]/', '', $_GET['id']);
	}
	if (!isset($_GET['id'])) {
		echo "<script>window.location = 'shop.php';</script>";
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $quantity = $_POST['qty'];
        $addCart = $ct->addToCart($quantity, $id);
    }
?>

	<!-- product section -->
	<section class="product-section">
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

				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
				<?php 
					$getPd = $pd->getSingleProduct($id);
					if ($getPd) {
						while ($result = $getPd->fetch_assoc()) {
				?>
					<!-- Page info -->
					<div class="page-top-info">
						<div class="breadcrumb"> &nbsp;<a href="index.php">Home&nbsp;</a> » &nbsp;<a href="product.php?id=<?= $result['id']; ?>"><?= $result['product_title']; ?>&nbsp;</a> </div>
						<div class="section-title">
							<h3><span><?= $result['product_title']; ?></span></h3>
						</div>
					</div>
					<!-- Page info end -->
					<?php }} ?>
					
			<div class="row">
				<?php 
					$getPd = $pd->getSingleProduct($id);
					if ($getPd) {
						while ($result = $getPd->fetch_assoc()) {
				?>
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="admin/<?= $result['product_img']; ?>" alt="">
					</div>
					<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
						<div class="product-thumbs-track">
							<div class="pt active" data-imgbigurl="admin/<?= $result['product_img']; ?>"><img src="admin/<?= $result['product_img']; ?>" alt=""></div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h3 class="p-price"><span class="old-price"> <?= $result['regular_price']; ?></span><?= $result['new_price']; ?></h3>
					<h4 class="p-stock">Available: <span>
					<?php
					if ($result['product_status'] == 0){
						echo 'In Stock';
					}
					?>
					</span></h4>
					<h4 class="p-stock">Brand: <span><?= $result['brand_name']; ?></span></h4>
					<h4 class="p-stock">Product Code: <span><?= $result['product_code']; ?></span></h4>
					
					<div class="quantity">
						<p>Qty:</p>
						<div class="pro-qty">
						<form action="" method="POST">
							<input type="text" value="1" name="qty"></div>
							<input type="submit" href="#" name="submit" value="Add to cart" class="site-btn">
						</form>
                    </div>
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<p><?= $result['product_desc']; ?></p>
									<p><?= $result['product_spec']; ?></p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingTwo">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">card details </button>
							</div>
							<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="panel-body">
									<img src="./img/cards.png" alt="">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingThree">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
							</div>
							<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="panel-body">
									<h4>7 Days Returns</h4>
									<p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } } else { 
												echo "<div class='empty-cart'>
												<p style='color: red;'>No product selected! Please select an product to see details. </p>
												<a href='category.php' style='color:#fff; padding: 10px 20px;' class='site-btn'>Click here</a>
												</div>
												";
											} ?>
			</div>
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->


	<!-- RELATED PRODUCTS section -->
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
	<!-- RELATED PRODUCTS section end -->


<?php include 'includes/footer.php'; ?>