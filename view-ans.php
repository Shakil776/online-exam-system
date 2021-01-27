<?php include 'inc/header.php'; ?>
<?php Session::checkSession(); ?>
<?php 
	$totalQues = $exam->getTotalQuestionByCount();
?>

<div class="panel panel-default">
  <div class="panel-heading">
	<h2 class="text-center">All Questions and answer: <?php echo $totalQues; ?></h2>
  </div>
  <div class="panel-body">

		<table> 
	<?php 
		$allQues = $exam->getAllQues();
		if ($allQues) {
			while ($question = $allQues->fetch_assoc()) {

	 ?>
			<tr>
				<td colspan="2">
					<h2>Question <?php echo  $question['quesNo']; ?>: <?php echo  $question['question']; ?></h2>
				</td>
			</tr>
		<?php 
			$quesNumber = $question['quesNo'];
			$answer = $exam->getAnswer($quesNumber);
			if ($answer) {
				while ($result = $answer->fetch_assoc()) {
		 ?>
			<tr>
				<td>
					<input type="radio"/>
					<?php 
						if ($result['rightAns'] == '1') {
							echo "<span style='color: blue;'>".$result['answer']."</span>"; 
						} else {
							echo $result['answer']; 
						}
					 ?>
				</td>
			</tr>
		<?php } } ?>
	<?php } } ?>

			
		</table>

		<a class="btn btn-primary" style="display: table; margin: 0 auto;" href="starttest.php">Start Again</a>


  </div>
</div>
<?php include 'inc/footer.php'; ?>

		