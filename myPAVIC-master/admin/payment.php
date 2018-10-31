<?php
include('php/admin_session.php');

$sql = "SELECT * FROM pavic_advocates_payments WHERE advocates_payment_id = ".$_GET['advocates_payment_id'].";";

$result = $mysqli->query($sql);

if($result->num_rows == 1){
  $row = $result->fetch_assoc();

  header('Content-Disposition: inline; filename="'.$row['payment_slip_file_name'].'"');
  header("content-type: ".$row['payment_slip_mime_type']);
  echo $row['payment_slip'];
}
?>
