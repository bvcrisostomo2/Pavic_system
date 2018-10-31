<?php
include 'php/admin_session.php';

//unconfirmed
$sql = "SELECT DISTINCT advocate_id FROM pavic_advocates_payments WHERE expiration IS NULL";

$result = $mysqli->query($sql);

$advocates_ids = [];
if(isset($result->num_rows)){
  while($row = $result->fetch_assoc()){
    $advocates_ids[] = $row['advocate_id'];
  }
}

$advocates_ids = implode(",",$advocates_ids);
$sql = "SELECT * FROM pavic_advocates WHERE advocate_id IN($advocates_ids)";

$result = $mysqli->query($sql);

$advocates_unconfirmed_info = [];
if(isset($result->num_rows)){
  while($row = $result->fetch_assoc()){
    $advocates_unconfirmed_info[] = $row;
  }
}

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 1:
      $message = 'Advocate payment confirmed.';
      break;
    case 2:
      $message = 'Advocate payment rejected.';
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
                <li class="active"><a href="#">Unconfirmed Advocates</a></li>
                <li><a href="unpayed.php">Unpayed Advocates</a></li>
              </ul>
              <br><br>

              <table id="unconfirmed_table" class="table dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <!-- <th class="text-center">ID Picture</th> -->
                    <th>Name</th>
                    <th>Payment</th>
                    <th class="text-center">Confirm</th>
                    <th class="text-center">Reject</th>
                    <th class="text-center">View</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i=0; $i < sizeof($advocates_unconfirmed_info); $i++) {
                    $sql = "SELECT * FROM pavic_advocates_payments WHERE advocate_id = ".$advocates_unconfirmed_info[$i]['advocate_id']." ORDER BY advocates_payment_id DESC LIMIT 1";
                    $result = $mysqli->query($sql);
                    if(isset($result->num_rows)){
                      if ($row = $result->fetch_assoc()) {
                        $advocates_payment_id = $row['advocates_payment_id'];
                      }
                    }
                  ?>
                  <tr>
                    <!-- <td class="text-center"><img src="<?php echo "data:image/png;base64, ".base64_encode($advocates_unconfirmed_info[$i]['id_picture']); ?>" alt="" width="50px"></td> -->
                    <td><?php echo $advocates_unconfirmed_info[$i]['first_name'].' '.$advocates_unconfirmed_info[$i]['middle_name'].' '.$advocates_unconfirmed_info[$i]['last_name']; ?></td>
                    <td><a href="payment.php?advocates_payment_id=<?php echo $advocates_payment_id; ?>">View Payment</a></td>
                    <td class="text-center"><a href="php/do_confirm_advocate.php?advocates_payment_id=<?php echo $advocates_payment_id ?>&advocate_id=<?php echo $advocates_unconfirmed_info[$i]['advocate_id']; ?>"><i class="fa fa-check" aria-hidden="true"></a></td>
                    <td class="text-center"><a href="php/do_reject_advocate.php?advocates_payment_id=<?php echo $advocates_payment_id ?>&advocate_id=<?php echo $advocates_unconfirmed_info[$i]['advocate_id']; ?>"><i class="fa fa-times" aria-hidden="true"></a></td>
                    <td class="text-center"><a href="unconfirmed-profile.php?advocate_id=<?php echo $advocates_unconfirmed_info[$i]['advocate_id']; ?>&previous=unconfirmed.php"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
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
