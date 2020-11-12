<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
	include_once ($filepath.'/../lib/Session.php');
	Session::checkLogin();
?>

<?php
	class Adminlogin{
		private $db;
		private $fm;
		
		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function adminLogin($adminEmail, $adminPass){
			$adminEmail = $this->fm->validation($adminEmail);
			$adminPass = $this->fm->validation($adminPass);

			$adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

			if (empty($adminEmail) || empty($adminPass)) {
				$loginmsg = "Email or Password must not be empty !";
				return $loginmsg;
			} else {
				$query = "SELECT * FROM admins WHERE email = '$adminEmail' AND admin_pass = '$adminPass'";
				$result = $this->db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					Session::set("adminLogin", true);
					Session::set("adminId", $value['id']);
					Session::set("adminUser", $value['username']);
					Session::set("adminEmail", $value['email']);
					header("Location: index.php");
				} else {
					$loginmsg = "Username or Password not match !";
					return $loginmsg;
				}
			}
		}

		public function adminInfo($id){
			$query 	= "SELECT * FROM admins WHERE id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>