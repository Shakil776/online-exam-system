<?php include 'inc/header.php'; ?>
<?php Session::checkSession(); ?>

<div class="panel panel-default">
  <div class="panel-heading">
	<h2>You are done.</h2>
  </div>
  <div class="panel-body">
  	<h3>Congratulations <strong><?php echo Session::get('userFullName'); ?></strong> ! You have complete your test.</h3>
  	<p>Your score: <strong>
  		<?php 
  			if (isset($_SESSION['score'])) {
  				echo $_SESSION['score'];
  				unset($_SESSION['score']);
  			}
  		 ?>
  	</strong></p>

	<a class="btn btn-info" href="view-ans.php">View Answer</a>
	<a class="btn btn-primary" href="starttest.php">Start Again</a>
  </div>
</div>
<?php include 'inc/footer.php'; ?>

		