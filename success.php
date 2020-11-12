<?php include 'includes/header.php'; ?>
<!-- Page info -->
<div class="container" style="margin-top: 30px;">
		<div class="page-top-info">
			<div class="breadcrumb"> &nbsp;<a href="index.html">Home&nbsp;</a> » &nbsp;<a href="success.php">Success&nbsp;</a> </div>
			<div class="section-title">
				<h3><span>Order Success</span></h3>
			</div>
		</div>
	</div>
    <!-- Page info end -->
    	<!-- checkout section  -->
	<section class="success-section spad col-md-6">
		<div class="container">
			<?php 
    				$cmrId = Session::get("cmrId");
    				$amount = $ct->payableAmount($cmrId);
    				if ($amount) {
                        $sum = 0;
                        $total = 0;
    					while ($result = $amount->fetch_assoc()) {
    						$price 	= $result['due_amount'];
                            $sub_total = $sum + $price;
						    $total +=$sub_total;
							$V_Total = $total + 60;
    			?>
			<h4 style="text-align:center; text-transform: uppercase;">Success</h4>
			<hr>
            <h5 style="color: green;">Your Order has been successfully placed!</h5>
            <br>
    			<p>Total Payable Amount(Including Shipping Cost) :  
					<strong>TK. <?= $V_Total ?> </strong>
                </p>
                
            <p style="color: red">Thanks for Purchase. Receive Your Order Successfully. We will contact you ASAP with delivery details. Here is your order details....<a href="order_history.php">Click here.</a></p>
			<?php } } ?>
		</div>
	</section>
	<!-- checkout section end -->
<?php include 'includes/footer.php'; ?>