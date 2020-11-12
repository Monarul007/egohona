<?php 
    include '../classes/General.php';
	
	$fm = new Format();
?>
<?php
	$order = new General();
    if (!isset($_GET['id']) || $_GET['id'] == NULL) {
        echo "<script>window.location = 'view_sliders.php'; </script>";
    } else {
        $id = preg_replace('[^A-Za-z0-9_]', '', $_GET['id']);
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Editable Invoice</title>
	<link href="./main.css" rel="stylesheet">
	<link href="./css/stylesheet.css" rel="stylesheet">
    <script src="./js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="./js/invoice.js" type="text/javascript"></script>
</head>
<body style="background-color: #EEEEEE;">
	<div class="container">
		<button onclick="window.print()" style="float: right;" class="mt-3 mr-3 btn btn-primary active">Print Invoice</button>
	</div>
	<div id="invoice" class="container">
		<div class="main-card mb-3">
			<div id="page-wrap" class="">
            <?php 
                $getOrder = $order->getOrdersById($id);
                    if ($getOrder) {
                        while ($result = $getOrder->fetch_assoc()) {
            ?>
				<textarea id="header">INVOICE</textarea>
				<div id="identity" class="">
					<div id="address" class="col-md-6">
						<button style="width:100%;" class="mb-2 mr-2 btn btn-dark">Delivery Details</button> <br>
						Name: <?= $result['buyer_name']; ?> <br>
						Address: <?= $result['buyer_address']; ?> <br>
						E-mail: <?= $result['buyer_email']; ?> <br>
						Phone: <?= $result['buyer_phone']; ?>
					</div>
					<div id="logo" class="col-md-6">
						<textarea id="date"></textarea> <br>
						<div id="logoctr">
							<a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
							<a href="javascript:;" id="save-logo" title="Save changes">Save</a>
							|
							<a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
							<a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
						</div>

						<div id="logohelp">
							<input id="imageloc" type="text" size="50" value="" /><br />
							(max width: 540px, max height: 100px)
						</div>
						<img id="image" src="assets/images/logo.png" alt="logo" width="250px"/>
					</div>
				</div>
				<div style="clear:both"></div>
				<div id="customer">
					<textarea id="customer-title">Invoice To, 
<?= $result['buyer_name']; ?></textarea>
					<table id="meta">
						<tr>
							<td class="meta-head">Invoice #</td>
							<td><textarea>EGHNA<?= $result['order_id']; ?></textarea></td>
						</tr>
						<tr>

							<td class="meta-head">Order Date</td>
							<td><textarea id=""><?= $fm->formatDate($result['order_date']); ?></textarea></td>
						</tr>
						<tr>
							<td class="meta-head">Amount Due</td>
							<td><div class="due"><?php
						$total = $result['due_amount'] + 60;
					?>TK.<?= $total; ?></div></td>
						</tr>
					</table>
				</div>
				<table id="items">
				<tr>
					<th>Item</th>
					<th>Description</th>
					<th>Unit Cost</th>
					<th>Quantity</th>
					<th>Price</th>
				</tr>
				
				<tr class="item-row">
					<td class="item-name"><div class="delete-wpr"><textarea><?= $result['product_title']; ?></textarea></div></td>
					<?php
						$id = $result['product_id'];
						$getProd = $order->getProByOrderId($id);
						if ($getProd) {
							while ($results = $getProd->fetch_assoc()) {
						
					?>
					<td class="description"><textarea><?= substr($results['product_desc'], 0, 65) ?></textarea></td>
					<td style="width:80px;"><textarea class="cost"><?= $results['new_price']; ?></textarea></td>
					<?php } } ?>
					<td style="width:80px;"><textarea class="qty"><?= $result['product_qty']; ?></textarea></td>
					<td style="width:100px;"><span class="price">TK.<?= $result['due_amount']; ?></span></td>
				</tr>
				
				
				<tr id="hiderow">
					<td colspan="5"><a id="addrow" href="javascript:;" title="Add Poduct to invoice">+ Add Poduct to invoice</a></td>
				</tr>
				
				<tr>
					<td colspan="2" class="blank"> </td>
					<td colspan="2" class="total-line">Subtotal</td>
					<td class="total-value"><div id="subtotal">TK.<?= $result['due_amount']; ?></div></td>
				</tr>
				<tr>

					<td colspan="2" class="blank"> </td>
					<td colspan="2" class="total-line">Total (Including Service Charge)</td>
					<td class="total-value"><div id="total"><?php
						$total = $result['due_amount'] + 60;
					?>TK.<?= $total; ?></div></td>
				</tr>
				<tr>
					<td colspan="2" class="blank"> </td>
					<td colspan="2" class="total-line">Amount Paid</td>

					<td class="total-value"><textarea id="paid">0.00</textarea></td>
				</tr>
				<tr>
					<td colspan="2" class="blank"> </td>
					<td colspan="2" class="total-line balance">Balance Due</td>
					<td class="total-value balance"><div class="due">TK.<?= $total; ?></div></td>
				</tr>
				
				</table>
				<div id="terms">
				<h5>Terms</h5>
					<textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
				</div>
				<?php } } ?>
			</div>
		</div>
	</div>
</body>

</html>