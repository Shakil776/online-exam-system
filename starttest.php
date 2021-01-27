<?php include 'inc/header.php'; ?>
<?php Session::checkSession(); ?>
<?php 
	$getQues = $exam->getQuestion();
	$totalQues = $exam->getTotalQuestionByCount();
?>

<div class="panel panel-default">
  <div class="panel-heading">
	<h2>Welcome to Online Exam</h2>
  </div>
  <div class="panel-body">
	<h2>Test your knowledge</h2>
	<p>This is multiple choice to test your knowledge.</p>
	<ul>
		<li>Number of Question: <strong><?php echo  $totalQues; ?></strong></li>
		<li>Question Type: <strong>Multiple Choice</strong></li>
		<a class="btn btn-success" href="test.php?ques=<?php echo $getQues['quesNo']; ?>">Start Test</a>
	</ul>
  </div>
</div>
<?php include 'inc/footer.php'; ?>

		