<?php 
	error_reporting(0); 
	include_once 'lib/Session.php';
	Session::init();
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

    spl_autoload_register(function($class_name){
    	include_once "classes/".$class_name.".php";
    });

	$db  = new Database();
	$fm  = new Format();
	$exam  = new Exam();
	$user = new User();
	$process = new Process();
 ?>
<?php
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: pre-check=0, post-check=0, max-age=0"); 
	header("Pragma: no-cache"); 
	header("Expires: Mon, 6 Dec 1977 00:00:00 GMT"); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Online Examination System</title>
  <meta name="description" content="">
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Place favicon.ico in the root directory -->
  <link href="" rel="icon" />
   <!-- bootstrp css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<?php  
    if (isset($_GET['action']) && $_GET['action'] == "logout") {
        Session::destroy();
        header("Location: index.php");
    }
?>

<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">Online Examination System</a>
				</div>
				<ul class="nav navbar-nav pull-right">
					<?php 
						$login = Session::get('login');
						if ($login == true) { ?>

					<li><a href="profile.php">Profile</a></li>
					<li><a href="exam.php">Exam</a></li>
					<li><a href="?action=logout">Logout</a></li>
				<?php } else{ ?>
					<li><a href="index.php">Home</a></li>
					<li><a href="register.php">Register</a></li>
					<li><a href="login.php">Login</a></li>
				<?php } ?>
				</ul>
			</div>
		</nav>