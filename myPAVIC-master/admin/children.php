<?php
include 'php/admin_session.php';

//payed advocates
$sql = "SELECT * FROM pavic_advocates t1 WHERE CURDATE() <= (SELECT t2.expiration FROM pavic_advocates_payments t2 WHERE t2.advocate_id = t1.advocate_id AND t2.expiration IS NOT NULL ORDER BY t2.advocates_payment_id DESC LIMIT 1);";

$result = $mysqli->query($sql);
$advocates_info = [];
$advocates_ids = [];
if(isset($result->num_rows)){
  while($row = $result->fetch_assoc()){
    $advocates_ids[] = $row['advocate_id'];
    $advocates_info[] = $row;
  }
}

$advocates_ids = implode(",",$advocates_ids);
$sql = "SELECT t1.child_id, t1.first_name, t1.middle_name, t1.last_name, t1.siblings, t1.birthday, t1.sex, t1.school, t1.school_address, t1.grade_level, t1.cause_of_blindness, t1.vision_left, t1.vision_right, t1.additional_disabilities, t1.special_needs_owned, t1.learning_tools_owned, t1.physical_therapy, t1.occupational_therapy, t1.speech_therapy, t1.other_needs, t1.id_picture, t1.family_picture, t1.medical_history, t1.medical_history_mime_type, t1.medical_history_file_name, t1.timestamp, t2.advocate_id, t2.first_name advocate_first_name, t2.middle_name advocate_middle_name, t2.last_name advocate_last_name, t2.birthday advocate_birthday, t2.sex advocate_sex, t2.mobile_phone advocate_mobile_phone, t2.landline advocate_landline, t2.email advocate_email, t2.password advocate_password, t2.address_line1 advocate_address_line1, t2.address_line2 advocate_address_line2, t2.city advocate_city, t2.region advocate_region, t2.combined_income advocate_combined_income, t2.relationship advocate_relationship, t2.spouse_first_name advocate_spouse_first_name, t2.spouse_middle_name advocate_spouse_middle_name, t2.spouse_last_name advocate_spouse_last_name, t2.id_picture advocate_id_picture, t2.timestamp advocate_timestamp FROM pavic_children t1, pavic_advocates t2 WHERE t1.advocate_id IN($advocates_ids) AND t1.advocate_id = t2.advocate_id;";

$result = $mysqli->query($sql);

