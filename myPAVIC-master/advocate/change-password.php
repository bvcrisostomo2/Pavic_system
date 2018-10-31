<?php
  include 'php/advocate_session.php';


  if (isset($_GET['error']) && $_GET['error'] == 1) {
    $error_message = "The current password is invalid.";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include('includes/links.php'); ?>

    <title>Advocate Edit Profile - PAVIC</title>
  </head>
  <body>
    <?php include('includes/navbar.php'); ?>

    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
      <li class="breadcrumb-item active">Edit Profile</li>
    </ol>

    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="text-center">
            <?php
            if (isset($error_message)) {
              echo "<span style='color:red'>$error_message</span><br><br>";
            }
            ?>
          </div>
          <form  class="" action="php/do_change_password.php" method="post" enctype="multipart/form-data">
            <div class="panel panel-primary">
              <div class="panel-body">
                <div class="form-group">
                  <label for="current_password">Current Password:</label>
                  <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                  <label for="new_password">Password:</label>
                  <input type="password" class="form-control" id="password" name="new_password" required>
                </div>
                <div class="form-group">
                  <label for="address_line1">Confirm New Password:</label>
                  <input type="password" class="form-control" id="confirm_password" name="new_password" required>
                  <span id='message'></span>
                </div>
              </div>
            </div>
            <div class="text-center">
              <input type="submit" name="change_password" value="Change Password" class="btn btn-primary">
              <a class="btn btn-danger bttn" href="profile.php">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
