<?php include 'includes/header.php'; ?>

	<!-- Hero section -->
	<section id="hero-section" class="hero-section" style="margin-top: 15px; overflow: hidden;">
		<div class="container">
			<div class="row">
			<div class="hero-slider owl-carousel col-md-9">
				<?php 
                    $getSlider = $sldr->getAllSliders();
                    if ($getSlider) {
                        while ($result = $getSlider->fetch_assoc()) {
                ?>												
				<div class="hs-item set-bg" data-setbg="admin/<?= $result['slide_img'] ?>">
					<div class="container">
						<div class="row">
							<div class="col-xl-6 col-lg-7 text-white">
								<span><?= $result['slide_type']; ?></span>
								<h2><?= $result['slide_title']; ?></h2>
								<p><?= $result['slide_caption']; ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php } } ?>
			</div>
			<div class="hero-banner col-md-3">
				<div class="single-banner banner-1">
					<a class="banner-thumb" href="req_quotation.php">
						<?php 
							$sql = "SELECT * FROM banners WHERE banner_type = '1'";
							$getData = $db->select($sql);
                                if ($getData) {
                                    while ($result = $getData->fetch_assoc()) {
						?>
						<img src="admin/<?= $result["banner_image"]; ?>" alt="" title="<?= $result["banner_title"]; ?>">
					<?php } } ?>
					</a>
				</div>
			</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- letest product section -->
	<section class="display top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2><span>LATEST PRODUCTS</span></h2>
			</div>
			<div class="row" style="padding: 0 5px;">
				<?php
					$getLatestProducts = $pd->getNewProduct();
					if ($getLatestProducts){
						while ($result = $getLatestProducts->fetch_assoc()) {

				?>
				<div class="col-lg-3 col-sm-3 col-6">
					<div class="product-item">
						<div class="pi-pic">
							<a href="product.php?id=<?= $result['id'] ?>"><img src="admin/<?= $result['product_img'] ?>" alt=""></a>
						</div>
						<div class="pi-text">
							<a href="product.php?id=<?= $result['id'] ?>"><p class="pi-title"><?= $result['product_title'] ?></p></a>
							<p class="pi-desc"><?= substr($result['product_desc'], 0, 80) ?></p>
							<h6><?= $result['new_price'] ?> <span class="old-price"><?= $result['regular_price'] ?></span></h6>
							<div class="pi-links">
								<a href="product.php?id=<?= $result['id'] ?>" class="add-card"><i class="flaticon-bag"></i><span>VIEW DETAILS</span></a>
							</div>
						</div>
					</div>
				</div>
				<?php } } ?>
			</div>
		</div>
	</section>
	<!-- letest product section end -->


	<!-- featured product section -->
	<section class="display top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2><span>FEATURED PRODUCTS</span></h2>
			</div>
			<div class="row" style="padding: 0 5px;">
				<?php
					$getFeaturedProducts = $pd->latestFromRings();
					if ($getFeaturedProducts){
						while ($result = $getFeaturedProducts->fetch_assoc()) {

				?>
				<div class="col-lg-3 col-sm-3 col-6">
					<div class="product-item">
						<div class="pi-pic">
							<a href=""><img src="admin/<?= $result['product_img'] ?>" alt=""></a>
						</div>
						<div class="pi-text">
							<a href=""><p class="pi-title"><?= $result['product_title'] ?></p></a>
							<p class="pi-desc"><?= substr($result['product_desc'], 0, 70) ?></p>
							<h6><?= $result['regular_price'] ?><span class="old-price"><?= $result['new_price'] ?></span></h6>
							<div class="pi-links">
								<a href="product.php?id=<?= $result['id'] ?>" class="add-card"><i class="flaticon-bag"></i><span>VIEW DETAILS</span></a>
							</div>
						</div>
					</div>
				</div>
				<?php } } ?>
			</div>
		</div>
	</section>
	<!-- featured product section end -->

	<!--Trigger Modal on Page load-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-5 img">
							<img src="img/custom.png" alt="">
						</div>
						<div class="col-md-7 col-12">
							<h5 class="wlc">Welcome! to eGohona....</h5>
							<h5 style="color: #fff; margin: 10px 0;">Request <span style="color:#f51167;">Custom Designed</span> Jewelry!</h5>
							<p style="color: #fff;">Yes, you can now request a custom designed jewelry on eGohona.com! Because your choice matter to us. We always respect our customers choice. </p>
							<a href="req_quotation.php" class="site-btn">Request Now</a>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<!-- Banner section -->
	<section class="banner-section">
		<div class="container">
						<?php 
							$sql = "SELECT * FROM banners WHERE banner_type = '3'";
							$getData = $db->select($sql);
                                if ($getData) {
                                    while ($result = $getData->fetch_assoc()) {
						?>
			<div class="banner set-bg" data-setbg="admin/<?= $result['banner_image']; ?>">
				<div class="tag-new">NEW</div>
				<span>New Arrivals</span>
				<h2><?= $result['banner_title']; ?></h2>
				<a href="shop.php" class="site-btn">SHOP NOW</a>
			</div>
			<?php } } ?>
		</div>
	</section>
	<!-- Banner section end  -->


<?php include 'includes/footer.php'; ?>
