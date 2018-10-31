<?php
include 'php/admin_session.php';

$sql = "SELECT * FROM pavic_admin WHERE admin_id <> $admin_id;";

$result = $mysqli->query($sql);

$administrators = [];
if(isset($result->num_rows)){
  while($row = $result->fetch_assoc()){
    $administrators[] = $row;
  }
}

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 1:
      $message = 'Admin profile editted.';
      break;
    case 2:
      $message = 'Admin password changed.';
      break;
    case 3:
      $message = 'Admin created.';
      break;
    case 4:
      $message = 'Admin removed.';
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
          <?php if(isset($message)){ ?>
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <?php echo $message ?>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-10">

              <ul class="nav nav-tabs nav-justified">
                <li class="active"><a href="#">Administrators</a></li>
                <li><a href="admin_logs.php">Admin Logs</a></li>
              </ul>
              <br><br>
              <a href="create-admin.php" class="btn btn-primary">Create New Admin</a>
              <br><br>
              <table id="admin_table" class="table dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="text-center">ID Picture</th>
                    <th>Name</th>
                    <th class="text-center">Head</th>
                    <th class="text-center">View</th>
                    <th class="text-center">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=0; $i < sizeof($administrators); $i++) { ?>
                  <tr>
                    <td class="text-center"><img src="<?php echo "data:image/png;base64, ".base64_encode($administrators[$i]['id_picture']); ?>" alt="" width="50px"></td>
                    <td><?php echo $administrators[$i]['first_name'].' '.$administrators[$i]['middle_name'].' '.$administrators[$i]['last_name']; ?></td>
                    <td class="text-center"><?php echo $administrators[$i]['head'] == 1? "Yes" : "No"; ?></td>
                    <td class="text-center"><a href="#" data-toggle="modal" data-target="#admin_modal" onclick="setAdminModalValues(<?php echo $administrators[$i]['admin_id']; ?>, '<?php echo $administrators[$i]['first_name']; ?>', '<?php echo $administrators[$i]['middle_name']; ?>', '<?php echo $administrators[$i]['last_name']; ?>', '<?php echo $administrators[$i]['phone']; ?>', '<?php echo $administrators[$i]['email']; ?>', '<?php echo $administrators[$i]['address_line1']; ?>', '<?php echo $administrators[$i]['address_line2']; ?>', '<?php echo $administrators[$i]['city']; ?>', '<?php echo $administrators[$i]['region']; ?>', '<?php echo $administrators[$i]['head'] == 1? "Yes" : "No"; ?>', '<?php echo "data:image/png;base64, ".base64_encode($administrators[$i]['id_picture']); ?>', '<?php echo $administrators[$i]['timestamp']; ?>')"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                    <td class="text-center"><a href="php/do_remove_admin.php?admin_id=<?php echo $administrators[$i]['admin_id'] ?>"><i class="fa fa-times" aria-hidden="true"></a></td>
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
