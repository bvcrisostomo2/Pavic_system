<?php
include('php/advocate_session.php');

$sql = "SELECT * FROM pavic_children WHERE child_id = ".$_GET['child_id'].";";

$result = $mysqli->query($sql);

if($result->num_rows == 1){
  $row = $result->fetch_assoc();

  header("content-type: ".$row['medical_history_mime_type']);
  echo $row['medical_history'];
}
?>
