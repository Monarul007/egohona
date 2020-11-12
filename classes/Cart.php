<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	class Cart{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function addToCart($quantity, $id){
			$quantity 	= $this->fm->validation($quantity);
			$quantity 	= mysqli_real_escape_string($this->db->link, $quantity);
			$productId 	= mysqli_real_escape_string($this->db->link, $id);
			$sId 		= session_id();

			$squery = "SELECT * FROM products WHERE id = '$productId'";
			$result = $this->db->select($squery)->fetch_assoc();

			$productName 	= $result['product_title'];
			$price 			= $result['new_price'];
			$image 			= $result['product_img'];
			$productCode    = $result['product_code'];

			$chquery = "SELECT * FROM cart WHERE product_id = '$productId' AND session_id = '$sId'";
			$getPro = $this->db->select($chquery);
			if ($getPro) {
				echo "<span class='error'>This product already added to cart.</span>";
			} else {

				$query = "INSERT INTO cart(session_id, product_image, product_name, product_price, product_qty, product_id, product_code) VALUES('$sId', '$image', '$productName', '$price', '$quantity', '$productId', '$productCode')";
		    	$inserted_row = $this->db->insert($query);
		    	if ($inserted_row) {
					echo '<span class="success">Product added to cart successfully!</span>
					<script>window.location = "";</script>';
				} else {
					echo "<script>window.location = '404.php';</script>";
				}
			}
		}

		public function getCartProduct(){
			$sId 	= session_id();
			$query 	= "SELECT * FROM cart WHERE session_id = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateCartQuantity($cartId, $quantity){
			$cartId 			= $this->fm->validation($cartId);
			$quantity 			= $this->fm->validation($quantity);

			$cartId 	= mysqli_real_escape_string($this->db->link, $cartId);
			$quantity 	= mysqli_real_escape_string($this->db->link, $quantity);

			$query = "UPDATE cart
						SET
						product_qty = '$quantity'
						WHERE id = '$cartId'";
	    	$updated_row = $this->db->update($query);
	    	if ($updated_row) {
				echo "<span class='success'>Cart Updated Successfully!</span>";
			} else {
				$msg = "<span class='error'>Quantity not Updated.</span>";
				return $msg;
			}
		}

		public function delProductByCart($delId){
			$delId 		= mysqli_real_escape_string($this->db->link, $delId);
			$query 		= "DELETE FROM cart WHERE id = '$delId'";
			$deldata 	= $this->db->delete($query);
			if ($deldata) {
				echo "<script>window.location = 'cart.php'; </script>";
			} else {
				$msg = "<span class='error'>Product not Deleted.</span>";
					return $msg;
			}
		}

		public function checkCartTable(){
			$sId 	= session_id();
			$query 	= "SELECT * FROM cart WHERE session_id = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function items(){
			$sId 	= session_id();
			$get_items = "SELECT * FROM cart WHERE session_id = '$sId'";
			$run_items = mysqli_query($connection,$get_items);
			$count     = mysqli_num_rows($run_items);
			echo $count;
		}

		public function delCustomerCart(){
			$sId = session_id();
			$query = "DELETE FROM cart WHERE session_id = '$sId'";
			$this->db->delete($query);
		}

		public function orderProduct($cmrId){
			$sId 	= session_id();
			$query 	= "SELECT * FROM cart WHERE session_id = '$sId'";
			$getPro = $this->db->select($query);
			if ($getPro) {
				while ($result 	= $getPro->fetch_assoc()) {
					$productId 	= $result['product_id'];
					$productName= $result['product_name'];
					$quantity 	= $result['product_qty'];
					$price 		= $result['product_price'] * $quantity;
					$image 		= $result['product_image'];
				$query = "INSERT INTO orders(customer_id, product_id, product_title, due_amount, product_qty, product_image, order_date) VALUES('$cmrId', '$productId', '$productName', '$price', '$quantity', '$image', NOW())";
		    	$inserted_row = $this->db->insert($query);
				}
			}

		}

		public function orderByGuest($guestID, $data){
			$name 			= $this->fm->validation($data['name']);
			$address 		= $this->fm->validation($data['address']);
			$city 			= $this->fm->validation($data['city']);
			$zip 			= $this->fm->validation($data['code']);
			$phone 			= $this->fm->validation($data['phone']);
			$email 			= $this->fm->validation($data['email']);

			$name 	= mysqli_real_escape_string($this->db->link, $name);
			$address= mysqli_real_escape_string($this->db->link, $address);
			$city 	= mysqli_real_escape_string($this->db->link, $city);
			$zip 	= mysqli_real_escape_string($this->db->link, $zip);
			$phone 	= mysqli_real_escape_string($this->db->link, $phone);
			$email 	= mysqli_real_escape_string($this->db->link, $email);

			if ($name == "" || $address == "" || $phone == "") {
		    	$msg = "<span class='error'>Fields must not be empty !</span>";
				return $msg;
		    }else{
				$query = "INSERT INTO guests(guest_name, guest_phone, guest_email, guest_address, guest_city, guest_postcode) VALUES('$name', '$phone', '$email', '$address', '$city', '$zip')";
		    	$inserted_row = $this->db->insert($query);
			}

			$sId 	= session_id();
			$query 	= "SELECT * FROM cart WHERE session_id = '$sId'";
			$getPro = $this->db->select($query);
			if ($getPro) {
				while ($result 	= $getPro->fetch_assoc()) {
					$productId 	= $result['product_id'];
					$productName= $result['product_name'];
					$quantity 	= $result['product_qty'];
					$price 		= $result['product_price'] * $quantity;
					$image 		= $result['product_image'];
				$query = "INSERT INTO orders(customer_id, product_id, product_title, due_amount, product_qty, product_image, order_date, buyer_email, buyer_name, buyer_phone, buyer_address) VALUES('$guestID', '$productId', '$productName', '$price', '$quantity', '$image', NOW(), '$email', '$name', '$phone', '$address')";
				$inserted_row = $this->db->insert($query);
				}
			}

		}



		/************************** */
		public function ordersProduct($cmrId, $data){
			$name = $this->fm->validation($data['samename']);
			$email = $this->fm->validation($data['sameEmail']);
			$address = $this->fm->validation($data['sameaddress']);
			$phone = $this->fm->validation($data['samephone']);
			$code = $this->fm->validation($data['samecode']);

			$sId 	= session_id();
			$query 	= "SELECT * FROM cart WHERE session_id = '$sId'";
			$getPro = $this->db->select($query);
			if ($getPro) {
				while ($result 	= $getPro->fetch_assoc()) {
					$productId 	= $result['product_id'];
					$productName= $result['product_name'];
					$quantity 	= $result['product_qty'];
					$price 		= $result['product_price'] * $quantity;
					$image 		= $result['product_image'];
				$query = "INSERT INTO orders(customer_id, product_id, product_title, due_amount, product_qty, product_image, order_date, buyer_email, buyer_name, buyer_phone, buyer_address) VALUES('$cmrId', '$productId', '$productName', '$price', '$quantity', '$image', NOW(), '$email', '$name', '$phone', '$address')";
		    	$inserted_row = $this->db->insert($query);
				}
			}

		}
		/************************** */


		public function payableAmount($cmrId){
			$query 	= "SELECT due_amount FROM orders WHERE customer_id = '$cmrId' AND order_date = now()";
			$result = $this->db->select($query);
			return $result;
		}

		public function getOrderProduct($cmrId){
			$query 	= "SELECT * FROM orders WHERE customer_id = '$cmrId' ORDER BY order_date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkOrder($cmrId){
			$query 	= "SELECT * FROM orders WHERE customer_id = '$cmrId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllOrderProduct(){
			$query 	= "SELECT * FROM orders ORDER BY order_date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getPendingOrders(){
			$query 	= "SELECT * FROM orders WHERE order_status = '0' ORDER BY order_date DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function getConfirmedOrders(){
			$query 	= "SELECT * FROM orders WHERE order_status = '1' ORDER BY order_date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function productShifted($id, $date, $price, $prodId){
			$id 			= $this->fm->validation($id);
			$date 			= $this->fm->validation($date);
			$price 			= $this->fm->validation($price);
			$prodId 		= $this->fm->validation($prodId);

			$id 		= mysqli_real_escape_string($this->db->link, $id);
			$date 		= mysqli_real_escape_string($this->db->link, $date);
			$price 		= mysqli_real_escape_string($this->db->link, $price);
			$prodId 	= mysqli_real_escape_string($this->db->link, $prodId);

			$query = "UPDATE orders
					SET
					order_status = '1'
					WHERE customer_id = '$id' AND order_date = '$date' AND product_id = '$prodId'";
	    	$updated_row = $this->db->update($query);
	    	if ($updated_row) {
	    		$msg = "<span class='success'>Updated Successfully.</span>";
				return $msg;
			} else {
				$msg = "<span class='error'>Not Updated !.</span>";
				return $msg;
			}
		} 

		public function delProductShifted($id, $date, $price, $prodId){
			$id 			= $this->fm->validation($id);
			$date 			= $this->fm->validation($date);
			$price 			= $this->fm->validation($price);
			$prodId 		= $this->fm->validation($prodId);

			$id 		= mysqli_real_escape_string($this->db->link, $id);
			$date 		= mysqli_real_escape_string($this->db->link, $date);
			$price 		= mysqli_real_escape_string($this->db->link, $price);
			$prodId 	= mysqli_real_escape_string($this->db->link, $prodId);

			$query 		= "DELETE FROM orders WHERE customer_id = '$id' AND order_date = '$date' AND product_id = '$prodId'";
			$deldata 	= $this->db->delete($query);
			if ($deldata) {
				$msg = "<span class='success'>Data Deleted successfully.</span>";
					return $msg;
			} else {
				$msg = "<span class='error'>Data not Deleted.</span>";
					return $msg;
			}
		}

		public function productShiftConfirm($id, $date, $price, $prodId){
			$id 			= $this->fm->validation($id);
			$date 			= $this->fm->validation($date);
			$price 			= $this->fm->validation($price);
			$prodId 		= $this->fm->validation($prodId);

			$id 		= mysqli_real_escape_string($this->db->link, $id);
			$date 		= mysqli_real_escape_string($this->db->link, $date);
			$price 		= mysqli_real_escape_string($this->db->link, $price);
			$prodId 	= mysqli_real_escape_string($this->db->link, $prodId);

			$query = "UPDATE orders
					SET
					order_status = '2'
					WHERE customer_id = '$id' AND order_date = '$date' AND product_id = '$prodId'";
	    	$updated_row = $this->db->update($query);
	    	if ($updated_row) {
	    		$msg = "<span class='success'>Updated Successfully.</span>";
				return $msg;
			} else {
				$msg = "<span class='error'>Not Updated !.</span>";
				return $msg;
			}
		}

	}
?>