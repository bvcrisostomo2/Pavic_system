<?php
include 'php/admin_session.php';

$sql = "SELECT * FROM pavic_admin_logs ORDER BY admin_log_id DESC";

$result = $mysqli->query($sql);

$admin_logs = [];
if(isset($result->num_rows)){
  while($row = $result->fetch_assoc()){
    $admin_logs[] = $row;
  }
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrators - PAVIC</title>

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
              <li class="active"><a href="#">Administrators</a></li>
            <?php } ?>
            <li><a href="children.php">Children</a></li>
            <li><a href="advocates.php">Advocates</a></li>
            <li><a href="reports.php">Reports</a></li>
            
            <li><a href="anouncements.php">Announcements</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Administrators</h1>

          <div class="row">
            <div class="col-xs-offset-1 col-xs-10">

              <ul class="nav nav-tabs nav-justified">
                <li><a href="administrators.php">Administrators</a></li>
                <li class="active"><a href="#">Admin Logs</a></li>
              </ul>
              <br><br>
              <table id="admin_logs_table" class="table dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Timestamp</th>
                    <th>Admin</th>
                    <th>Activity</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=0; $i < sizeof($admin_logs); $i++) { ?>
                    <?php
                      $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_admin WHERE admin_id = ".$admin_logs[$i]['admin_id'];
                      if ($result = $mysqli->query($sql)) {
                        if($row = $result->fetch_assoc()){
                          $name = $row['name'];
                        }
                      }
                    ?>
                  <tr>
                    <td><?php echo date("Y-m-d h:i:s a", strtotime($admin_logs[$i]['timestamp'])) ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $admin_logs[$i]['activity']; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include 'includes/admin_modal.php'; ?>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
