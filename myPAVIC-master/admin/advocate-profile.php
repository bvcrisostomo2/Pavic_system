<?php
include 'php/admin_session.php';

$sql = "SELECT * FROM pavic_advocates WHERE advocate_id = ".$_GET['advocate_id'].";";

$result = $mysqli->query($sql);

if($row = $result->fetch_assoc()){
  $advocate_info = $row;
}

$sql = "SELECT * FROM pavic_children WHERE advocate_id = ".$_GET['advocate_id'].";";

$result = $mysqli->query($sql);

if($result->num_rows == 0){
  header('location: add-child.php');
}

$children_info = [];
while($row = $result->fetch_assoc()){
  $children_info[] = $row;
}

$sql = "SELECT * FROM pavic_regions WHERE region_id = ".$advocate_info['region'];

$result = $mysqli->query($sql);

$regions = "";
while($row = $result->fetch_assoc()){
  $region = $row['long_name'];
}

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 1:
      $message = 'Advocate profile editted.';
      break;
    case 2:
      $message = 'Advocate password changed.';
      break;
    case 3:
      $message = 'Child Added.';
      break;
    case 4:
      $message = 'Child removed.';
      break;
    case 5:
      $message = 'Child info editted.';
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

    <title>Advocate Profile - PAVIC</title>

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
          <h1 class="page-header"><a href="advocates.php">Advocates</a> / Advocate Profile</h1>
          <?php if(isset($message)){ ?>
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <?php echo $message ?>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
              <section style="padding-bottom: 50px;">
                <div class="row">
                  <div class="col-md-5">
                    <div class="row">
                      <div class="col-md-12">
                        <?php if (isset($advocate_info['id_picture'])) { ?>
                        <img src="<?php echo "data:image/png;base64, ".base64_encode($advocate_info['id_picture']); ?>" alt="" class="img-rounded avatar" width="70%">
                        <?php }else{ ?>
                        <img src="../img/default_avatar.png" class="img-rounded avatar" width="60%"/>
                        <?php } ?>
                        <a href="edit-advocate.php?advocate_id=<?php echo $_GET['advocate_id']; ?>" class="btn btn-primary hundred-with">Edit Profile</a>
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
                                <small>Sex:</small>
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
                                <small>Address Line 1:</small>
                              </th>
                              <td>
                                <small><?php echo $advocate_info['address_line1']; ?></small>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                <small>Address Line 2:</small>
                              </th>
                              <td>
                                <small><?php echo $advocate_info['address_line2']; ?></small>
                              </td>
                            </tr>
                            <tr>
                              <th>
                                <small>City:</small>
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
                                <small>Occupation:</small>
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
                                <small><a href="advocate-change-password.php?advocate_id=<?php echo $_GET['advocate_id']; ?>">Change Password</a></small>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-7">
                    <div class="row panel panel-default">
                      <div class="col-md-12 panel-body yes-padding-bottom">
                        <h3>Children <a href="add-child.php?advocate_id=<?php echo $_GET['advocate_id']; ?>" class="btn btn-primary pull-right">Add Child</a></h3>
                        <table id="advocate_children_table" class="table dt-responsive nowrap" cellspacing="0" width="100%">
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
                              <td class="text-center"><a href="#" data-toggle="modal" data-target="#child_modal" onclick="setChildModalValues('<?php echo $children_info[$i]['child_id']; ?>', '<?php echo $children_info[$i]['first_name']; ?>', '<?php echo $children_info[$i]['middle_name']; ?>', '<?php echo $children_info[$i]['last_name']; ?>', '<?php echo $children_info[$i]['siblings']; ?>', '<?php echo date('F d, Y', strtotime($children_info[$i]['birthday'])); ?>', '<?php echo $children_info[$i]['sex']; ?>', '<?php echo $children_info[$i]['school']; ?>', '<?php echo $children_info[$i]['school_address']; ?>', '<?php echo $children_info[$i]['grade_level']; ?>', '<?php echo $children_info[$i]['cause_of_blindness']; ?>', '<?php echo $children_info[$i]['vision_left']; ?>', '<?php echo $children_info[$i]['vision_right']; ?>', '<?php echo $children_info[$i]['additional_disabilities']; ?>', '<?php echo $children_info[$i]['special_needs_owned']; ?>', '<?php echo $children_info[$i]['learning_tools_owned']; ?>', '<?php echo $children_info[$i]['physical_therapy']; ?>', '<?php echo $children_info[$i]['occupational_therapy']; ?>', '<?php echo $children_info[$i]['speech_therapy']; ?>', '<?php echo $children_info[$i]['other_needs']; ?>', '<?php echo "data:image/png;base64, ".base64_encode($children_info[$i]['id_picture']); ?>', '<?php echo "data:image/png;base64, ".base64_encode($children_info[$i]['family_picture']); ?>', '<?php echo $children_info[$i]['timestamp']; ?>', <?php echo $_GET['advocate_id']; ?>)"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                              <td class="text-center"><a href="php/do_remove_child.php?child_id=<?php echo $children_info[$i]['child_id'] ?>&previous=advocate-profile.php?advocate_id=<?php echo $_GET['advocate_id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include 'includes/advocates_child_modal.php'; ?>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
