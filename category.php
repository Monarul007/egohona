<?php include 'includes/header.php'; ?>
<?php
    if (isset($_GET['cat_id'])) {
        $id = preg_replace('/[^A-Za-z0-9_]/', '', $_GET['cat_id']);
	}
	if (!isset($_GET['cat_id'])) {
        echo "<script>window.location = 'shop.php';</script>";
    }
?>

	<!-- Category section -->
	<section class="category-section spad">
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
							<?php 
								$getCat = $cat->getCatById($id);
								if ($getCat) {
									while ($result = $getCat->fetch_assoc()) {
							?>
					<div class="page-top-info">
						<div class="breadcrumb"> &nbsp;<a href="index.php">Home&nbsp;</a> » &nbsp;<a href="category.php?cat_id<?= $result['id']; ?>"><?= $result['cat_name']; ?>&nbsp;</a> </div>
						<div class="section-title">
							<h3><span><?= $result['cat_name']; ?></span></h3>
						</div>
						<div class="category-info">
							<p><?= $result['cat_desc']; ?></p>
						</div>
						<?php } } ?>
					</div>
					<!-- Page info end -->
							<?php 
								$getData = $pd->checkPdTable($id);
								if ($getData) { 
							?>
					<div class="row display">
							<?php 
								$getCatPd = $pd->getProductByCat($id);
								if ($getCatPd) {
									while ($result = $getCatPd->fetch_assoc()) {
							?>
						<div class="col-lg-4 col-sm-4 col-6">
							<div class="product-item">
								<div class="pi-pic">
									<a href="product.php?id=<?= $result['id']; ?>"><img src="admin/<?= $result['product_img']; ?>" alt=""></a>
								</div>
								<div class="pi-text">
									<a href="product.php?id=<?= $result['id']; ?>"><p class="pi-title"><?= $result['product_title']; ?> </p></a>
									<p class="pi-desc"><?= substr($result['product_desc'], 0, 80) ?></p>
									<h6><?= $result['new_price']; ?> <span class="old-price"> <?= $result['regular_price'] ?></span></h6>
									<div class="pi-links">
										<a href="product.php?id=<?= $result['id']; ?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
									</div>
								</div>
							</div>
						</div>
						<?php } } elseif (condition) {
							# code...
						}?>
						<div class="text-center w-100 pt-3">
							<button class="site-btn sb-line sb-dark">LOAD MORE</button>
						</div>
					</div>
					<?php } else { 
												echo "<div class='empty-cart'>
												<p style='color: red;'>No products found! Please check back another category or you can </p>
												<a href='category.php' style='color:#fff; padding: 10px 20px;' class='site-btn'>Click here</a>
												</div>
												";
											} ?>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->

<?php include 'includes/footer.php'; ?>