<?php
include 'php/admin_session.php';

$sql = "SELECT * FROM pavic_anouncements ORDER BY anouncement_id DESC";

$result = $mysqli->query($sql);

$anouncements = [];
while($row = $result->fetch_assoc()){
  $anouncements[] = $row;

}

if (isset($_GET['success'])) {
  switch ($_GET['success']) {
    case 1:
      $message = 'Anouncement created.';
      break;
    case 2:
      $message = 'Anouncement removed.';
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

    <title>Anouncements - PAVIC</title>

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
            <li><a href="advocates.php">Advocates</a></li>
            <li><a href="reports.php">Reports</a></li>
            
            <li class="active"><a href="#">Announcements</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Announcements</h1>
          <?php if(isset($message)){ ?>
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <?php echo $message ?>
          </div>
          <?php } ?>
          <div class="row">
            <div class="col-xs-offset-1 col-xs-10">
              <form action="php/do_create_anouncement.php" method="post">
                <div class="form-group">
                  <label for="title">Title:</label>
                  <input type="text" name="title" value="" class="form-control" id="title" required>
                </div>
                <div class="form-group">
                  <label for="text">Announcement:</label>
                  <textarea name="text" rows="5" class="form-control" id="text" required></textarea>
                </div>
                <div class="text-right">
                  <input type="submit" name="create_anouncement" value="Create Announcement" class="btn btn-primary">
                </div>
              </form>

              <table id="anouncements_table" class="table hundred-width">
                <thead class="hidden">
                  <tr>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=0; $i < sizeof($anouncements); $i++) { ?>
                  <tr>
                    <td>
                      <div class="panel panel-default" style="margin-bottom: 0px;">
                        <div class="panel-body">
                          <a class="btn btn-danger pull-right" href="php/do_remove_anouncement.php?anouncement_id=<?php echo $anouncements[$i]['anouncement_id'] ?>">Delete</a>
                          <h4><?php echo $anouncements[$i]['title']; ?></h4>
                          <h6 class="text-muted"><?php echo date('F d, Y h:i:s a', strtotime($anouncements[$i]['timestamp'])); ?></h6>
                          <p><?php echo $anouncements[$i]['text']; ?></p>
                          <a href="#" data-toggle="modal" data-target="#anouncements_modal" onclick="setAnouncementsModalValues('<?php echo $anouncements[$i]['title']; ?>', '<?php echo $anouncements[$i]['text']; ?>', '<?php echo date('F d, Y', strtotime($anouncements[$i]['timestamp'])); ?>')">Read More</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>

    <?php include 'includes/anouncements_modal.php'; ?>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
