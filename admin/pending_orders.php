<?php include 'inc/header.php'; ?> 
<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Cart.php');
	$ct = new Cart();
	$fm = new Format();
?>
<?php 
	if (isset($_GET['shiftid']) && isset($_GET['time']) && isset($_GET['price']) && isset($_GET['prodId'])) {
		$id 	= $_GET['shiftid'];
		$time 	= $_GET['time'];
		$price 	= $_GET['price'];
		$prodId = $_GET['prodId'];
		$shift 	= $ct->productShifted($id, $time, $price, $prodId);
	}

	if (isset($_GET['delproId']) && isset($_GET['time']) && isset($_GET['price']) && isset($_GET['prodId'])) {
		$id 	= $_GET['delproId'];
		$time 	= $_GET['time'];
		$price 	= $_GET['price'];
		$prodId = $_GET['prodId'];
		$delOrder 	= $ct->delProductShifted($id, $time, $price, $prodId);
	}


?>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-car icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Pending Orders
                                        <div class="page-title-subheading">Welcome Back! <strong> </strong> Here you can view customer orders, manage customers order, change order status, add new product, add new product category, homepage slider, add user, manage users or customers and many more. Have fun!
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div> 
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Recent Orders</h5>
                                <?php 
                	if (isset($shift)) {
                		echo $shift;
                	}
                	if (isset($delOrder)) {
                		echo $delOrder;
                	}
                ?>
                                <div class="table-responsive table-bordered">
                                    <table class="mb-0 table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Order Date</th>
                                                <th>Product Title</th>
                                                <th>Qty.</th>
                                                <th>Amount</th>
                                                <th>Customer ID</th>
                                                <th>Action</th>
                                                <th>Order Staus</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                        <?php 
                            $fm = new Format();
							$getOrder = $ct->getPendingOrders();
							if ($getOrder) {
								while ($result = $getOrder->fetch_assoc()) {
						?>
                                                <tr>
                                                    <th scope="row"><?= $result['order_id']; ?></th>
                                                    <td><?= $fm->formatDate($result['order_date']); ?></td>
                                                    <td><?= $result['product_title']; ?></td>
                                                    <td><?= $result['product_qty']; ?></td>
                                                    <td><?= $result['due_amount']; ?></td>
                                                    <td><?php
                                                    if ($result['customer_id'] == 0) {
                                                        echo "Guest Order";
                                                    }else{
                                                       echo $result['customer_id'];
                                                    }
                                                    ?></td>
                                                    <td><a href="view_order.php?id=<?php echo $result['order_id']; ?>">View Details</a></td>
							<?php if ($result['order_status'] == 0) { ?>
								<td><a href="?shiftid=<?php echo $result['customer_id']; ?>&price=<?php echo $result['due_amount']; ?>&time=<?php echo $result['order_date']; ?>&prodId=<?php echo $result['product_id']; ?>">Pending</a></td>
							<?php } elseif ($result['order_status'] == 1) { ?>
								<td>Confirm</td>
							<?php } else { ?>
								<td><a href="?delproId=<?php echo $result['customer_id']; ?>&price=<?php echo $result['due_amount']; ?>&time=<?php echo $result['order_date']; ?>&prodId=<?php echo $result['product_id']; ?>">Remove</a></td>
							<?php } ?>
                                                </tr>
                                            <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
<?php include 'inc/footer.php'; ?>