<?php
include 'php/admin_session.php';

//unpayed
$sql = "SELECT * FROM pavic_advocates t1 WHERE 0 = (SELECT COUNT(1) FROM pavic_advocates_payments t2 WHERE t2.advocate_id = t1.advocate_id) OR CURDATE() > (SELECT t3.expiration FROM pavic_advocates_payments t3 WHERE t3.advocate_id = t1.advocate_id AND t3.expiration IS NOT NULL ORDER BY t3.advocates_payment_id DESC LIMIT 1);";

$result = $mysqli->query($sql);

$advocates_unpayed_info = [];
if(isset($result->num_rows)){
  while($row = $result->fetch_assoc()){
    $advocates_unpayed_info[] = $row;
  }
}

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 1:
      $message = 'Advocate payment confirmed.';
      break;
    case 7:
      $message = 'Unpayed Advocate removed.';
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
                <li><a href="advocates.php">Advocates</a></li>
                <li><a href="unconfirmed.php">Unconfirmed Advocates</a></li>
                <li class="active"><a href="#">Unpayed Advocates</a></li>
              </ul>
              <br><br>

              <table id="unpayed_table" class="table dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th class="text-center">ID Picture</th> -->
                    <th>Name</th>
                    <th>Paid</th>
                    <th class="text-center">View</th>
                    <?php if ($admin_info['head']) { ?>
                    <th class="text-center">Remove</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i=0; $i < sizeof($advocates_unpayed_info); $i++) {
                  ?>
                  <tr>
                    <!-- <td class="text-center"><img src="<?php echo "data:image/png;base64, ".base64_encode($advocates_unpayed_info[$i]['id_picture']); ?>" alt="" width="50px"></td> -->
                    <td><?php echo $advocates_unpayed_info[$i]['first_name'].' '.$advocates_unpayed_info[$i]['middle_name'].' '.$advocates_unpayed_info[$i]['last_name']; ?></td>
                    <td class="text-center"><a href="php/do_confirm_advocate.php?advocates_payment_id=0&advocate_id=<?php echo $advocates_unpayed_info[$i]['advocate_id']; ?>"><i class="fa fa-check" aria-hidden="true"></a></td>
                    <td class="text-center"><a href="unpayed-profile.php?advocate_id=<?php echo $advocates_unpayed_info[$i]['advocate_id']; ?>&previous=unpayed.php"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    <?php if ($admin_info['head']) { ?>
                    <td class="text-center"><a href="php/do_remove_advocate.php?advocate_id=<?php echo $advocates_unpayed_info[$i]['advocate_id'] ?>&previous=unpayed.php"><i class="fa fa-times" aria-hidden="true"></a></td>
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
