<?php include 'includes/header.php'; ?>
<?php 
    if (!isset($_GET['search']) || $_GET['search'] == "") {
        echo "<script>window.location = '404.php';</script>";
    } else {
        $search = $_GET['search'];
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
							<li><a href="#" class="active">Woman wear</a>
								<ul class="sub-menu">
									<li><a href="#">Midi Dresses <span>(2)</span></a></li>
									<li><a href="#">Maxi Dresses<span>(56)</span></a></li>
									<li><a href="#">Prom Dresses<span>(36)</span></a></li>
									<li><a href="#">Little Black Dresses <span>(27)</span></a></li>
									<li><a href="#">Mini Dresses<span>(19)</span></a></li>
								</ul>
							</li>
							<li><a href="#">Man Wear</a>
								<ul class="sub-menu">
									<li><a href="#">Midi Dresses <span>(2)</span></a></li>
									<li><a href="#">Maxi Dresses<span>(56)</span></a></li>
									<li><a href="#">Prom Dresses<span>(36)</span></a></li>
								</ul></li>
							<li><a href="#">Children</a></li>
							<li><a href="#">Bags & Purses</a></li>
							<li><a href="#">Eyewear</a></li>
							<li><a href="#">Footwear</a></li>
						</ul>
					</div>
					<div class="filter-widget">
						<h2 class="fw-title">Latest Products</h2>
						<ul class="category-menu">
							<li>
								<div class="lp-item">
								<div class="lp-thumb">
									<a href=""><img src="img/blog-thumbs/1.jpg" alt=""></a> 
								</div>
								<div class="lp-content">
									<a href="" class="title">what shoes to wear</a>
									<span>$35,00 <span class="old-price"> $55,00</span>
									<a href="#" class="readmore">Read More</a>
								</div>
								</div>
							</li>
							
							<li>
								<div class="lp-item">
								<div class="lp-thumb">
									<a href=""><img src="img/blog-thumbs/2.jpg" alt=""></a> 
								</div>
								<div class="lp-content">
									<a href="" class="title">what shoes to wear</a>
									<span>$35,00 <span class="old-price"> $55,00</span>
									<a href="#" class="readmore">Read More</a>
								</div>
								</div>
							</li>
							
							<li>
								<div class="lp-item">
								<div class="lp-thumb">
									<a href=""><img src="img/blog-thumbs/1.jpg" alt=""></a> 
								</div>
								<div class="lp-content">
									<a href="" class="title">what shoes to wear</a>
									<span>$35,00 <span class="old-price"> $55,00</span>
									<a href="#" class="readmore">Read More</a>
								</div>
								</div>
							</li>
							
							<li>
								<div class="lp-item">
								<div class="lp-thumb">
									<a href=""><img src="img/blog-thumbs/2.jpg" alt=""></a> 
								</div>
								<div class="lp-content">
									<a href="" class="title">what shoes to wear</a>
									<span>$35,00 <span class="old-price"> $55,00</span>
									<a href="#" class="readmore">Read More</a>
								</div>
								</div>
							</li>
							
							<li>
								<div class="lp-item">
								<div class="lp-thumb">
									<a href=""><img src="img/blog-thumbs/1.jpg" alt=""></a> 
								</div>
								<div class="lp-content">
									<a href="" class="title">what shoes to wear</a>
									<span>$35,00 <span class="old-price"> $55,00</span>
									<a href="#" class="readmore">Read More</a>
								</div>
								</div>
							</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<!-- Page info -->
					<div class="page-top-info">
						<div class="breadcrumb"> &nbsp;<a href="index.php">Home&nbsp;</a> » &nbsp;<a href="search.php?search=">Search&nbsp;</a> </div>
						<div class="section-title">
							<h3><span>Search Page</span></h3>
						</div>
						<div class="category-info">
							<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ulla. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						</div>
					</div>
					<!-- Page info end -->
					<div class="row display">
                        <?php
                            $query = "SELECT * FROM products WHERE product_title LIKE '%$search%' OR product_desc LIKE '%$search%'";
                            $products = $db->select($query);
                                if ($products){
                                    while ($result = $products->fetch_assoc()){
                        ?>
						<div class="col-lg-4 col-sm-4 col-6">
							<div class="product-item">
								<div class="pi-pic">
									<a href=""><img src="admin/<?= $result['product_img']; ?>" alt=""></a>
								</div>
								<div class="pi-text">
									<a href="product.php?id=<?= $result['id']; ?>"><p class="pi-title"><?= $result['product_title']; ?></p></a>
									<p class="pi-desc"><?= substr($result['product_desc'], 0, 80) ?></p>
									<h6><?= $result['new_price'] ?> <span class="old-price"> <?= $result['regular_price'] ?></span></h6>
									<div class="pi-links">
										<a href="product.php?id=<?= $result['id'] ?>" class="add-card"><i class="flaticon-bag"></i><span>VIEW DETAILS</span></a>
									</div>
								</div>
							</div>
						</div>
                        <?php } } else { ?>
                            <div class="col"><p style="color: red;">Your searched keyword does not mathched any query. Try searching with some new keywords.</p></div>
                        <?php } ?>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->

<?php include 'includes/footer.php'; ?>