<?php
include 'php/admin_session.php';

$sql = "SELECT * FROM pavic_events WHERE event_id = ".$_GET['event_id'];

$result = $mysqli->query($sql);

if($row = $result->fetch_assoc()){
  $event_info = $row;
}

$sql = "SELECT * FROM pavic_regions";

$result = $mysqli->query($sql);

$regions = [];
while($row = $result->fetch_assoc()){
  $regions[] = $row;
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit Event - PAVIC</title>

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
            <li class="active"><a href="events.php">Events</a></li>
            <li><a href="anouncements.php">Announcements</a></li>
            <li><a href="account.php">My Account</a></li>
          </ul>
        </div>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><a href="events.php">Events</a> / Edit Event</h1>
          <div class="row">
            <div class="col-xs-offset-3 col-xs-6">
              <form  class="" action="php/do_edit_event.php" method="post" enctype="multipart/form-data">
                <input type="text" name="event_id" value="<?php echo $_GET['event_id']; ?>" hidden>
                <div class="panel panel-primary">
                  <div class="panel-body">
                    <div class="form-group">
                      <label for="name">Event Name:</label>
                      <input type="text" class="form-control" id="name" name="name" required value="<?php echo $event_info['name'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="date">Date:</label>
                      <input type="date" class="form-control" id="date" name="date" required value="<?php echo $event_info['date'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="start_time">Start Time:</label>
                      <input type="time" class="form-control" id="start_time" name="start_time" required value="<?php echo $event_info['start_time'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="end_time">End Time:</label>
                      <input type="time" class="form-control" id="end_time" name="end_time" required value="<?php echo $event_info['end_time'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="venue">Venue:</label>
                      <input type="text" class="form-control" id="venue" name="venue" required value="<?php echo $event_info['venue'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="city">City:</label>
                      <input type="text" class="form-control" id="city" name="city" required value="<?php echo $event_info['city'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="region">Region:</label>
                      <select class="form-control" id="region" name="region" required>
                        <option value="" disabled>Choose Region</option>
                        <?php for ($i=0; $i < sizeof($regions); $i++) { ?>
                        <option value="<?php echo $regions[$i]['region_id'] ?>" <?php echo $event_info['region'] == $regions[$i]['region_id']? "selected" : ""; ?>><?php echo $regions[$i]['long_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="max_attendees">Max Attendees:</label>
                      <input type="number" class="form-control" id="max_attendees" name="max_attendees" required value="<?php echo $event_info['max_attendees'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="description">Descripiton:</label>
                      <textarea name="description" id="description" class="form-control"><?php echo $event_info['description'] ?></textarea>
                    </div>
                    <div class="text-center">
                      <br>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <input type="submit" name="edit_event" value="Save" class="btn btn-primary bttn">
                  <a class="btn btn-danger bttn" href="events.php">Cancel</a>
                  <br><br>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('includes/scripts.php'); ?>
  </body>
</html>
