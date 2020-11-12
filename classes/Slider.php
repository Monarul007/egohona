<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
    class Slider{
        private $db;
        private $fm;

        public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

        public function sliderInsert($data, $file){
			$slideTitle   = $this->fm->validation($data['sliderTitle']);
        	$slideType    = $this->fm->validation($data['sliderType']);
        	$slideCaption = $this->fm->validation($data['sliderCap']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['sliderImg']['name'];
		    $file_size = $file['sliderImg']['size'];
		    $file_temp = $file['sliderImg']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/sliders/".$unique_image;

		    if (empty($file_name)) {
		    	$msg = "<span class='error'>Slide image field must not be empty !</span>";
				return $msg;
		    } elseif ($file_size >2048567) {
			     echo "<span class='error'>Image Size should be more than 2MB!
			     </span>";
		    } elseif (in_array($file_ext, $permited) === false) {
			     echo "<span class='error'>You can upload only:-"
			     .implode(', ', $permited)."</span>";
		    } else {
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO sliders(slide_title, slide_type, slide_caption, slide_img) VALUES('$slideTitle', '$slideType', '$slideCaption', '$uploaded_image')";
				$inserted_row = $this->db->insert($query);
				if ($inserted_row) {
					$msg = "<span class='success'>Slide Created Successfully !</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Unable to create slide.</span>";
					return $msg;
				}
			}
		}

		public function sliderUpdate($data, $file, $id){
			$slideTitle   = $this->fm->validation($data['sliderTitle']);
        	$slideType    = $this->fm->validation($data['sliderType']);
        	$slideCaption = $this->fm->validation($data['sliderCap']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['sliderImg']['name'];
		    $file_size = $file['sliderImg']['size'];
		    $file_temp = $file['sliderImg']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/sliders/".$unique_image;

		    
			if(empty($file_name)){
				$msg = "<span class='error'>Slider image field must not be empty !</span>";
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
				    	$query = "UPDATE sliders
									SET
									slide_title   = '$slideTitle',
									slide_type    = '$slideType',
									slide_caption = '$slideCaption',
									slide_img     = '$uploaded_image'
									WHERE id = '$id' ";

				    	$updated_row = $this->db->update($query);
				    	if ($updated_row) {
				    		$msg = "<span class='success'>Slide Updated Successfully.</span>";
							return $msg;
						} else {
							$msg = "<span class='error'>Slide not Updated.</span>";
							return $msg;
						}
				    }
				} else {
			    	$query = "UPDATE sliders
								SET
								slide_title   = '$slideTitle',
								slide_type 	  = '$slideType',
								slide_caption = '$slideCaption',
								slide_img     = '$uploaded_image'
								WHERE id = '$id' ";

			    	$updated_row = $this->db->update($query);
			    	if ($updated_row) {
			    		$msg = "<span class='success'>Slide Updated Successfully.</span>";
						return $msg;
					} else {
						$msg = "<span class='error'>Slide not Updated.</span>";
						return $msg;
					}
				}
			}

		}
		
		public function getAllSliders(){
			$query = "SELECT * FROM sliders ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function getSliderById($id){
			$query = "SELECT * FROM sliders WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function delSliderById($id){
			$query = "SELECT * FROM sliders WHERE id = '$id'";
			$getData = $this->db->select($query);
			if ($getData) {
				while ($dellImg = $getData->fetch_assoc()) {
					$dellink = $dellImg['sliderImg'];
					unlink($dellink);
				}
			}

			$delquery = "DELETE FROM sliders WHERE id = '$id'";
			$deldata = $this->db->delete($delquery);
			if ($deldata) {
				$msg = "<span class='success'>Slide Deleted Successfully.</span>";
					return $msg;
			} else {
				$msg = "<span class='error'>Slide not Deleted.</span>";
					return $msg;
			}
		}
    }
?>