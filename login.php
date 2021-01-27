<?php include 'inc/header.php'; ?>
<?php Session::checkLogin(); ?>

<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $usrLogin = $user->userLogin($_POST);
  }
?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h2>User Login</h2>
  </div>
  <div class="panel-body">
    <div style="max-width: 600px; margin: 0 auto;">
      <?php 
        if (isset($usrLogin)) {
          echo $usrLogin;
        }
      ?>
      <form action="" method="post">
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="text" class="form-control" name="userEmail" id="email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="userPass" id="password">
        </div>
        <button type="submit" class="btn btn-success" name="login">Login</button>
      </form>
    </div>
  </div>
</div>

<?php
  include 'inc/footer.php'; 
?>