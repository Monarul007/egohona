<?php include 'includes/header.php'; ?>

	<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
            <!-- HEADING-BANNER START -->
			<div class="pages-title about-page section-padding overlay-bg">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center" style="margin:0 auto;">
						<div class="pages-title-text">
							<h3 style="color:#fff;position: relative;">About Us</h3>
							<div style="color:#fff;position: relative;"> &nbsp;<a href="index.php">Home&nbsp;</a> » &nbsp;<a href="">About Us&nbsp;</a> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<!-- HEADING-BANNER END -->
                    <!-- ABOUT-US-AREA START -->
                    <div class="about-us-area">
                        <div class="container">	
                            <div class="about-us bg-white">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="about-photo">
                                            <img src="img/about.png" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="about-brief bg-dark-white">
                                            <h4 class="title-1 title-border text-uppercase mb-3">about eGohona</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magn aliqua. Ut enim ad minim veniam, ommodo consequa.  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia is be deserunt mollit anim id est laborum.</p>
                                            <p>Sed ut perspiciatis unde omnis iste natus error sit. voluptatem accusantium doloremque laudantium, totam remes aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                            <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
			        <!-- ABOUT-US-AREA END -->
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