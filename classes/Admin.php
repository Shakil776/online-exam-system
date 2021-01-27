<?php 
	include_once '../lib/Database.php';
	include_once '../lib/Session.php';
	include_once '../helpers/Format.php';

	class Admin {
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function getAdminData($data) {
			$adminUserName = $this->fm->validation($data['adminUserName']);
			$adminPass     = $this->fm->validation($data['adminPass']);
			$adminUserName = mysqli_real_escape_string($this->db->link, $adminUserName);
			$adminPass     = mysqli_real_escape_string($this->db->link, md5($adminPass));

			if ($adminUserName == '' || $adminPass == '') {
				$errorMsg = "<span class='error'>Field must not be empty!</span>";
				return $errorMsg;
			} else {
				$query = "SELECT * FROM tbl_admin WHERE adminUserName = '$adminUserName' AND adminPass = '$adminPass' ";
				$result = $this->db->select($query);
				if($result != false){
					$value = $result->fetch_assoc();
					Session::init();
					Session::set('adminlogin', true);
					Session::set('adminId', $value['adminId']);
					Session::set('adminUserName', $value['adminUserName']);
					header('Location:index.php'); 
				} else {
					$errorMsg = "<span class='error'>Username or Password does not matched.</span>";
					return $errorMsg;
				}
			}

		}
	}
 ?>