<?php
include('admin_session.php');

if(isset($_GET['report_id'])) {
  $report_id = $_GET['report_id'];

  $sql = "SELECT timestamp FROM pavic_reports WHERE report_id = ".$report_id;
  if ($result = $mysqli->query($sql)) {
    if($row = $result->fetch_assoc()){
      $timestamp = $row['timestamp'];

      $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Removed Reports: $timestamp')";
      $mysqli->query($sql);
    }
  }

  $sql = "DELETE FROM pavic_reports WHERE report_id = $report_id";

  if ($mysqli->query($sql) === TRUE) {
    header('location: ../reports.php?success=2');
  } else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../error.php?error=11');
  }
}
?>
