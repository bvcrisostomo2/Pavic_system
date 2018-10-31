<?php
include('admin_session.php');

if(isset($_GET['anouncement_id'])) {
  $anouncement_id = $_GET['anouncement_id'];

  $sql = "SELECT title FROM pavic_anouncements WHERE anouncement_id = ".$anouncement_id;
  if ($result = $mysqli->query($sql)) {
    if($row = $result->fetch_assoc()){
      $title = $row['title'];

      $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Removed Anouncement: $title')";
      $mysqli->query($sql);
    }
  }

  $sql = "DELETE FROM pavic_anouncements WHERE anouncement_id = $anouncement_id";

  if ($mysqli->query($sql) === TRUE) {
    header('location: ../anouncements.php?success=2');
  } else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../error.php?error=12');
  }
}
?>
