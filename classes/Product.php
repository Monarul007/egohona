<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	class Product{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function productInsert($data, $file){
			$pro_title 	    = $this->fm->validation($data['pro_title']);
			$catId 			= $this->fm->validation($data['category']);
			$brandId 		= $this->fm->validation($data['brand']);
			$model 		    = $this->fm->validation($data['model']);
			$old_price 		= $this->fm->validation($data['old_price']);
			$new_price 		= $this->fm->validation($data['new_price']);
			$description 	= $this->fm->validation($data['description']);
			$specification 	= $this->fm->validation($data['specification']);
			$product_type 	= $this->fm->validation($data['product_type']);
			$product_status = $this->fm->validation($data['product_status']);

			$pro_title 	    = mysqli_real_escape_string($this->db->link, $pro_title);
			$catId 			= mysqli_real_escape_string($this->db->link, $catId);
			$brandId 		= mysqli_real_escape_string($this->db->link, $brandId);
			$description 	= mysqli_real_escape_string($this->db->link, $description);
			$new_price 		= mysqli_real_escape_string($this->db->link, $new_price);
			$product_type   = mysqli_real_escape_string($this->db->link, $product_type);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		    if ($pro_title == "" || $catId == "" || $brandId == "" || $description == "" || $new_price == "" || $product_type == "" || $file_name == "" ) {
		    	$msg = "<span class='error'>Product field must not be empty !</span>";
				return $msg;
		    } elseif ($file_size >1048567) {
			     echo "<span class='error'>Image Size should be less then 1MB!
			     </span>";
		    } elseif (in_array($file_ext, $permited) === false) {
			     echo "<span class='error'>You can upload only:-"
			     .implode(', ', $permited)."</span>";
		    } else {
		    	move_uploaded_file($file_temp, $uploaded_image);
		    	$query = "INSERT INTO products(product_title, cat_id, brand_id, regular_price, new_price, product_desc, product_img, product_code, product_spec, product_type, product_status) VALUES ('$pro_title', '$catId', '$brandId', '$old_price', '$new_price', '$description', '$uploaded_image', '$model', '$specification', '$product_type', '$product_status')";
		    	$inserted_row = $this->db->insert($query);
		    	if ($inserted_row) {
		    		$msg = "<span class='success'>Product Inserted Successfully.</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Product not Inserted.</span>";
					return $msg;
				}
		    }
		}

		public function getAllProduct(){
			$query = "SELECT * FROM products ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function getFooterProduct(){
			$query = "SELECT * FROM products ORDER BY id DESC LIMIT 2";
			$result = $this->db->select($query);
			return $result;
		}

		public function getProductById($id){
			$query = "SELECT * FROM products WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function productUpdate($data, $file, $id){
			$pro_title 	    = $this->fm->validation($data['pro_title']);
			$catId 			= $this->fm->validation($data['category']);
			$brandId 		= $this->fm->validation($data['brand']);
			$model 		    = $this->fm->validation($data['model']);
			$old_price 		= $this->fm->validation($data['old_price']);
			$new_price 		= $this->fm->validation($data['new_price']);
			$description 	= $this->fm->validation($data['description']);
			$specification 	= $this->fm->validation($data['specification']);
			$product_type 	= $this->fm->validation($data['product_type']);
			$product_status = $this->fm->validation($data['product_status']);

			$pro_title 	    = mysqli_real_escape_string($this->db->link, $pro_title);
			$catId 			= mysqli_real_escape_string($this->db->link, $catId);
			$brandId 		= mysqli_real_escape_string($this->db->link, $brandId);
			$description 	= mysqli_real_escape_string($this->db->link, $description);
			$new_price 		= mysqli_real_escape_string($this->db->link, $new_price);
			$product_type   = mysqli_real_escape_string($this->db->link, $product_type);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		    if ($pro_title == "" || $catId == "" || $brandId == "" || $description == "" || $new_price == "" || $product_type == "" ) {
		    	$msg = "<span class='error'>Product fields must not be empty !</span>";
				return $msg;
				if(empty($file_name)){
					copy($file_temp, "uploads/".unique_image);
				}
		    } else {
		    	if (!empty($file_name)) {

				    if ($file_size >1048567) {
					     echo "<span class='error'>Image Size should be less then 1MB!
					     </span>";
				    } elseif (in_array($file_ext, $permited) === false) {
					     echo "<span class='error'>You can upload only:-"
					     .implode(', ', $permited)."</span>";
				    } else {
						move_uploaded_file($file_temp, $uploaded_image);
						
						/*
						(product_title, cat_id, brand_id, regular_price, new_price, product_desc, product_img, product_code, product_spec, product_type, product_status) VALUES ('$pro_title', '$catId', '$brandId', '$old_price', '$new_price', '$description', '$uploaded_image', '$model', '$specification', '$product_type', '$product_status')
						*/

				    	$query = "UPDATE products
									SET
									product_title = '$pro_title',
									cat_id 		  = '$catId',
									brand_id 	  = '$brandId',
									regular_price = '$old_price',
									new_price 	  = '$new_price',
									product_desc  = '$description',
									product_img   = '$uploaded_image',
									product_code  = '$model',
									product_spec  = '$specification',
									product_type  = '$product_type',
									product_status= '$product_status'
									WHERE id = '$id' ";

				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span class='success'>Product Updated Successfully.</span>";
							return $msg;
						} else {
							$msg = "<span class='error'>Product not Updated.</span>";
							return $msg;
						}
				    }
				} else {
			    	$query = "UPDATE products
								SET
								product_title = '$pro_title',
								cat_id 		  = '$catId',
								brand_id 	  = '$brandId',
								regular_price = '$old_price',
								new_price 	  = '$new_price',
								product_desc  = '$description',
								product_img   = '$uploaded_image',
								product_code  = '$model',
								product_spec  = '$specification',
								product_type  = '$product_type',
								product_status= '$product_status'
								WHERE id = '$id' ";

			    	$updated_row = $this->db->update($query);
			    	if ($updated_row) {
			    		$msg = "<span class='success'>Product Updated Successfully.</span>";
						return $msg;
					} else {
						$msg = "<span class='error'>Product not Updated.</span>";
						return $msg;
					}
				}
			}

		}

		public function delProuductById($id){
			$query = "SELECT * FROM products WHERE id = '$id'";
			$getData = $this->db->select($query);
			if ($getData) {
				while ($dellImg = $getData->fetch_assoc()) {
					$dellink = $dellImg['image'];
					unlink($dellink);
				}
			}

			$delquery = "DELETE FROM products WHERE id = '$id'";
			$deldata = $this->db->delete($delquery);
			if ($deldata) {
				$msg = "<span class='success'>Product Deleted Successfully.</span>";
					return $msg;
			} else {
				$msg = "<span class='error'>Product not Deleted.</span>";
					return $msg;
			}
		}

		public function getFeaturedProduct(){
			$query = "SELECT * FROM products WHERE product_type = '1' ORDER BY id DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}

		public function getNewProduct(){
			$query = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
			$result = $this->db->select($query);
			return $result;
		}

		public function getSingleProduct($id){
			$query = "SELECT p.*, c.cat_name, b.brand_name
					FROM products AS p, categories AS c, brands AS b
					WHERE P.cat_id = c.id AND p.brand_id = b.id AND p.id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function latestFromRings(){
			$query = "SELECT * FROM products WHERE cat_id = '13' ORDER BY id DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}

		public function getProductByCat($id){
			$catId 			= $this->fm->validation($id);
			$catid 			= mysqli_real_escape_string($this->db->link, $catId);
			$query = "SELECT * FROM products WHERE cat_id = '$catid'";
			$result = $this->db->select($query);
			return $result;
		}
		public function checkPdTable($id){
			$query 	= "SELECT * FROM products WHERE cat_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function insertCompareData($cmprid, $cmrId){
			$cmrId 			= $this->fm->validation($cmrId);
			$productId 		= $this->fm->validation($cmprid);

			$cmrId 		= mysqli_real_escape_string($this->db->link, $cmrId);
			$productId 	= mysqli_real_escape_string($this->db->link, $productId);

			$cquery = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' AND productId = '$productId'";
			$check = $this->db->select($cquery);
			if ($check) {
				$msg = "<span class='error'>Already Added </span>";
				return $msg;
			}

			$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
			$result= $this->db->select($query)->fetch_assoc();
			if ($result) {
				$productId 		= $result['productId'];
				$productName 	= $result['productName'];
				$price 			= $result['price'];
				$image 			= $result['image'];
			$query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";
		    	$inserted_row = $this->db->insert($query);
		    	if ($inserted_row) {
		    		$msg = "<span class='success'>Added ! Check Compare page.</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Not Added !</span>";
					return $msg;
				}
			}
		}

		public function getCompareData($cmrId){
			$query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id";
			$result = $this->db->select($query);
			return $result;
		}

		public function delCompareData($cmrId){
			$query = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId'";
			$result = $this->db->select($query);
			return $result;
		}

		public function saveWishListData($id, $cmrId){
			$cquery = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$id'";
			$check = $this->db->select($cquery);
			if ($check) {
				$msg = "<span class='error'>Already Added </span>";
				return $msg;
			}

			$pquery 	= "SELECT * FROM tbl_product WHERE productId = '$id'";
			$result = $this->db->select($pquery)->fetch_assoc();
			if ($result) {
					$productId 	= $result['productId'];
					$productName= $result['productName'];
					$price 		= $result['price'];
					$image 		= $result['image'];
				$query = "INSERT INTO tbl_wlist(cmrId, productId, productName, price, image) VALUES('$cmrId', '$productId', '$productName', '$price', '$image')";
		    	$inserted_row = $this->db->insert($query);
		    	if ($inserted_row) {
		    		$msg = "<span class='success'>Added ! Check WishList page.</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Not Added !</span>";
					return $msg;
				}
			}
		}

		public function getWListData($cmrId){
			$query = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function delWlistData($cmrId, $productId){
			$query = "DELETE FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$productId'";
			$result = $this->db->delete($query);
			if ($result) {
				$msg = "<span class='success'>Data deleted successfully !.</span>";
					return $msg;
			}
		}

	}
?>