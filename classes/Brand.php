<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	class Brand{

		private $db;
		private $fm;
		
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function brandInsert($brandName, $brandDesc){
			$brandName = $this->fm->validation($brandName);
			$brandDesc = $this->fm->validation($brandDesc);

			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$brandDesc = mysqli_real_escape_string($this->db->link, $brandDesc);
			if (empty($brandName)) {
				$msg = "<span class='error'>Brand field must not be empty !</span>";
				return $msg;
			} else {
				$query = "INSERT INTO brands(brand_name, brand_desc) VALUES ('$brandName', '$brandDesc')";
				$brandinsert = $this->db->insert($query);
				if ($brandinsert) {
					$msg = "<span class='success'>Brand Inserted Successfully.</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Brand not Inserted.</span>";
					return $msg;
				}
			}
		}

		public function getAllBrand(){
			$query = "SELECT * FROM brands ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getBrandById($id){
			$query = "SELECT * FROM brands WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function brandUpdate($brandName, $id, $brandDesc){
			$brandName = $this->fm->validation($brandName);
			$brandDesc = $this->fm->validation($brandDesc);

			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$brandDesc = mysqli_real_escape_string($this->db->link, $brandDesc);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if (empty($brandName) || empty($brandDesc)){
				$msg = "<span style='color:red;'>Brand field must not be empty !</span>";
				return $msg;
			} else {
				$query = "UPDATE brands SET brand_name = '$brandName', brand_desc = '$brandDesc' WHERE id = '$id'";
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					$msg = "<span class='success'>Brand Updated Successfully.</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Brand not Updated.</span>";
					return $msg;
				}
			}
		}

		public function delBrandById($id){
			$query = "DELETE FROM brands WHERE id = '$id'";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				$msg = "<span class='success'>Brand Deleted Successfully.</span>";
					return $msg;
			} else {
				$msg = "<span class='error'>Brand not Deleted.</span>";
					return $msg;
			}
		}
	}
?>