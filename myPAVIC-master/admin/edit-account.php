<?php
include 'php/admin_session.php';

$sql = "SELECT * FROM pavic_regions";

$result = $mysqli->query($sql);

$regions = [];
while($row = $result->fetch_assoc()){
  $regions[] = $row;
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Account - PAVIC</title>

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
          <h1 class="page-header"><a href="account.php">My Account</a> / Edit Account</h1>

          <div class="row">
            <div class="col-xs-offset-3 col-xs-6">
              <form  class="" action="php/do_edit_account.php" method="post" enctype="multipart/form-data">
                <input type="text" name="admin_id" value="<?php echo $admin_id; ?>" hidden>
                <div class="panel panel-primary">
                  <div class="panel-body">
                    <div class="row text-center">
                      <div class="fileinput fileinput-exists text-center" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px;"><img src="<?php echo "data:image/png;base64, ".base64_encode($admin_info['id_picture']); ?>" alt=""></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="id_picture"></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $admin_info['first_name'] ?>" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="middle_name">Middle Name:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $admin_info['middle_name'] ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $admin_info['last_name'] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email address:</label>
                      <input type="email" class="form-control" id="email" name="email" value="<?php echo $admin_info['email'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="mobile_phone">Mobile Phone:</label>
                      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $admin_info['phone'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="address_line1">Address Line 1:</label>
                      <input type="text" class="form-control" id="address_line1" name="address_line1" value="<?php echo $admin_info['address_line1'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="address_line2">Address Line 2:</label>
                      <input type="text" class="form-control" id="address_line2" name="address_line2" value="<?php echo $admin_info['address_line2'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="city">City:</label>
                      <input type="text" class="form-control" id="city" name="city" value="<?php echo $admin_info['city'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="region">Region:</label>
                      <select class="form-control" id="region" name="region" required>
                        <option value="" disabled>Choose Region</option>
                        <?php for ($i=0; $i < sizeof($regions); $i++) { ?>
                        <option value="<?php echo $regions[$i]['region_id'] ?>" <?php echo $admin_info['region'] == $regions[$i]['region_id']? "selected" : ""; ?>><?php echo $regions[$i]['long_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="head">Head:</label>
                      <div class="radio">
                        <label><input type="radio" name="head" value="Yes" <?php echo $admin_info['head']? "checked" : ""; ?> required>Yes</label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="head" value="No" <?php echo $admin_info['head']? "" : "checked"; ?>  required>No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <input type="submit" name="edit_account" value="Save" class="btn btn-primary bttn">
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
