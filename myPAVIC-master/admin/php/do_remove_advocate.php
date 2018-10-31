<?php
include('admin_session.php');

if(isset($_GET['advocate_id']) && isset($_GET['previous'])) {
  $advocate_id = $_GET['advocate_id'];

  $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_advocates WHERE advocate_id = ".$advocate_id;
  if ($result = $mysqli->query($sql)) {
    if($row = $result->fetch_assoc()){
      $name = $row['name'];

      $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Deleted Advocate: $name')";
      $mysqli->query($sql);
    }
  }

  $sql = "DELETE FROM pavic_advocate WHERE advocate_id = $advocate_id";

  if ($mysqli->query($sql) === TRUE) {
    header('location: ../'.$_GET['previous'].'&success=7');
  } else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../error.php?error=9');
  }
}
?>
