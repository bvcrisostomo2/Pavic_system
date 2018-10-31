<?php
  include 'php/advocate_session.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include('includes/links.php'); ?>

    <title>Advocate Submit Payment - PAVIC</title>
  </head>
  <body>
    <?php include('includes/navbar.php'); ?>

    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
      <li class="breadcrumb-item active">Submit Payment</li>
    </ol>

    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-primary">
            <div class="panel-heading">Submit Payment</div>
            <div class="panel-body">
              <form  class="" action="php/do_submit_payment.php" method="post" enctype="multipart/form-data">
                <!-- <div class="form-group">
                  <label for="payment_method">Payment Method</label>
                  <select class="form-control" id="payment_method" name="payment_method" required>
                    <option value="" disabled selected>Choose Payment Method</option>
                    <option value="Method 1">Method 1</option>
                  </select>
                </div> -->

                <div class="form-group">
                  <label for="">Scanned Payment Slip</label><br>
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="payment_slip" required></span>
                    <span class="fileinput-filename"></span>
                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                  </div>
                </div>

                <div class="text-center">
                  <div class="text-center">
                    <input type="submit" name="submit_payment" value="Submit" class="btn btn-primary bttn">
                    <a class="btn btn-danger bttn" href="profile.php">Cancel</a>
                  </div>
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
