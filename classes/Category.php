<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php

	class Category{
		private $db;
		private $fm;
		
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function catInsert($catName, $parentCat, $CatDesc){
			$catName = $this->fm->validation($catName);
			$parentCat = $this->fm->validation($parentCat);

			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$parentCat = mysqli_real_escape_string($this->db->link, $parentCat);
			if (empty($catName)) {
				$msg = "<span style='color: red;'>Category field must not be empty !</span>";
				return $msg;
			} else {
				$query = "INSERT INTO categories (parent_id, cat_name, cat_desc) VALUES('$parentCat', '$catName', '$CatDesc')";
				$catinsert = $this->db->insert($query);
				if ($catinsert) {
					$msg = "<span style='color: green;'>Category Created Successfully !</span>";
					return $msg;
				} else {
					$msg = "<span style='color: red;'>Unable to create category.</span>";
					return $msg;
				}
			}
		}

		public function getAllCat(){
			$query = "SELECT * FROM categories ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCatById($id){
			$query = "SELECT * FROM categories WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getParentCat(){
			$query = "SELECT * FROM categories WHERE parent_id = '0'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getRings(){
			$query = "SELECT * FROM categories WHERE parent_id = '13'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getEarrings(){
			$query = "SELECT * FROM categories WHERE parent_id = '18'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getBracelts(){
			$query = "SELECT * FROM categories WHERE parent_id = '23'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getCatDesc($cat_desc){
			$query = "SELECT * FROM categories WHERE id = '$id' AND cat_desc = '$cat_desc' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function catUpdate($catName, $id, $parentCat, $cat_desc){
			$catName = $this->fm->validation($catName);
			$cat_desc = $this->fm->validation($cat_desc);

			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$cat_desc = mysqli_real_escape_string($this->db->link, $cat_desc);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if (empty($catName) || empty($cat_desc)) {
				$msg = "<span style='color:red;'>Category Fields can't be empty!</span>";
				return $msg;
			} else {
				$query = "UPDATE categories SET cat_name = '$catName', parent_id = '$parentCat', cat_desc = '$cat_desc' WHERE id = '$id'";
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					$msg = "<span style='color: green;'>Category Updated Successfully.</span>";
					return $msg;
				} else {
					$msg = "<span style='color: red;'>Category not Updated.</span>";
					return $msg;
				}
			}
		}

		public function delCatById($id){
			$query = "DELETE FROM categories WHERE id = '$id'";
			$deldata = $this->db->delete($query);
			if ($deldata) {
				$msg = "<span class='success'>Category Deleted Successfully.</span>";
					return $msg;
			} else {
				$msg = "<span style='color: red;'>Category not Deleted.</span>";
					return $msg;
			}
		}

	}
?>
