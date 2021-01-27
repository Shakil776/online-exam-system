<?php include 'inc/header.php'; ?>
<?php Session::checkLogin(); ?>

<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['regsubmit'])) {
    $userRegi = $user->userRegistration($_POST);
  }
?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h2>User Registration</h2>
  </div>
  <div class="panel-body">
    <div style="max-width: 600px; margin: 0 auto;">
      <?php 
        if (isset($userRegi)) {
          echo $userRegi;
        }
      ?>
      <form action="" method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="userFullName" class="form-control" id="name" placeholder="Enter Full Name">
        </div>
        <div class="form-group">
          <label for="username">User Name</label>
          <input type="text" name="userName" class="form-control" id="username" placeholder="Enter User Name">
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" name="userEmail" class="form-control" id="email" placeholder="Enter Email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="userPass" class="form-control" id="password" placeholder="Enter Password">
        </div>
        <button name="regsubmit" type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </div>
</div>

<?php
  include 'inc/footer.php'; 
?>