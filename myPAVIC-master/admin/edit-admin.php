<?php
include 'php/admin_session.php';

$sql = "SELECT * FROM pavic_admin WHERE admin_id = ".$_GET['admin_id'].";";

$result = $mysqli->query($sql);

if(isset($result->num_rows)){
  $row = $result->fetch_assoc();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Administrator - PAVIC</title>

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
              <li class="active"><a href="administrators.php">Administrators</a></li>
            <?php } ?>
            <li><a href="children.php">Children</a></li>
            <li><a href="advocates.php">Advocates</a></li>
            <li><a href="reports.php">Reports</a></li>
            
            <li><a href="anouncements.php">Announcements</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><a href="administrators.php">Administrators</a> / Edit Admin</h1>

          <div class="row">
            <div class="col-xs-offset-3 col-xs-6">
              <form  class="" action="php/do_edit_admin.php" method="post" enctype="multipart/form-data">
                <input type="text" name="admin_id" value="<?php echo $_GET['admin_id']; ?>" hidden>
                <div class="panel panel-primary">
                  <div class="panel-body">
                    <div class="row text-center">
                      <div class="fileinput fileinput-exists text-center" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px;"><img src="<?php echo "data:image/png;base64, ".base64_encode($row['id_picture']); ?>" alt=""></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="id_picture"></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name'] ?>" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="middle_name">Middle Name:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $row['middle_name'] ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name'] ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email address:</label>
                      <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="mobile_phone">Mobile Phone:</label>
                      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="address_line1">Address Line 1:</label>
                      <input type="text" class="form-control" id="address_line1" name="address_line1" value="<?php echo $row['address_line1'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="address_line2">Address Line 2:</label>
                      <input type="text" class="form-control" id="address_line2" name="address_line2" value="<?php echo $row['address_line2'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="city">City:</label>
                      <input type="text" class="form-control" id="city" name="city" value="<?php echo $row['city'] ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="region">Region:</label>
                      <select class="form-control" id="region" name="region" required>
                        <option value="" disabled>Choose Region</option>
                        <option value="Region I" <?php echo $row['region'] == "Region I"? "selected" : ""; ?>>Ilocos Region (Region I)</option>
                        <option value="Region II" <?php echo $row['region'] == "Region II"? "selected" : ""; ?>>Cagayan Valley (Region II)</option>
                        <option value="Region III" <?php echo $row['region'] == "Region III"? "selected" : ""; ?>>Central Luzon (Region III)</option>
                        <option value="Region IV-A" <?php echo $row['region'] == "Region IV-A"? "selected" : ""; ?>>CALABARZON (Region IV-A)</option>
                        <option value="Region IV-B" <?php echo $row['region'] == "Region IV-B"? "selected" : ""; ?>>MIMAROPA (Region IV-B)</option>
                        <option value="Region V" <?php echo $row['region'] == "Region V"? "selected" : ""; ?>>Bicol Region (Region V)</option>
                        <option value="Region VI" <?php echo $row['region'] == "Region VI"? "selected" : ""; ?>>Western Visayas (Region VI)</option>
                        <option value="Region VII" <?php echo $row['region'] == "Region VII"? "selected" : ""; ?>>Central Visayas (Region VII)</option>
                        <option value="Region VIII" <?php echo $row['region'] == "Region VIII"? "selected" : ""; ?>>Eastern Visayas (Region VIII)</option>
                        <option value="Region IX" <?php echo $row['region'] == "Region IX"? "selected" : ""; ?>>Zamboanga Peninsula (Region IX)</option>
                        <option value="Region X" <?php echo $row['region'] == "Region X"? "selected" : ""; ?>>Northern Mindanao (Region X)</option>
                        <option value="Region XI" <?php echo $row['region'] == "Region XI"? "selected" : ""; ?>>Davao Region (Region XI)</option>
                        <option value="Region XII" <?php echo $row['region'] == "Region XII"? "selected" : ""; ?>>SOCCSKSARGEN (Region XII)</option>
                        <option value="Region XIII" <?php echo $row['region'] == "Region XIII"? "selected" : ""; ?>>Caraga (Region XIII)</option>
                        <option value="ARMM" <?php echo $row['region'] == "ARMM"? "selected" : ""; ?>>Autonomous Region in Muslim Mindanao (ARMM)</option>
                        <option value="CAR"<?php echo $row['region'] == "CAR"? "selected" : ""; ?>>Cordillera Administrative Region (CAR)</option>
                        <option value="NCR"<?php echo $row['region'] == "NCR"? "selected" : ""; ?>>National Capital Region (NCR)</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="head">Head:</label>
                      <div class="radio">
                        <label><input type="radio" name="head" value="Yes" <?php echo $row['head']? "checked" : ""; ?> required>Yes</label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="head" value="No" <?php echo $row['head']? "" : "checked"; ?>  required>No</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <input type="submit" name="edit_admin" value="Save" class="btn btn-primary bttn">
                  <a class="btn btn-danger bttn" href="administrators.php">Cancel</a>
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
