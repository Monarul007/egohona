<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	class Banner{

		private $db;
		private $fm;
		
		function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function bannerInsert($data, $file){
			$bannerType 	= $this->fm->validation($data['bannerType']);
			$bannerText     = $this->fm->validation($data['bannerText']);

			$bannerType 	= mysqli_real_escape_string($this->db->link, $bannerType);
			$bannerText     = mysqli_real_escape_string($this->db->link, $bannerText);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['bannerImage']['name'];
		    $file_size = $file['bannerImage']['size'];
		    $file_temp = $file['bannerImage']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

		    if ($bannerType == "" || $file_name == "" ) {
		    	$msg = "<span class='error'>Banner field must not be empty !</span>";
				return $msg;
		    } elseif ($file_size >1048567) {
			     echo "<span class='error'>Image Size should be less then 1MB!
			     </span>";
		    } elseif (in_array($file_ext, $permited) === false) {
			     echo "<span class='error'>You can upload only:-"
			     .implode(', ', $permited)."</span>";
		    } else {
		    	move_uploaded_file($file_temp, $uploaded_image);
		    	$query = "INSERT INTO banners(banner_type, banner_image, banner_title) VALUES ('$bannerType', '$uploaded_image', '$bannerText')";
		    	$inserted_row = $this->db->insert($query);
		    	if ($inserted_row) {
		    		$msg = "<span class='success'>Banner Inserted Successfully.</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Banner not Inserted.</span>";
					return $msg;
				}
		    }
		}
		public function bannerUpdate($data, $file, $id){
			$bannerType 	= $this->fm->validation($data['bannerType']);
			$bannerText     = $this->fm->validation($data['bannerText']);

			$bannerType 	= mysqli_real_escape_string($this->db->link, $bannerType);
			$bannerText     = mysqli_real_escape_string($this->db->link, $bannerText);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['bannerImage']['name'];
		    $file_size = $file['bannerImage']['size'];
		    $file_temp = $file['bannerImage']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;
		    
			if(empty($file_name)){
				$msg = "<span class='error'>Banner image field must not be empty !</span>";
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
				    	$query = "UPDATE banners
									SET
									banner_type   = '$bannerType',
									banner_image  = '$uploaded_image',
									banner_title  = '$bannerText'
									WHERE id = '$id' ";

				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span class='success'>Banner Updated Successfully.</span>";
							return $msg;
						} else {
							$msg = "<span class='error'>Banner not Updated.</span>";
							return $msg;
						}
				    }
				} else {
			    	$query = "UPDATE banners
									SET
									banner_type   = '$bannerType',
									banner_image  = '$uploaded_image',
									banner_title  = '$bannerText'
									WHERE id = '$id' ";

			    	$updated_row = $this->db->update($query);
			    	if ($updated_row) {
			    		$msg = "<span class='success'>Banner Updated Successfully.</span>";
						return $msg;
					} else {
						$msg = "<span class='error'>Banner not Updated.</span>";
						return $msg;
					}
				}
			}

		}
		
		public function getAllBanners(){
			$query = "SELECT * FROM banners ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function getBannerById($id){
			$query = "SELECT * FROM banners WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function delBannerById($id){
			$query = "SELECT * FROM banners WHERE id = '$id'";
			$getData = $this->db->select($query);
			if ($getData) {
				while ($dellImg = $getData->fetch_assoc()) {
					$dellink = $dellImg['sliderImg'];
					unlink($dellink);
				}
			}

			$delquery = "DELETE FROM banners WHERE id = '$id'";
			$deldata = $this->db->delete($delquery);
			if ($deldata) {
				$msg = "<span class='success'>Banner Deleted Successfully.</span>";
					return $msg;
			} else {
				$msg = "<span class='error'>Banner not Deleted.</span>";
					return $msg;
			}
		}
	}
?>