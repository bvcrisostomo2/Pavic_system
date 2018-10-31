<?php
include 'php/admin_session.php';

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 1:
      $message = 'Profile editted.';
      break;
    case 2:
      $message = 'Password changed.';
      break;
    default:
      # code...
      break;
  }
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>My Account - PAVIC</title>

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
            <li class="active"><a href="#">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">My Account</h1>
          <?php if(isset($message)){ ?>
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <?php echo $message ?>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
              <div class="text-center">
                <?php if (isset($admin_info['id_picture'])) { ?>
                  <img src="<?php echo "data:image/png;base64, ".base64_encode($admin_info['id_picture']); ?>" alt="" class="img-rounded avatar" width="30%">
                  <?php }else{ ?>
                    <img src="../img/default_avatar.png" class="img-rounded avatar" width="30%"/>
                    <?php } ?>
                    <br><br>
                    <a href="edit-account.php" class="btn btn-primary hundred-with">Edit Account</a>
              </div>
              <table class="table smaller-text">
                <tbody>
                  <tr>
                    <th>
                      <small>First Name:</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['first_name']; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>Middle Name:</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['middle_name']; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>Last Name:</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['last_name']; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>Email:</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['email']; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>Phone:</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['phone']; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>Address Line 1</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['address_line1']; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>Address Line 2</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['address_line2']; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>City</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['city']; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>Region:</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['region']; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>Head:</small>
                    </th>
                    <td>
                      <small><?php echo $admin_info['head']? "Yes": "No"; ?></small>
                    </td>
                  </tr>
                  <tr>
                    <th>
                      <small>Password:</small>
                    </th>
                    <td>
                      <small><a href="change-password.php">Change Password</a></small>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
