<?php 
  include 'inc/header.php';
  Session::checkSession();
?>
<?php  
  if (isset($_GET['userid'])) {
    $userId = (int)$_GET['userid'];
    $sessionId = Session::get("userId");
    if ($userId != $sessionId) {
      header("Location: index.php");
    }
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_pass'])) {
    $updatePass = $user->updatePassword($userId, $_POST);
  }
?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h2>Change Password</h2>
  </div>
  <div class="panel-body">
    <div style="max-width: 600px; margin: 0 auto;">
<?php 
  if (isset($updatePass)) {
    echo $updatePass;
  }
?>
      <form action="" method="POST">
        <div class="form-group">
          <label for="old_pass">Old Password</label>
          <input type="password" name="old_pass" class="form-control" id="old_pass">
        </div>
        <div class="form-group">
          <label for="new_pass">New Password</label>
          <input type="password" name="new_pass" class="form-control" id="new_pass">
        </div>
        <button name="update_pass" type="submit" class="btn btn-info">Update Password</button>
      </form>

    </div>
  </div>
</div>

<?php
  include 'inc/footer.php'; 
?>