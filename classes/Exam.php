<?php 
	include_once '../lib/Database.php';
	include_once '../lib/Session.php';
	include_once '../helpers/Format.php';

	class Exam {
		private $db;
		private $fm;
		
		public function __construct() {
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function addQuestion($data) {
			$quesNo     = $this->fm->validation($data['quesNo']);
			$question   = $this->fm->validation($data['question']);
			$answers = array();
			$answers[1]   = $this->fm->validation($data['ans1']);
			$answers[2]   = $this->fm->validation($data['ans2']);
			$answers[3]   = $this->fm->validation($data['ans3']);
			$answers[4]   = $this->fm->validation($data['ans4']);
			$rightAns     = $this->fm->validation($data['rightAns']);

			$quesNo       = mysqli_real_escape_string($this->db->link, $quesNo);
			$question     = mysqli_real_escape_string($this->db->link, $question);
			$answers[1]   = mysqli_real_escape_string($this->db->link, $answers[1]);
			$answers[2]   = mysqli_real_escape_string($this->db->link, $answers[2]);
			$answers[3]   = mysqli_real_escape_string($this->db->link, $answers[3]);
			$answers[4]   = mysqli_real_escape_string($this->db->link, $answers[4]);
			$rightAns     = mysqli_real_escape_string($this->db->link, $rightAns);

			$query = "INSERT INTO tbl_question(quesNo, question) VALUES('$quesNo', '$question')";
			$inserted_row = $this->db->insert($query);
			if ($inserted_row) {
				foreach ($answers as $key => $quesAns) {
					if ($quesAns != '') {
						if ($rightAns == $key) {
							$right_query = "INSERT INTO tbl_answer(quesNo, rightAns, answer) VALUES('$quesNo', '1', '$quesAns')";
						} else {
							$right_query = "INSERT INTO tbl_answer(quesNo, rightAns, answer) VALUES('$quesNo', '0', '$quesAns')";
						}
						$insert_row = $this->db->insert($right_query);
						if ($insert_row) {
							continue;
						} else {
							die('Error..');
						}
					}
				}

				$msg = "<span class='alert alert-success'>Question added Successfully.</span>";
				return $msg;
			}
		}

		public function getAllQues() {
			$query = "SELECT * FROM tbl_question ORDER BY quesNo ASC";
			$result = $this->db->select($query);
			return $result;
		}

		public function deleteQues($delId) {
			$tables = array("tbl_question","tbl_answer");
			foreach ($tables as $table) {
				$query = "DELETE FROM $table WHERE quesNo = '$delId'";
				$deletedQues = $this->db->delete($query);
			}
			if ($deletedQues) {
				$msg = "<span class='alert alert-success'>Question Removed Successfully.</span>";
				return $msg;
			} else {
				$msg = "<span class='alert alert-danger'>Question not Removed.</span>";
				return $msg;
			}
		}

		public function getTotalQuestionByCount() {
			$query = "SELECT * FROM tbl_question";
			$result = $this->db->select($query);
			$total = $result->num_rows;
			return $total;
		}

		public function getQuestion() {
			$query = "SELECT * FROM tbl_question";
			$getQues = $this->db->select($query);
			$result = $getQues->fetch_assoc();
			return $result;
		}

		public function getQuestionNumber($quesNumber) {
			$query = "SELECT * FROM tbl_question WHERE quesNo = '$quesNumber'";
			$getQues = $this->db->select($query);
			$result = $getQues->fetch_assoc();
			return $result;
		}

		public function getAnswer($quesNumber) {
			$query = "SELECT * FROM tbl_answer WHERE quesNo = '$quesNumber'";
			$getAns = $this->db->select($query);
			return $getAns;
		}







	}
 ?>