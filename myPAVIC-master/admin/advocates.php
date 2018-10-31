<?php
include 'php/admin_session.php';

//payed advocates
$sql = "SELECT * FROM pavic_advocates t1 WHERE CURDATE() <= (SELECT t2.expiration FROM pavic_advocates_payments t2 WHERE t2.advocate_id = t1.advocate_id AND t2.expiration IS NOT NULL ORDER BY t2.advocates_payment_id DESC LIMIT 1);";

$result = $mysqli->query($sql);

$advocates_info = [];
if(isset($result->num_rows)){
  while($row = $result->fetch_assoc()){
    $advocates_info[] = $row;
  }
}

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 7:
      $message = 'Advocate removed.';
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

    <title>Advocates - PAVIC</title>

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
          <h1 class="page-header">Advocates</h1>
          <?php if(isset($message)){ ?>
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <?php echo $message ?>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
              <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#">Advocates</a></li>
                <li><a href="unconfirmed.php">Unconfirmed Advocates</a></li>
                <li><a href="unpayed.php">Unpayed Advocates</a></li>
              </ul>
              <br><br>

              <table id="advocate_table" class="table nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th class="text-center">ID Picture</th> -->
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile Phone</th>
                    <th>Landline</th>
                    <th>Birthday</th>
                    <th>Sex</th>
                    <th>Address Line 1</th>
                    <th>Address Line 2</th>
                    <th>City</th>
                    <th>Region</th>
                    <th>Occupation</th>
                    <th>Spouse</th>
                    <th>Combined Income</th>
                    <th>Relationship</th>
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
                    <th>Email</th>
                    <th>Mobile Phone</th>
                    <th>Landline</th>
                    <th>Birthday</th>
                    <th>Sex</th>
                    <th>Address Line 1</th>
                    <th>Address Line 2</th>
                    <th>City</th>
                    <th>Region</th>
                    <th>Occupation</th>
                    <th>Spouse</th>
                    <th>Combined Income</th>
                    <th>Relationship</th>
                    <th class="text-center">View</th>
                    <?php if ($admin_info['head']) { ?>
                    <th class="text-center">Remove</th>
                    <?php } ?>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  for ($i=0; $i < sizeof($advocates_info); $i++) {
                    $sql = "SELECT * FROM pavic_regions WHERE region_id = ".$advocates_info[$i]['region'];
                    $result = $mysqli->query($sql);
                    if(isset($result->num_rows)){
                      if ($row = $result->fetch_assoc()) {
                        $region = $row['short_name'];
                      }
                    }
                  ?>
                  <tr>
                    <!-- <td class="text-center"><img src="<?php echo "data:image/png;base64, ".base64_encode($advocates_info[$i]['id_picture']); ?>" alt="" width="50px"></td> -->
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['first_name'].' '.$advocates_info[$i]['middle_name'].' '.$advocates_info[$i]['last_name']; ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['email'] ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['mobile_phone'] ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['landline'] ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['birthday'] ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['sex'] ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['address_line1'] ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['address_line2'] ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['city'] ?></td>
                    <td style="padding-right:75px"><?php echo $region ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['occupation'] ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['spouse_first_name'].' '.$advocates_info[$i]['spouse_middle_name'].' '.$advocates_info[$i]['spouse_last_name']; ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['combined_income'] ?></td>
                    <td style="padding-right:75px"><?php echo $advocates_info[$i]['relationship'] ?></td>
                    <td class="text-center"><a href="advocate-profile.php?advocate_id=<?php echo $advocates_info[$i]['advocate_id']; ?>&previous=advocates.php"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    <?php if ($admin_info['head']) { ?>
                    <td class="text-center"><a href="php/do_remove_advocate.php?advocate_id=<?php echo $advocates_info[$i]['advocate_id'] ?>&previous=advocates.php"><i class="fa fa-times" aria-hidden="true"></a></td>
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

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
