<?php 
	include_once '../lib/Database.php';
	include_once '../lib/Session.php';
	include_once '../helpers/Format.php';

	class User {
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}


		public function userRegistration($data) {
			$userFullName  = $this->fm->validation($data['userFullName']);
			$userName   = $this->fm->validation($data['userName']);
			$userEmail  = $this->fm->validation($data['userEmail']);
			$userPass   = $this->fm->validation($data['userPass']);

			$userFullName = mysqli_real_escape_string($this->db->link, $userFullName);
			$userName  = mysqli_real_escape_string($this->db->link, $userName);
			$userEmail = mysqli_real_escape_string($this->db->link, $userEmail);
			$userPass  = mysqli_real_escape_string($this->db->link, md5($userPass));

			if (empty($userFullName) || empty($userName) || empty($userEmail) || empty($userPass)) {
				$msg = "<span class='alert alert-danger'>Field must not be empty.</span>";
				return $msg;
			} elseif(filter_var($userEmail, FILTER_VALIDATE_EMAIL) === false) {
				$msg = "<span class='alert alert-danger'>Invalid email address.</span>";
				return $msg;
			} else {
				$checkEmailQuery = "SELECT * FROM tbl_user WHERE userEmail = '$userEmail'";
				$result = $this->db->select($checkEmailQuery);
				if ($result != false) {
					$msg = "<span class='alert alert-danger'>Email address already exists.</span>";
					return $msg;
				} else{
					$query = "INSERT INTO tbl_user(userFullName, userName, userEmail, userPass) VALUES('$userFullName', '$userName', '$userEmail', '$userPass')";
					$inserted_row = $this->db->insert($query);
					if ($inserted_row) {
						$msg = "<span class='alert alert-success'>User registration Successfully.</span>";
						return $msg;
					} else{
						$msg = "<span class='alert alert-danger'>Error: Not registered.</span>";
						return $msg;
					}
				}
			}
		}


		public function userLogin($data) {
			$userEmail  = $this->fm->validation($data['userEmail']);
			$userPass   = $this->fm->validation($data['userPass']);

			$userEmail = mysqli_real_escape_string($this->db->link, $userEmail);
			$userPass  = mysqli_real_escape_string($this->db->link, md5($userPass));

			if (empty($userEmail) || empty($userPass)) {
				$msg = "<span class='alert alert-danger'>Field must not be empty.</span>";
				return $msg;
			} elseif(filter_var($userEmail, FILTER_VALIDATE_EMAIL) === false) {
				$msg = "<span class='alert alert-danger'>Invalid email address.</span>";
				return $msg;
			} else {
				$query = "SELECT * FROM tbl_user WHERE userEmail = '$userEmail' AND userPass = '$userPass'";
				$result = $this->db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					if ($value['userStatus'] == '1') {
						$msg = "<span class='alert alert-danger'>User ID Disabled.</span>";
						return $msg;
					} else {
						Session::init();
						Session::set('login', true);
						Session::set('userId', $value['userId']);
						Session::set('userFullName', $value['userFullName']);
						Session::set('userName', $value['userName']);
						Session::set('userEmail', $value['userEmail']);
						header('Location:exam.php');
					}
				} else {
					$msg = "<span class='alert alert-danger'>User Email and Password does not matched.</span>";
					return $msg;
				}
			}

		}

		// public function getAdminData($data) {
		// 	$adminUserName = $this->fm->validation($data['adminUserName']);
		// 	$adminPass     = $this->fm->validation($data['adminPass']);
		// 	$adminUserName = mysqli_real_escape_string($this->db->link, $adminUserName);
		// 	$adminPass     = mysqli_real_escape_string($this->db->link, md5($adminPass));

			
		// }

		public function getAllUsers() {
			$query = "SELECT * FROM tbl_user ORDER BY userId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function disableUser($disId) {
			$query = "UPDATE tbl_user
						SET 
						userStatus = '1'
						WHERE userId = '$disId'";
			$updatedUser = $this->db->update($query);
			if ($updatedUser) {
				$msg = "<span class='alert alert-success'>User Disabled Successfully.</span>";
				return $msg;
			} else {
				$msg = $msg = "<span class='alert alert-danger'>User not Disabled.</span>";
				return $msg;
			}
		}

		public function enableUser($enaId) {
			$query = "UPDATE tbl_user
						SET 
						userStatus = '0'
						WHERE userId = '$enaId'";
			$updatedUser = $this->db->update($query);
			if ($updatedUser) {
				$msg = "<span class='alert alert-success'>User Enabled Successfully.</span>";
				return $msg;
			} else {
				$msg = $msg = "<span class='alert alert-danger'>User not Enabled.</span>";
				return $msg;
			}
		}

		public function deleteUser($delId) {
			$query = "DELETE FROM tbl_user WHERE userId = '$delId'";
			$deletedUser = $this->db->delete($query);
			if ($deletedUser) {
				$msg = "<span class='alert alert-success'>User Removed Successfully.</span>";
				return $msg;
			} else {
				$msg = $msg = "<span class='alert alert-danger'>User not Removed.</span>";
				return $msg;
			}
		}

		public function getUserById($userid) {
			$query = "SELECT * FROM tbl_user WHERE userId = '$userid'";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateUserData($userid, $data) {
			$userFullName   = $this->fm->validation($data['userFullName']);
			$userName   = $this->fm->validation($data['userName']);
			$userEmail   = $this->fm->validation($data['userEmail']);

			$userFullName = mysqli_real_escape_string($this->db->link, $userFullName);
			$userName = mysqli_real_escape_string($this->db->link, $userName);
			$userEmail = mysqli_real_escape_string($this->db->link, $userEmail);

			if (empty($userFullName) || empty($userName) || empty($userEmail)) {
				$msg = "<span class='alert alert-danger'>Field must not be empty.</span>";
				return $msg;
			} elseif(filter_var($userEmail, FILTER_VALIDATE_EMAIL) === false) {
				$msg = "<span class='alert alert-danger'>Invalid email address.</span>";
				return $msg;
			} else {
					$query = "UPDATE tbl_user
								SET 
								userFullName = '$userFullName',
								userName = '$userName',
								userEmail = '$userEmail'
								WHERE userId = '$userid'";
					$updated_row = $this->db->update($query);
					if ($updated_row) {
						$msg = "<span class='alert alert-success'>User profile updated Successfully.</span>";
						return $msg;
					} else {
						$msg = $msg = "<span class='alert alert-danger'>User profile not updated.</span>";
						return $msg;
					}
				}
		}


		//Check password
		private function checkPassword($userId, $old_pass){
			$password = md5($old_pass);
			$query = "SELECT userPass FROM tbl_user WHERE userId = '$userId' AND userPass = '$password'";
			$result = $this->db->select($query);
			return $result;
		}

		// Update/change password
		public function updatePassword($userId, $data){
			$old_pass  = $this->fm->validation($data['old_pass']);
			$new_pass  = $this->fm->validation($data['new_pass']);
			$old_pass = mysqli_real_escape_string($this->db->link, $old_pass);
			$new_pass = mysqli_real_escape_string($this->db->link, $new_pass);

			$checkPass = $this->checkPassword($userId, $old_pass);

			if ($old_pass == "" || $new_pass == "") {
				$msg = "<div class='alert alert-danger'><strong> Error! </strong>Field must not be Empty!</div>";
				return $msg;
			}

			if ($checkPass == false) {
				$msg = "<div class='alert alert-danger'><strong> Error! </strong>Old password does not Exist!.</div>";
				return $msg;
			}
			$new_pass = md5($data['new_pass']);
			$query = "UPDATE tbl_user SET 
					userPass = '$new_pass'
					WHERE userId = '$userId'";

			$updated_row = $this->db->update($query);
			
			if ($updated_row) {
				$msg = "<div class='alert alert-success'><strong> Success! </strong>Password updated successfully!</div>";
				return $msg;
			}else{
				$msg = "<div class='alert alert-danger'><strong> Error! </strong>Password not updated.</div>";
				return $msg;
			}
		}




















	}
 ?>