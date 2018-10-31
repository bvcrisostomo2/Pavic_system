<?php
include('advocate_session.php');

if(isset($_GET['child_id'])) {
  $child_id = $_GET['child_id'];
  $sql = "DELETE FROM pavic_children WHERE child_id = $child_id";

  if ($mysqli->query($sql) === TRUE) {
    header('location: ../profile.php');
  } else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../error.php?error=5');

  }
}
?>
