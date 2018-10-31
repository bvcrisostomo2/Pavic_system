<?php
include 'php/admin_session.php';

$sql = "SELECT * FROM pavic_advocates WHERE advocate_id = ".$_GET['advocate_id'];

$result = $mysqli->query($sql);

if($row = $result->fetch_assoc()){
  $advocate_info = $row;
}

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

    <title>Add Child - PAVIC</title>

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
            <li class="active"><a href="#">Advocates</a></li>
            <li><a href="reports.php">Reports</a></li>
            
            <li><a href="anouncements.php">Announcements</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><a href="advocates.php">Advocates</a> / <a href="advocate-profile.php?advocate_id=<?php echo $_GET['advocate_id']; ?>">Advocate Profile</a> / Edit Advocate Profile</h1>
          <div class="row">
            <div class="col-xs-offset-3 col-xs-6">
              <form  class="" action="php/do_edit_advocate.php" method="post" enctype="multipart/form-data">
                <input type="text" name="advocate_id" value="<?php echo $_GET['advocate_id']; ?>" hidden>
                <div class="panel panel-primary">
                  <div class="panel-body">
                    <div class="row text-center">
                      <div class="fileinput fileinput-exists text-center" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px;"><img src="<?php echo "data:image/png;base64, ".base64_encode($advocate_info['id_picture']); ?>" alt=""></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="id_picture"></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $advocate_info['first_name']; ?>" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="middle_name">Middle Name:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $advocate_info['middle_name']; ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $advocate_info['last_name']; ?>" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email">Email address:</label>
                      <input type="email" class="form-control" id="email" name="email" value="<?php echo $advocate_info['email']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="birthday">Birthday:</label>
                      <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $advocate_info['birthday']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="birthday">Sex:</label>
                      <div class="radio">
                        <label><input type="radio" name="sex" value="Male" required <?php echo $advocate_info['sex'] == "Male"? "checked" : ""; ?>>Male</label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="sex" value="Female" required <?php echo $advocate_info['sex'] == "Female"? "checked" : ""; ?>>Female</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="landline">Landline</label>
                      <input type="text" class="form-control" id="landline" name="landline" value="<?php echo $advocate_info['landline']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="mobile_phone">Mobile Phone:</label>
                      <input type="text" class="form-control" id="mobile_phone" name="mobile_phone" value="<?php echo $advocate_info['mobile_phone']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="address_line1">Address Line 1:</label>
                      <input type="text" class="form-control" id="address_line1" name="address_line1" value="<?php echo $advocate_info['address_line1']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="address_line2">Address Line 2:</label>
                      <input type="text" class="form-control" id="address_line2" name="address_line2" value="<?php echo $advocate_info['address_line2']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="city">City:</label>
                      <input type="text" class="form-control" id="city" name="city" value="<?php echo $advocate_info['city']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="region">Region:</label>
                      <select class="form-control" id="region" name="region" required>
                        <option value="" disabled>Choose Region</option>
                        <?php for ($i=0; $i < sizeof($regions); $i++) { ?>
                        <option value="<?php echo $regions[$i]['region_id'] ?>" <?php echo $advocate_info['region'] == $regions[$i]['region_id']? "selected" : ""; ?>><?php echo $regions[$i]['long_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="occupation">Occupation:</label>
                      <select class="form-control" id="occupation" name="occupation" required>
                        <option value="" disabled>Choose Occupation</option>
                        <option value="Unemployed" <?php echo $advocate_info['occupation'] == "Unemployed"? "selected" : ""; ?>>Unemployed</option>
                        <option value="Teacher" <?php echo $advocate_info['occupation'] == "Teacher"? "selected" : ""; ?>>Teacher</option>
                        <option value="Engineer" <?php echo $advocate_info['occupation'] == "Engineer"? "selected" : ""; ?>>Engineer</option>
                        <option value="Doctor" <?php echo $advocate_info['occupation'] == "Doctor"? "selected" : ""; ?>>Doctor</option>
                        <option value="Soldier" <?php echo $advocate_info['occupation'] == "Soldier"? "selected" : ""; ?>>Soldier</option>
                        <option value="Other" <?php echo $advocate_info['occupation'] == "Other"? "selected" : ""; ?>>Other</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label for="spouse_first_name">Spouse First Name:</label>
                        <input type="text" class="form-control" id="spouse_first_name" name="spouse_first_name" value="<?php echo $advocate_info['spouse_first_name']; ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="spouse_middle_name">Spouse Middle Name:</label>
                        <input type="text" class="form-control" id="spouse_middle_name" name="spouse_middle_name" value="<?php echo $advocate_info['spouse_middle_name']; ?>">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="spouse_last_name">Spouse Last Name:</label>
                        <input type="text" class="form-control" id="spouse_last_name" name="spouse_last_name" value="<?php echo $advocate_info['spouse_last_name']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Combined Income With Spouse:</label><br>
                      <div class="radio">
                        <label><input type="radio" name="combined_income" value="below PHP 12,000.00" required <?php echo $advocate_info['combined_income'] == "below PHP 12,000.00"? "checked" : ""; ?>>below PHP 12,000.00</label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="combined_income" value="PHP 12,000.00 - PHP 30,000.00" required <?php echo $advocate_info['combined_income'] == "PHP 12,000.00 - PHP 30,000.00"? "checked" : ""; ?>>PHP 12,000.00 - PHP 30,000.00</label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="combined_income" value="PHP 30,000.00 - PHP 50,000.00" required <?php echo $advocate_info['combined_income'] == "PHP 30,000.00 - PHP 50,000.00"? "checked" : ""; ?>>PHP 30,000.00 - PHP 50,000.00</label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="combined_income" value="above PHP 50,000.00" required <?php echo $advocate_info['combined_income'] == "above PHP 50,000.00"? "checked" : ""; ?>>above PHP 50,000.00</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Relationship with Visually Impaired Child:</label><br>
                      <div class="radio">
                        <label><input type="radio" name="relationship" value="Father" required <?php echo $advocate_info['relationship'] == "Father"? "checked" : ""; ?>>Father</label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="relationship" value="Mother" required <?php echo $advocate_info['relationship'] == "Mother"? "checked" : ""; ?>>Mother</label>
                      </div>
                      <div class="radio">
                        <label><input type="radio" name="relationship" value="Guardian" required <?php echo $advocate_info['relationship'] == "Guardian"? "checked" : ""; ?>>Guardian</label>
                      </div>
                    </div>
                    <div class="text-center">
                      <br>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <input type="submit" name="edit_advocate" value="Save" class="btn btn-primary bttn">
                  <a class="btn btn-danger bttn" href="profile.php">Cancel</a>
                  <br><br>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
