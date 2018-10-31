<?php
include('admin_session.php');

if(isset($_GET['advocates_payment_id']) && isset($_GET['advocate_id'])) {
  $advocates_payment_id = $_GET['advocates_payment_id'];
  $advocate_id = $_GET['advocate_id'];

  $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_advocates WHERE advocate_id = ".$advocate_id;
  if ($result = $mysqli->query($sql)) {
    if($row = $result->fetch_assoc()){
      $name = $row['name'];

      $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Rejected Advocate Payment: $name')";
      $mysqli->query($sql);
    }
  }

  $sql = "DELETE FROM pavic_advocates_payments WHERE advocates_payment_id = $advocates_payment_id";

  if ($mysqli->query($sql) === TRUE) {
    header('location: ../unconfirmed.php?success=2');
  } else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../error.php?error=14');
  }
}
?>
