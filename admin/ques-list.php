<?php 
	include_once 'inc/header.php';
	include_once '../classes/Exam.php';
 
	$exam = new Exam();
?>
<?php 
	if (isset($_GET['del'])) {
		$delId = (int)$_GET['del'];
		$delQues = $exam->deleteQues($delId);
	}
 ?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Question List</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

	<div class="row">
	    <div class="col-lg-12">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
					<?php 
			            if(isset($delQues)) {
			            	echo $delQues;
			            } 
			        ?>
	        	</div>
	            <div class="panel-body">
	                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	                    <thead>
	                        <tr>
	                            <th width="10%">Sl. No.</th>
	                            <th width="70%">Question</th>
	                            <th width="20%">Action</th>
	                        </tr>
	                    </thead>

				<?php 
					$getQues = $exam->getAllQues();
					if ($getQues) {
						$i=0;
						while ($result = $getQues->fetch_assoc()) {
							$i++;	
				 ?>
	                    <tbody>
	                        <tr class="odd gradeX">
	                            <td><?php echo $i; ?></td>
	                            <td><?php echo $result['question']; ?></td>
	                            <td class="text-center">
	                            	<a class="btn btn-danger" onclick="return confirm('Are you sure to Remove?');" href="?del=<?php echo $result['quesNo']; ?>">Remove</a>
	                            </td>
	                        </tr>
	                    </tbody>
	            <?php } } ?>
	                </table>

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


   