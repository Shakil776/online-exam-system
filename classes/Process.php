<?php 
	include_once '../lib/Database.php';
	include_once '../lib/Session.php';
	include_once '../helpers/Format.php';

	class Process {
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function nextData($data) {
			$selectedAns = $this->fm->validation($data['ans']);
			$number = $this->fm->validation($data['number']);
			$selectedAns = mysqli_real_escape_string($this->db->link, $selectedAns);
			$number = mysqli_real_escape_string($this->db->link, $number);

			$nextNum = $number+1;
			if (!isset($_SESSION['score'])) {
				$_SESSION['score'] = '0';
			}

			$total = $this->getTotal();
			$rightAns = $this->getRightAns($number);
			if ($rightAns == $selectedAns) {
				$_SESSION['score']++;
			}
			if ($number == $total) {
				header("Location:final.php");
				exit();
			} else {
				header("Location:test.php?ques=".$nextNum);
			}
		}

		protected function getTotal() {
			$query = "SELECT * FROM tbl_question";
			$result = $this->db->select($query);
			$total = $result->num_rows;
			return $total;
		}

		protected function getRightAns($number) {
			$query = "SELECT * FROM tbl_answer WHERE quesNo = '$number' AND rightAns = '1'";
			$getData = $this->db->select($query)->fetch_assoc();
			$result = $getData['ansId'];
			return $result;
		}


	}
 ?>