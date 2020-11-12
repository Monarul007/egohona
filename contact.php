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
				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<!-- Page info -->
					<div class="page-top-info">
						<div class="breadcrumb"> &nbsp;<a href="index.html">Home&nbsp;</a> » &nbsp;<a href="#">Contact Us&nbsp;</a> </div>
						<div class="section-title">
							<h3><span>Contact Us</span></h3>
						</div>
						<div class="category-info">
							<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ulla. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						</div>
					</div>
					<!-- Page info end -->
					<div class="contact-info">
						<h3>Get in touch</h3>
						<div class="row">
							<div class="col-lg-4">
								<p>Main Str, no 23, New York</p>
								<p>+546 990221 123</p>
								<p>hosting@contact.com</p>
								<div class="contact-social">
									<a href="#"><i class="fa fa-pinterest"></i></a>
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-dribbble"></i></a>
									<a href="#"><i class="fa fa-behance"></i></a>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="map"><iframe src="" style="border:0" allowfullscreen></iframe></div>
							</div>
						</div>
						<h3 style="margin-top:50px">Get in touch</h3>
						<form class="contact-form">
							<input type="text" placeholder="Your name">
							<input type="text" placeholder="Your e-mail">
							<input type="text" placeholder="Subject">
							<textarea placeholder="Message"></textarea>
							<button style="float: right;" class="site-btn">SEND NOW</button>
						</form>
					</div>	
				</div>
			</div>
		</div>
	</section>
	<!-- Contact section end -->


	<!-- Related product section -->
	<section class="related-product-section spad">
		<div class="container">
			<div class="section-title">
				<h2><span>YOUR FAVOURITES</span></h2>
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