<?php 
	include_once 'inc/header.php';
	include_once '../classes/User.php';

	$user = new User();
?>
<?php 
	if (isset($_GET['dis'])) {
		$disId = (int)$_GET['dis'];
		$disUser = $user->disableUser($disId);
	}

	if (isset($_GET['ena'])) {
		$enaId = (int)$_GET['ena'];
		$enaUser = $user->enableUser($enaId);
	}

	if (isset($_GET['del'])) {
		$delId = (int)$_GET['del'];
		$delUser = $user->deleteUser($delId);
	}
 ?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Manage Users</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->

	<div class="row">
	    <div class="col-lg-12">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	        		<?php 
			            if(isset($disUser)) {
			            	echo $disUser;
			            } 
			            if (isset($enaUser)) {
			            	echo $enaUser;
			            } 
			            if(isset($delUser)) {
			            	echo $delUser;
			            }
			        ?>
	        	</div>
	            <div class="panel-body">
	                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	                    <thead>
	                        <tr>
	                            <th>Sl. No.</th>
	                            <th>Name</th>
	                            <th>Username</th>
	                            <th>Email</th>
	                            <th>Action</th>
	                        </tr>
	                    </thead>

				<?php 
					$getUser = $user->getAllUsers();
					if ($getUser) {
						$i=0;
						while ($result = $getUser->fetch_assoc()) {
							$i++;	
				 ?>
	                    <tbody>
	                        <tr class="odd gradeX">
	                            <td><?php echo $i; ?></td>
	                            <td><?php echo $result['userFullName']; ?></td>
	                            <td><?php echo $result['userName']; ?></td>
	                            <td><?php echo $result['userEmail']; ?></td>
	                            <td class="text-center">
	                            	<?php if ($result['userStatus'] == '0') { ?>
	                            		<a class="btn btn-warning" onclick="return confirm('Are you sure to Disable?');" href="?dis=<?php echo $result['userId']; ?>">Disable</a>	
	                            	<?php } else { ?>
										<a class="btn btn-success" onclick="return confirm('Are you sure to Enable?');" href="?ena=<?php echo $result['userId']; ?>">Enable</a>
	                            	<?php } ?>
	                            	
	                            	<a class="btn btn-danger" onclick="return confirm('Are you sure to Remove?');" href="?del=<?php echo $result['userId']; ?>">Remove</a>
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


   