<?php 
  include 'inc/header.php';
  Session::checkSession();
  $userid = Session::get('userId');
?>
<?php  
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $updateUser = $user->updateUserData($userid, $_POST);
  }
?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h2>User Profile</h2>
  </div>
 
  <div class="panel-body">
    <div style="max-width: 600px; margin: 0 auto;">
 <?php 
    if (isset($updateUser)) {
      echo $updateUser;
    }
  ?>
  
<?php  
  $userData = $user->getUserById($userid);
  if ($userData) {
    $result = $userData->fetch_assoc();
?>
      <form action="" method="POST">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="userFullName" class="form-control" id="name" value="<?php echo $result['userFullName']; ?>">
        </div>
        <div class="form-group">
          <label for="username">User Name</label>
          <input type="text" name="userName" class="form-control" id="username" value="<?php echo $result['userName']; ?>">
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" name="userEmail" class="form-control" id="email" value="<?php echo $result['userEmail']; ?>">
        </div>

        <button name="update" type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-info" href="change_password.php?userid=<?php echo $result['userId']; ?>">Change Password</a>

      </form>
  <?php } ?>


    </div>
  </div>
</div>

<?php
  include 'inc/footer.php'; 
?>