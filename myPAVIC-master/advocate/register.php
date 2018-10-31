<?php
include '../php/dbconfig.php';

$sql = "SELECT * FROM pavic_regions";

$result = $mysqli->query($sql);

$regions = [];
while($row = $result->fetch_assoc()){
  $regions[] = $row;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include('includes/links.php'); ?>

    <title>Advocate Register - PAVIC</title>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
            <span class="sr-only">Toggle navigation</span>
            <i class="fa fa-bars"></i>
          </button>
          <a class="navbar-brand" href="#"><img src="../img/paviclogo2.png" alt=""></a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="..">← GO BACK TO PORTAL</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center">
          <img src="../img/paviclogo.png" alt="" width="60%">
          <h2>Become an Advocate!</h2>
        </div>
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
              <form  class="" action="php/do_register.php" method="post" enctype="multipart/form-data">
                <div class="row text-center">
                  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px;"></div>
                    <div>
                      <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="id_picture" required></span>
                      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="first_name">*First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Juan"required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="last_name">*Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Santos" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email">*Email address:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Someone@gmail.com" required>
                </div>
                <div class="form-group">
                  <label for="password">*Password:</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                  <label for="confirm_password">*Confirm Password:</label>
                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password" required>
                  <span id='message'></span>
                </div>
                <div class="form-group">
                  <label for="birthday">*Birthday:</label>
                  <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
                <div class="form-group">
                  <label for="birthday">*Sex:</label>
                  <div class="radio">
                    <label><input type="radio" name="sex" value="Male" required>Male</label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="sex" value="Female" required>Female</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="landline">*Landline</label>
                  <input type="text" class="form-control" id="landline" name="landline" placeholder="1234567" required>
                </div>
                <div class="form-group">
                  <label for="mobile_phone">Mobile Phone:</label>
                  <input type="text" class="form-control" id="mobile_phone" name="mobile_phone">
                </div>
                <div class="form-group">
                  <label for="address_line1">*Address Line 1:</label>
                  <input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="#73 Mapayapa Street, Peace Town Homes Subdivision" required>
                </div>
                <div class="form-group">
                  <label for="address_line2">Address Line 2:</label>
                  <input type="text" class="form-control" id="address_line2" name="address_line2">
                </div>
                <div class="form-group">
                  <label for="city">*City:</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="Quezon City" required>
                </div>
                <div class="form-group">
                  <label for="region">*Region:</label>
                  <select class="form-control" id="region" name="region" required>
                    <option value="" selected disabled>Choose Region</option>
                    <?php for ($i=0; $i < sizeof($regions); $i++) { ?>
                    <option value="<?php echo $regions[$i]['region_id'] ?>"><?php echo $regions[$i]['long_name'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="occupation">*Occupation:</label>
                  <select class="form-control" id="region" name="region" required>
                    <option value="" selected disabled>Choose Occupation</option>
                    <option value="Unemployed">Unemployed</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Engineer">Engineer</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Soldier">Soldier</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="spouse_first_name">Spouse First Name:</label>
                    <input type="text" class="form-control" id="spouse_first_name" name="spouse_first_name">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="spouse_middle_name">Spouse Middle Name:</label>
                    <input type="text" class="form-control" id="spouse_middle_name" name="spouse_middle_name">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="spouse_last_name">Spouse Last Name:</label>
                    <input type="text" class="form-control" id="spouse_last_name" name="spouse_last_name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="">*Combined Income With Spouse:</label><br>
                  <div class="radio">
                    <label><input type="radio" name="combined_income" value="below PHP 12,000.00" required>below PHP 12,000.00</label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="combined_income" value="PHP 12,000.00 - PHP 30,000.00" required>PHP 12,000.00 - PHP 30,000.00</label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="combined_income" value="PHP 30,000.00 - PHP 50,000.00" required>PHP 30,000.00 - PHP 50,000.00</label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="combined_income" value="above PHP 50,000.00" required>above PHP 50,000.00</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="">*Relationship with Visually Impaired Child:</label><br>
                  <div class="radio">
                    <label><input type="radio" name="relationship" value="Father" required>Father</label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="relationship" value="Mother" required>Mother</label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="relationship" value="Guardian" required>Guardian</label>
                  </div>
                </div>
                <div class="text-center">
                  <br>
                  <button type="submit" class="btn btn-primary bttn" id="register" name="register">Register</button><br><br>
                  <a href="login.php">Already an advocate? Log In!</a>
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
