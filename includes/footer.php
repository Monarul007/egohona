	<!-- Footer section -->
	<section class="footer-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>About</h2>
						<p>Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam frin-gilla faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
						<img src="img/cards.png" alt="">
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Customer Service</h2>
						<ul>
							<li><a href="req_quotation.php">Request Custom Design</a></li>
							<li><a href="">About Us</a></li>
							<li><a href="order_history.php">Track Orders</a></li>
							<li><a href="my_account.php">My Account</a></li>
							<li><a href="">Terms of Use</a></li>
							<li><a href="contact.php">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Latest Products</h2>
						<div class="fw-latest-post-widget">
						<?php 
							$getFooterPd = $pd->getFooterProduct();
							if ($getFooterPd) {
								while ($result = $getFooterPd->fetch_assoc()) {
						?>
							<div class="lp-item">
								<div class="lp-thumb set-bg" data-setbg="admin/<?= $result['product_img']; ?>"></div>
								<div class="lp-content">
									<h6><?= $result['product_title']; ?></h6>
									<span><?= $fm->formatDate($result['date']); ?></span>
									<a href="product.php?id=<?= $result['id']; ?>" class="readmore">Read More</a>
								</div>
							</div>
						<?php } } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget contact-widget">
						<h2>Contact With Us</h2>
						<div class="con-info">
							<span>A.</span>
							<p>Your Company Ltd </p>
						</div>
						<div class="con-info">
							<span>B.</span>
							<p>1481 Creekside Lane  Avila Beach, CA 93424, P.O. BOX 68 </p>
						</div>
						<div class="con-info">
							<span>T.</span>
							<p>+53 345 7953 32453</p>
						</div>
						<div class="con-info">
							<span>E.</span>
							<p>office@youremail.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="social-links-warp">
			<div class="container">
				<p class="text-center">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved - Developed by <a href="mailto:monarul007@gmail.com" target="_blank">Monarul Islam</a></p>
			</div>
		</div>
	</section>
	<!-- Footer section end -->



	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.steps.js"></script>

	</body>
</html>