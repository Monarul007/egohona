<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	class General{

		private $db;
		private $fm;
		
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function logoUpdate($data, $file, $id){
			$logoTitle 	= $this->fm->validation($data['logoTitle']);

			$logoTitle 	= mysqli_real_escape_string($this->db->link, $logoTitle);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['logoImage']['name'];
		    $file_size = $file['logoImage']['size'];
		    $file_temp = $file['logoImage']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;
		    
			if(empty($file_name)){
				$msg = "<span class='error'>Logo image field must not be empty !</span>";
				return $msg;
		    } else {
		    	if (!empty($file_name)) {
				    if ($file_size >2048567) {
					     echo "<span class='error'>Image Size should be more than 2MB!
					     </span>";
				    } elseif (in_array($file_ext, $permited) === false) {
					     echo "<span class='error'>You can upload only:-"
					     .implode(', ', $permited)."</span>";
				    } else {
						move_uploaded_file($file_temp, $uploaded_image);
				    	$query = "UPDATE logo
									SET
									logo_image  = '$uploaded_image',
									logo_title  = '$logoTitle'
									WHERE id = '$id' ";

				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span class='success'>Logo Updated Successfully.</span>";
							return $msg;
						} else {
							$msg = "<span class='error'>Logo not Updated.</span>";
							return $msg;
						}
				    }
				} else {
			    	$query = "UPDATE logo
									SET
									logo_image  = '$$uploaded_image',
									logo_title  = '$logoTitle'
									WHERE id = '$id' ";

			    	$updated_row = $this->db->update($query);
			    	if ($updated_row) {
			    		$msg = "<span class='success'>Logo Updated Successfully.</span>";
						return $msg;
					} else {
						$msg = "<span class='error'>Logo not Updated.</span>";
						return $msg;
					}
				}
			}

		}
		public function ProImgUpdate($file, $id){

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['admin_image']['name'];
		    $file_size = $file['admin_image']['size'];
		    $file_temp = $file['admin_image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;
		    
			if(empty($file_name)){
				$msg = "<span class='error'>Profile image field must not be empty !</span>";
				return $msg;
		    } else {
		    	if (!empty($file_name)) {
				    if ($file_size >2048567) {
					     echo "<span class='error'>Image Size should be more than 2MB!
					     </span>";
				    } elseif (in_array($file_ext, $permited) === false) {
					     echo "<span class='error'>You can upload only:-"
					     .implode(', ', $permited)."</span>";
				    } else {
						move_uploaded_file($file_temp, $uploaded_image);
				    	$query = "UPDATE admins
									SET
									admin_image  = '$uploaded_image'
									WHERE id = '$id' ";

				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span class='success'>Image Updated Successfully.</span>";
							return $msg;
						} else {
							$msg = "<span class='error'>Image not Updated.</span>";
							return $msg;
						}
				    }
				} else {
			    	$query = "UPDATE admins
									SET
									admin_image  = '$uploaded_image'
									WHERE id = '$id' ";

			    	$updated_row = $this->db->update($query);
			    	if ($updated_row) {
			    		$msg = "<span class='success'>Image Updated Successfully.</span>";
						return $msg;
					} else {
						$msg = "<span class='error'>Image not Updated.</span>";
						return $msg;
					}
				}
			}

		}

		public function adminPassUpdate($id, $adminPass){
			$adminPass = $this->fm->validation($adminPass);
			$adminPass = mysqli_real_escape_string($this->db->link, md5($adminPass));

			if (empty($adminPass)){
				$msg = "<span class='error'>Paasword field must not be empty !</span>";
				return $msg;
			} else {
				$query = "UPDATE admins SET admin_pass = '$adminPass' WHERE id = '$id'";
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					$msg = "<span class='success'>Password Updated Successfully.</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Unable to update password</span>";
					return $msg;
				}
			}
		}
		
		public function getLogo(){
			$query = "SELECT * FROM logo ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function getOrdersById($id){
			$query = "SELECT * FROM orders WHERE order_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLogoById($id){
			$query = "SELECT * FROM logo WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getProByOrderId($id){
			$query = "SELECT * FROM products WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>