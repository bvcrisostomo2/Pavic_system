<?php
include('php/advocate_session.php');

$sql = "SELECT * FROM pavic_children WHERE advocate_id = $advocate_id;";

$result = $mysqli->query($sql);

if($result->num_rows == 0){
  header('location: add-child.php');
}

$children_info = [];
while($row = $result->fetch_assoc()){
  $children_info[] = $row;
}

$sql = "SELECT * FROM pavic_advocates_payments WHERE advocate_id = $advocate_id ORDER BY advocates_payment_id DESC LIMIT 1;";

$result = $mysqli->query($sql);

if($result->num_rows == 1) {
  $row = $result->fetch_assoc();
  $latest_payment_info = $row;
}

$sql = "SELECT * FROM pavic_anouncements ORDER BY anouncement_id DESC";

$result = $mysqli->query($sql);

$anouncements = [];
while($row = $result->fetch_assoc()){
  $anouncements[] = $row;

}

$sql = "SELECT * FROM pavic_regions WHERE region_id = ".$advocate_info['region'];

$result = $mysqli->query($sql);

$regions = "";
while($row = $result->fetch_assoc()){
  $region = $row['long_name'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php include('includes/links.php'); ?>

    <title>Advocate Profile - PAVIC</title>
  </head>
  <body>
    <?php include('includes/navbar.php'); ?>

    <ol class="breadcrumb">
        <li class="breadcrumb-item active">Profile</li>
    </ol>

    <div class="container">
      <section style="padding-bottom: 50px;">
        <div class="row">
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12">
                <?php if (isset($advocate_info['id_picture'])) { ?>
                <img src="<?php echo "data:image/png;base64, ".base64_encode($advocate_info['id_picture']); ?>" alt="" class="img-rounded avatar" width="70%">
                <?php }else{ ?>
                <img src="../img/default_avatar.png" class="img-rounded avatar" width="60%"/>
                <?php } ?>
                <a href="edit-profile.php" class="btn btn-primary hundred-with">Edit Profile</a>
                <table class="table smaller-text">
                  <tbody>
                    <tr>
                      <th>
                        <small>First Name:</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['first_name']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Middle Name:</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['middle_name']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Last Name:</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['last_name']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Email:</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['email']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Birthday</small>
                      </th>
                      <td>
                        <small><?php echo date('F d, Y', strtotime($advocate_info['birthday'])); ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Sex</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['sex']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Landline:</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['landline']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Mobile:</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['mobile_phone']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Address Line 1</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['address_line1']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Address Line 2</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['address_line2']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>City</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['city']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Region:</small>
                      </th>
                      <td>
                        <small><?php echo $region; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Occupation</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['occupation']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Spouse:</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['spouse_first_name'].' '.$advocate_info['spouse_middle_name'].' '.$advocate_info['spouse_last_name']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Combined Income</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['combined_income']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Relationship</small>
                      </th>
                      <td>
                        <small><?php echo $advocate_info['relationship']; ?></small>
                      </td>
                    </tr>
                    <tr>
                      <th>
                        <small>Password</small>
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

          <div class="col-md-6">
            <div class="row panel panel-default">
              <div class="col-md-12 panel-body yes-padding-bottom">
                <h3>Children <a href="add-child.php" class="btn btn-primary pull-right">Add Child</a></h3>
                <table id="children_table" class="table dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="text-center">ID Picture</th>
                      <th>Name</th>
                      <th class="text-center">View</th>
                      <th class="text-center">Remove</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i=0; $i < sizeof($children_info); $i++) { ?>
                      <?php
                        $sql = "SELECT * FROM pavic_cause_of_blindness WHERE id = ".$children_info[$i]['cause_of_blindness'];
                        $result = $mysqli->query($sql);

                        if(isset($result->num_rows)){
                          $row = $result->fetch_assoc();
                          $children_info[$i]['cause_of_blindness'] = $row['cause'];
                        }
                      ?>
                    <tr>
                      <td class="text-center"><img src="<?php echo "data:image/png;base64, ".base64_encode($children_info[$i]['id_picture']); ?>" alt="" width="50px"></td>
                      <td><?php echo $children_info[$i]['first_name'].' '.$children_info[$i]['middle_name'].' '.$children_info[$i]['last_name']; ?></td>
                      <td class="text-center"><a href="#" data-toggle="modal" data-target="#child_modal" onclick="setChildModalValues('<?php echo $children_info[$i]['child_id']; ?>', '<?php echo $children_info[$i]['first_name']; ?>', '<?php echo $children_info[$i]['middle_name']; ?>', '<?php echo $children_info[$i]['last_name']; ?>', '<?php echo $children_info[$i]['siblings']; ?>', '<?php echo date('F d, Y', strtotime($children_info[$i]['birthday'])); ?>', '<?php echo $children_info[$i]['sex']; ?>', '<?php echo $children_info[$i]['school']; ?>', '<?php echo $children_info[$i]['school_address']; ?>', '<?php echo $children_info[$i]['grade_level']; ?>', '<?php echo $children_info[$i]['cause_of_blindness']; ?>', '<?php echo $children_info[$i]['vision_left']; ?>', '<?php echo $children_info[$i]['vision_right']; ?>', '<?php echo $children_info[$i]['additional_disabilities']; ?>', '<?php echo $children_info[$i]['special_needs_owned']; ?>', '<?php echo $children_info[$i]['learning_tools_owned']; ?>', '<?php echo $children_info[$i]['physical_therapy']; ?>', '<?php echo $children_info[$i]['occupational_therapy']; ?>', '<?php echo $children_info[$i]['speech_therapy']; ?>', '<?php echo $children_info[$i]['other_needs']; ?>', '<?php echo "data:image/png;base64, ".base64_encode($children_info[$i]['id_picture']); ?>', '<?php echo "data:image/png;base64, ".base64_encode($children_info[$i]['family_picture']); ?>', '<?php echo $children_info[$i]['timestamp']; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                      <td class="text-center"><a href="php/do_remove_child.php?child_id=<?php echo $children_info[$i]['child_id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="row panel panel-default">
              <div class="col-md-12 panel-body no-padding-bottom">
                <h3>Anouncements</h3>
                <table id="anouncements_table" class="table hundred-width nowrap">
                  <thead class="hidden">
                    <tr>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php for ($i=0; $i < sizeof($anouncements); $i++) { ?>
                    <tr>
                      <td width="30%">
                            <h4><?php echo $anouncements[$i]['title']; ?></h4>
                            <h6 class="text-muted"><?php echo date('F d, Y h:i:s a', strtotime($anouncements[$i]['timestamp'])); ?></h6>
                            <p><?php echo $anouncements[$i]['text']; ?></p>
                            <a href="#" data-toggle="modal" data-target="#anouncements_modal" onclick="setAnouncementsModalValues('<?php echo $anouncements[$i]['title']; ?>', '<?php echo $anouncements[$i]['text']; ?>', '<?php echo date('F d, Y', strtotime($anouncements[$i]['timestamp'])); ?>')">Read More</a>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Membership Status</div>
                  <div class="panel-body">
                    <?php if (isset($latest_payment_info) && strtotime("now") <= strtotime($latest_payment_info['expiration'])) { ?>
                      <div class="alert alert-success">
                        <p>You are a <strong>Confirmed Advocate.</strong></p>
                        <br>
                        <h5>Expiration on: <?php echo date('F d, Y', strtotime($latest_payment_info['expiration'])); ?></h5>
                      </div>
                    <?php }elseif(isset($latest_payment_info) && $latest_payment_info['expiration'] == NULL){ ?>
                      <div class="alert alert-warning">
                        <p><strong>Please Wait </strong>for a few days.</p>
                        <br>
                        <h5>We will be processing your confirmation.</h5>
                      </div>
                    <?php }else{ ?>
                      <div class="alert alert-danger">
                        <p>You are not yet a <strong>Confirmed Advocate.</strong></p>
                        <br>
                        <h5>Please submit the following requirements:</h5>
                        <ul>
                          <li><strong><a href="submit-payment.php">Payment Slip</a></strong></li>
                        </ul>
                      </div>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </section>
    </div>

    <?php include('includes/profile_child_modal.php'); ?>
    <?php include('includes/profile_anouncements_modal.php'); ?>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
