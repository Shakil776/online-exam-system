<?php 
	include_once 'inc/header.php';
	include_once '../classes/Exam.php';

	$exam = new Exam();
?>

<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']))  {
		$addQues = $exam->addQuestion($_POST);
	}
	// Total question count
	$totalQues = $exam->getTotalQuestionByCount();
	$nextQues = $totalQues+1;
 ?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Add Question</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

	<div class="row">
	    <div class="col-lg-12">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
					<?php 
						if (isset($addQues)) {
							echo $addQues;
						}
					 ?>
	        	</div>
	            <div class="panel-body">

					<div class="row">
					    <div class="col-lg-12">
					        <form class="form-horizontal" action="" method="POST" style="width: 80%; margin: 0 auto">

							  <div class="form-group">
							    <label class="control-label col-sm-3" for="quesNo">Question Number:</label>
							    <div class="col-sm-9">
							      <input type="number" name="quesNo" class="form-control" id="quesNo" value="<?php if(isset($nextQues)){echo $nextQues;} ?>" required="">
							    </div>
							  </div>

							  <div class="form-group">
							    <label class="control-label col-sm-3" for="question">Question:</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control" id="question" name="question" placeholder="Enter Question.." autocomplete="off" required="">
							    </div>
							  </div>

							  <div class="form-group">
							    <label class="control-label col-sm-3" for="ans1">Choice One:</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control" id="ans1" name="ans1" placeholder="Enter Choice One.." autocomplete="off" required="">
							    </div>
							  </div>

							  <div class="form-group">
							    <label class="control-label col-sm-3" for="ans2">Choice Two:</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control" id="ans2" name="ans2" placeholder="Enter Choice Two.." autocomplete="off" required="">
							    </div>
							  </div>

							  <div class="form-group">
							    <label class="control-label col-sm-3" for="ans3">Choice Three:</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control" id="ans3" name="ans3" placeholder="Enter Choice Three.." autocomplete="off" required="">
							    </div>
							  </div>

							  <div class="form-group">
							    <label class="control-label col-sm-3" for="ans4">Choice Four:</label>
							    <div class="col-sm-9">
							      <input type="text" class="form-control" id="ans4" name="ans4" placeholder="Enter Choice Four.." autocomplete="off" required="">
							    </div>
							  </div>

							  <div class="form-group">
							    <label class="control-label col-sm-3" for="rightAns">Right Answer:</label>
							    <div class="col-sm-9">
							      <input type="number" class="form-control" id="rightAns" name="rightAns" autocomplete="off" required="" placeholder="Enter right answer in numeric form..">
							    </div>
							  </div>
							  
							  <div class="form-group"> 
							    <div class="col-sm-offset-3 col-sm-9">
							      <input type="submit" class="btn btn-primary" name="submit" value="Add Question">
							    </div>
							  </div>
							</form>
					    </div>
					    <!-- /.col-lg-6 -->
					</div>
					<!-- /.row  -->
	            </div>
	            <!-- /.panel-body -->
	        </div>
	        <!-- /.panel -->
	    </div>
	    <!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
</div>
	<!-- /.row -->
</div>

<?php include 'inc/footer.php'; ?>


   