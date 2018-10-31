<?php
include 'php/admin_session.php';


if (isset($_GET['error']) && $_GET['error'] == 1) {
  $error_message = "The current password is invalid.";
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Change Password - PAVIC</title>

    <?php include('includes/links.php'); ?>
  </head>

  <body cz-shortcut-listen="true">

    <?php include 'includes/navbar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="overview.php">Overview</a></li>
            <?php if ($admin_info['head']) { ?>
              <li><a href="administrators.php">Administrators</a></li>
            <?php } ?>
            <li><a href="children.php">Children</a></li>
            <li><a href="advocates.php">Advocates</a></li>
            <li><a href="reports.php">Reports</a></li>
            
            <li><a href="anouncements.php">Announcements</a></li>
            <li class="active"><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><a href="account.php">My Account</a> / Change Password</h1>

          <div class="row">
            <div class="col-xs-offset-3 col-xs-6">
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
                  <input type="submit" name="change_password" value="Change Password" class="btn btn-primary bttn">
                  <a class="btn btn-danger bttn" href="account.php">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include 'includes/admin_modal.php'; ?>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