$children_info = [];
if(isset($result->num_rows)){
  while($row = $result->fetch_assoc()){
    $children_info[] = $row;
  }
}

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 1:
      $message = 'Child removed.';
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

    <title>Children - PAVIC</title>

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
            <li class="active"><a href="#">Children</a></li>
            <li><a href="advocates.php">Advocates</a></li>
            <li><a href="reports.php">Reports</a></li>

            <li><a href="anouncements.php">Announcements</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Children</h1>
          <?php if(isset($message)){ ?>
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <?php echo $message ?>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
              <table id="children_table" class="table nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th class="text-center">ID Picture</th> -->
                    <th>Name</th>
                    <th>Advocate</th>
                    <th>Birthday</th>
                    <th>Sex</th>
                    <th>School</th>
                    <th>Grade Level</th>
                    <th>Cause of Blindness</th>
                    <th>Left Vision</th>
                    <th>Right Vision</th>
                    <th>Region</th>
                    <th>Physical Therapy</th>
                    <th>Occupational Therapy</th>
                    <th>Speech Therapy</th>
                    <th class="text-center">View</th>
                    <?php if ($admin_info['head']) { ?>
                    <th class="text-center">Remove</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <!-- <th class="text-center">ID Picture</th> -->
                    <th>Name</th>
                    <th>Advocate</th>
                    <th>Birthday</th>
                    <th>Sex</th>
                    <th>School</th>
                    <th>Grade Level</th>
                    <th>Cause of Blindness</th>
                    <th>Left Vision</th>
                    <th>Right Vision</th>
                    <th>Region</th>
                    <th>Physical Therapy</th>
                    <th>Occupational Therapy</th>
                    <th>Speech Therapy</th>
                    <th class="text-center">View</th>
                    <?php if ($admin_info['head']) { ?>
                    <th class="text-center">Remove</th>
                    <?php } ?>
                  </tr>
                </tfoot>
                <tbody>
                  <?php for ($i=0; $i < sizeof($children_info); $i++) { ?>
                    <?php
                      $sql = "SELECT * FROM pavic_cause_of_blindness WHERE id = ".$children_info[$i]['cause_of_blindness'];
                      $result = $mysqli->query($sql);

                      if(isset($result->num_rows)){
                        $row = $result->fetch_assoc();
                        $children_info[$i]['cause_of_blindness'] = $row['cause'];
                      }

                      $sql = "SELECT * FROM pavic_regions WHERE region_id = ".$children_info[$i]['advocate_region'];
                      $result = $mysqli->query($sql);
                      if(isset($result->num_rows)){
                        if ($row = $result->fetch_assoc()) {
                          $region = $row['short_name'];
                        }
                      }
                    ?>
                  <tr>
                    <!-- <td class="text-center"><img src="<?php echo "data:image/png;base64, ".base64_encode($children_info[$i]['id_picture']); ?>" alt="" width="50px"></td> -->
                    <td style="padding-right:75px"><?php echo $children_info[$i]['first_name'].' '.$children_info[$i]['middle_name'].' '.$children_info[$i]['last_name']; ?></td>
                    <td style="padding-right:75px" onclick="window.location('advocate-profile.php?advocate_id=<?php echo $children_info[$i]['advocate_id'] ?>')"><?php echo $children_info[$i]['advocate_first_name'].' '.$children_info[$i]['advocate_middle_name'].' '.$children_info[$i]['advocate_last_name']; ?></td>
                    <td style="padding-right:75px"><?php echo date('F d, Y', strtotime($children_info[$i]['birthday'])); ?></td>
                    <td style="padding-right:75px"><?php echo $children_info[$i]['sex']; ?></td>
                    <td style="padding-right:75px"><?php echo $children_info[$i]['school']; ?></td>
                    <td style="padding-right:75px"><?php echo $children_info[$i]['grade_level']; ?></td>
                    <td style="padding-right:75px"><?php echo $children_info[$i]['cause_of_blindness']; ?></td>
                    <td style="padding-right:75px"><?php echo $children_info[$i]['vision_left']; ?></td>
                    <td style="padding-right:75px"><?php echo $children_info[$i]['vision_right']; ?></td>
                    <td style="padding-right:75px"><?php echo $region; ?></td>
                    <td style="padding-right:75px"><?php echo $children_info[$i]['physical_therapy']; ?></td>
                    <td style="padding-right:75px"><?php echo $children_info[$i]['occupational_therapy']; ?></td>
                    <td style="padding-right:75px"><?php echo $children_info[$i]['speech_therapy']; ?></td>
                    <td class="text-center"><a href="#" data-toggle="modal" data-target="#child_modal" onclick="setChildModalValues('<?php echo $children_info[$i]['child_id']; ?>', '<?php echo $children_info[$i]['first_name']; ?>', '<?php echo $children_info[$i]['middle_name']; ?>', '<?php echo $children_info[$i]['last_name']; ?>', '<?php echo $children_info[$i]['siblings']; ?>', '<?php echo date('F d, Y', strtotime($children_info[$i]['birthday'])); ?>', '<?php echo $children_info[$i]['sex']; ?>', '<?php echo $children_info[$i]['school']; ?>', '<?php echo $children_info[$i]['school_address']; ?>', '<?php echo $children_info[$i]['grade_level']; ?>', '<?php echo $children_info[$i]['cause_of_blindness']; ?>', '<?php echo $children_info[$i]['vision_left']; ?>', '<?php echo $children_info[$i]['vision_right']; ?>', '<?php echo $children_info[$i]['additional_disabilities']; ?>', '<?php echo $children_info[$i]['special_needs_owned']; ?>', '<?php echo $children_info[$i]['learning_tools_owned']; ?>', '<?php echo $children_info[$i]['physical_therapy']; ?>', '<?php echo $children_info[$i]['occupational_therapy']; ?>', '<?php echo $children_info[$i]['speech_therapy']; ?>', '<?php echo $children_info[$i]['other_needs']; ?>', '<?php echo "data:image/png;base64, ".base64_encode($children_info[$i]['id_picture']); ?>', '<?php echo "data:image/png;base64, ".base64_encode($children_info[$i]['family_picture']); ?>', '<?php echo $children_info[$i]['timestamp']; ?>',<?php echo $children_info[$i]['advocate_id']; ?>, '<?php echo $children_info[$i]['advocate_first_name'].' '.$children_info[$i]['advocate_middle_name'].' '.$children_info[$i]['advocate_last_name']; ?>', '<?php echo $children_info[$i]['advocate_relationship']; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    <?php if ($admin_info['head']) { ?>
                    <td class="text-center"><a href="php/do_remove_child.php?child_id=<?php echo $children_info[$i]['child_id'] ?>&previous=children.php"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                    <?php } ?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>

    <?php include 'includes/child_modal.php'; ?>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
