<?php 
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	class Customer{
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function customerRegistration($data, $file){
			$name 			= $this->fm->validation($data['first_name'] .' '. $data['last_name']);
			$address 		= $this->fm->validation($data['address']);
			$city 			= $this->fm->validation($data['city']);
			$zip 			= $this->fm->validation($data['code']);
			$phone 			= $this->fm->validation($data['phone']);
			$email 			= $this->fm->validation($data['email']);
			$pass 			= $this->fm->validation($data['password']);
			$username 		= $this->fm->validation($data['username']);
			$bio 		    = $this->fm->validation($data['special_note']);

			$name 	= mysqli_real_escape_string($this->db->link, $name);
			$address= mysqli_real_escape_string($this->db->link, $address);
			$city 	= mysqli_real_escape_string($this->db->link, $city);
			$zip 	= mysqli_real_escape_string($this->db->link, $zip);
			$phone 	= mysqli_real_escape_string($this->db->link, $phone);
			$email 	= mysqli_real_escape_string($this->db->link, $email);
			$pass 	= mysqli_real_escape_string($this->db->link, $pass);
			$username = mysqli_real_escape_string($this->db->link, $username);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

			if ($username == "" || $name == "" || $address == "" || $city == "" || $zip == "" || $phone == "" || $email == "" || $pass == "") {
		    	$msg = "<span class='error'>Fields must not be empty !</span>";
				return $msg;
		    }elseif ($file_size >1048567) {
			     echo "<span class='error'>Image Size should be less then 1MB!
			     </span>";
		    } elseif (in_array($file_ext, $permited) === false) {
			     echo "<span class='error'>You can upload only:-"
			     .implode(', ', $permited)."</span>";
		    }
		    $mailquery = "SELECT * FROM customers WHERE email_address = '$email' LIMIT 1";
		    $mailchk = $this->db->select($mailquery);
		    if ($mailchk != false) {
		    	$msg = "<span class='error'>Email already exist !</span>";
				return $msg;
		    } else {
				move_uploaded_file($file_temp, $uploaded_image);
		    	$query = "INSERT INTO customers(username, email_address, password, full_name, phone, billing_address, profile_img, profile_bio, city_town, postcode) VALUES('$username', '$email', '$pass', '$name', '$phone', '$address', '$uploaded_image', '$bio', '$city', '$zip')";
		    	$inserted_row = $this->db->insert($query);
		    	if ($inserted_row) {
		    		$msg = "<span class='success'>Registration Completed Successfully !</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Unable to complete registration! </span>";
					return $msg;
				}
		    }
		}

		/************************** */
		public function CustomerRequest($cmrId, $data, $file){
			$name  = $this->fm->validation($data['name']);
			$email = $this->fm->validation($data['email']);
			$phone = $this->fm->validation($data['ContactNumber']);
			$address  = $this->fm->validation($data['req_address']);
			$details  = $this->fm->validation($data['details']);

			$name 	    = mysqli_real_escape_string($this->db->link, $name);
			$email 			= mysqli_real_escape_string($this->db->link, $email);
			$address 		= mysqli_real_escape_string($this->db->link, $address);
			$phone 	= mysqli_real_escape_string($this->db->link, $phone);
			$details   = mysqli_real_escape_string($this->db->link, $details);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

			if ($name == "" || $address == "" || $phone == "" || $file_name == "" ) {
		    	$msg = "<span class='error'>Request field must not be empty !</span>";
				return $msg;
		    } elseif ($file_size >3048567) {
			     echo "<span class='error'>Image Size should be less then 3MB!
			     </span>";
		    } elseif (in_array($file_ext, $permited) === false) {
			     echo "<span class='error'>You can upload only:-"
			     .implode(', ', $permited)."</span>";
		    } else {
		    	move_uploaded_file($file_temp, $uploaded_image);
		    	$query = "INSERT INTO design_requests(customer_id, req_name, req_email, req_phone, req_details, req_date, req_image, req_address) VALUES ('$cmrId', '$name', '$email', '$phone', '$details', NOW(), '$uploaded_image', '$address')";
		    	$inserted_row = $this->db->insert($query);
		    	if ($inserted_row) {
		    		$msg = "<span class='success'>Request Submited Successfully.</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Request Not Submited.</span>";
					return $msg;
				}
		    }

		}
		/************************** */
		public function getRequests($cmrId){
			$query 	= "SELECT * FROM design_requests WHERE customer_id = '$cmrId' ORDER BY req_date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function customerLogin($data){
			$email 			= $this->fm->validation($data['email']);
			$pass 			= $this->fm->validation($data['pass']);

			$email 	= mysqli_real_escape_string($this->db->link, $email);
			$pass 	= mysqli_real_escape_string($this->db->link, $pass);
			if (empty($email) || empty($pass)) {
				$msg = "<span class='error'>Fields must not be empty !</span>";
				return $msg;
			}

			$query = "SELECT * FROM customers WHERE email_address = '$email' AND password = '$pass'";
			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set("custlogin", true);
				Session::set("cmrId", $value['id']);
				Session::set("cmrName", $value['full_name']);
				echo "<script>window.open('cart.php','_SELF')</script>";
			} else {
				$msg = "<span class='error'>Email or Password not matched.</span>";
				return $msg;
			}
		}
		public function changePass($data, $id){
			$pass 			= $this->fm->validation($data['pass']);
			$new_pass 		= $this->fm->validation($data['new_pass']);

			$pass 	= mysqli_real_escape_string($this->db->link, $pass);
			$new_pass 	= mysqli_real_escape_string($this->db->link, $new_pass);
			
			if (empty($pass) || empty($new_pass)) {
				$msg = "<span class='error'>Password can't be empty !</span>";
				return $msg;
			} 
			$query = "SELECT * FROM customers WHERE id = '$id' AND password = '$pass'";
			$result = $this->db->select($query);
				if ($result != false) {
					$query = "UPDATE customers SET password = '$new_pass' WHERE id = '$id'";
					$updated_row = $this->db->update($query);
					if ($updated_row) {
						$msg = "<span class='success'>Password Changed Successfully.</span>";
						return $msg;
					} else {
						$msg = "<span class='error'>Unable change your password</span>";
						return $msg;
					}
				} else {
					$msg = "<span class='error'>The current password you entered is a wrong password</span>";
					return $msg;
				}
		}

		public function getCustomerData($id){
			$query 	= "SELECT * FROM customers WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function customerUpdate($data, $id){
			$name 			= $this->fm->validation($data['full_name']);
			$address 		= $this->fm->validation($data['billing_address']);
			$city 			= $this->fm->validation($data['city']);
			$zip 			= $this->fm->validation($data['postcode']);
			$phone 			= $this->fm->validation($data['phone']);
			$email 			= $this->fm->validation($data['email_address']);
			$username 		= $this->fm->validation($data['username']);
			$bio 		    = $this->fm->validation($data['profile_bio']);

			$name 	= mysqli_real_escape_string($this->db->link, $name);
			$address= mysqli_real_escape_string($this->db->link, $address);
			$city 	= mysqli_real_escape_string($this->db->link, $city);
			$zip 	= mysqli_real_escape_string($this->db->link, $zip);
			$phone 	= mysqli_real_escape_string($this->db->link, $phone);
			$email 	= mysqli_real_escape_string($this->db->link, $email);
			$username = mysqli_real_escape_string($this->db->link, $username);

			if ($name == "" || $address == "" || $city == "" || $zip == "" || $phone == "" || $email == "" ) {
		    	$msg = "<span class='error'>Fields must not be empty !</span>";
				return $msg;
		    } else {
		    	$query = "UPDATE customers
						SET
						username       = '$username',
						email_address  = '$email',
						full_name 	   = '$name',
						phone          = '$phone',
						billing_address= '$address',
						profile_bio    = '$bio',
						city_town 	   = '$city',
						postcode 	   = '$zip'
						WHERE id = '$id'";
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					$msg = "<span class='success'>Account Details Updated Successfully.</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Customer Data not Updated.</span>";
					return $msg;
				}
		    }
		}
	} 
	
?>