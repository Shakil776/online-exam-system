<?php include 'inc/header.php'; ?>
<?php Session::checkSession(); ?>
<?php 
	if (isset($_GET['ques'])) {
		$quesNumber = $_GET['ques'];
	} else {
		header("Location:exam.php");
	}
	$totalQues = $exam->getTotalQuestionByCount();
	$quesNum = $exam->getQuestionNumber($quesNumber);
 ?>
 <?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['next'])) {
    $next = $process->nextData($_POST);
  }
  // if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['prev'])) {
  //   $prev = $process->prevData($_POST);
  // }
?>

<div class="panel panel-default">
  <div class="panel-heading">
	<h2 class="text-center">Question <?php echo  $quesNum['quesNo']; ?> of <?php echo  $totalQues; ?></h2>
  </div>
  <div class="panel-body">

  	<form method="post">
		<table> 
			<tr>
				<td colspan="2">
					<h2>Question <?php echo  $quesNum['quesNo']; ?>: <?php echo  $quesNum['question']; ?></h2>
				</td>
			</tr>
		<?php 
			$answer = $exam->getAnswer($quesNumber);
			if ($answer) {
				while ($result = $answer->fetch_assoc()) {
		 ?>
			<tr>
				<td><input type="radio" name="ans" value="<?php echo $result['ansId']; ?>" /><?php echo $result['answer']; ?></td>
			</tr>
		<?php } } ?>

			<tr>
				<td>
					<input type="submit" name="prev" value="Prev Question"/>
					<input type="submit" name="next" value="Next Question"/>
					<input type="hidden" name="number" value="<?php echo $quesNumber; ?>" />
				</td>
			</tr>
			
		</table>
	</form>
 
  </div>
</div>


<?php include 'inc/footer.php'; ?>

		