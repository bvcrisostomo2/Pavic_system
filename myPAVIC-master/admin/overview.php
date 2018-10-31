<?php
include 'php/admin_session.php';

//payed advocates
$sql = "SELECT * FROM pavic_advocates t1 WHERE CURDATE() <= (SELECT t2.expiration FROM pavic_advocates_payments t2 WHERE t2.advocate_id = t1.advocate_id AND t2.expiration IS NOT NULL ORDER BY t2.advocates_payment_id DESC LIMIT 1);";

$result = $mysqli->query($sql);

$number_of_advocates = 0;
$advocates_info = [];
$advocates_ids = [];
if(isset($result->num_rows)){
  $number_of_advocates = $result->num_rows;

  while($row = $result->fetch_assoc()){
    $advocates_ids[] = $row['advocate_id'];
    $advocates_info[] = $row;
  }
}

$advocates_ids = implode(",",$advocates_ids);
$sql = "SELECT * FROM pavic_children t1 WHERE t1.advocate_id IN($advocates_ids)";

$result = $mysqli->query($sql);

$number_of_children = 0;
$children_info = [];
if(isset($result->num_rows)){
  $number_of_children = $result->num_rows;

  while($row = $result->fetch_assoc()){
    $children_info[] = $row;
  }
}

//unconfirmed
$sql = "SELECT * FROM pavic_advocates_payments WHERE expiration IS NULL";

$result = $mysqli->query($sql);

$number_of_advocates_unconfirmed = 0;
$advocates_unconfirmed_info = [];
if(isset($result->num_rows)){
  $number_of_advocates_unconfirmed = $result->num_rows;

  while($row = $result->fetch_assoc()){
    $advocates_unconfirmed_info[] = $row;
  }
}


//unpayed
$sql = "SELECT * FROM pavic_advocates t1 WHERE 0 = (SELECT COUNT(1) FROM pavic_advocates_payments t2 WHERE t2.advocate_id = t1.advocate_id) OR CURDATE() > (SELECT t3.expiration FROM pavic_advocates_payments t3 WHERE t3.advocate_id = t1.advocate_id AND t3.expiration IS NOT NULL ORDER BY t3.advocates_payment_id DESC LIMIT 1);";

$result = $mysqli->query($sql);

$number_of_advocates_unpayed = 0;
$advocates_unpayed_info = [];
if(isset($result->num_rows)){
  $number_of_advocates_unpayed = $result->num_rows;

  while($row = $result->fetch_assoc()){
    $advocates_unpayed_info[] = $row;
  }
}

?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Overview - PAVIC</title>

    <?php include('includes/links.php'); ?>
  </head>

  <body cz-shortcut-listen="true">

    <?php include 'includes/navbar.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview</a></li>
            <li><a href="administrators.php">Administrators</a></li>
            <li><a href="children.php">Children</a></li>
            <li><a href="advocates.php">Advocates</a></li>
            <li><a href="reports.php">Reports</a></li>
            
            <li><a href="anouncements.php">Announcements</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Overview</h1>

          <div class="row">
            <div class="col-xs-offset-1 col-xs-8 col-sm-3">
              <!-- <canvas id="sexChart" width="400" height="400"></canvas> -->
            </div>
            <div class="col-xs-offset-1 col-xs-8 col-sm-3">

            </div>
            <div class="col-xs-offset-1 col-xs-8 col-sm-3">

            </div>
          </div>

          <div class="row">
            <div class="col-xs-offset-1 col-xs-8 col-sm-3">

            </div>
            <div class="col-xs-offset-1 col-xs-8 col-sm-3">

            </div>
            <div class="col-xs-offset-1 col-xs-8 col-sm-3">

            </div>
          </div>

          <div class="row center-margin">
            <div class="col-xs-offset-1 col-xs-8">
              <h3>Number of Enrolled Children</h3>
            </div>
            <div class="col-xs-2 text-right">
              <h3><?php echo $number_of_children; ?></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-8">
              <h3>Number of Advocates</h3>
            </div>
            <div class="col-xs-2 text-right">
              <h3><?php echo $number_of_advocates; ?></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-8">
              <h3>Advocates Waiting for Confirmation</h3>
            </div>
            <div class="col-xs-2 text-right">
              <h3><?php echo $number_of_advocates_unconfirmed; ?></h3>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-8">
              <h3>Unpayed Advocates</h3>
            </div>
            <div class="col-xs-2 text-right">
              <h3><?php echo $number_of_advocates_unpayed; ?></h3>
            </div>
          </div>

        </div>
      </div>
    </div>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
