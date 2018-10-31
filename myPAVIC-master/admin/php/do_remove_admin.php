<?php
include('admin_session.php');

if(isset($_GET['admin_id'])) {
  $admin_id2 = $_GET['admin_id'];

  $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_admin WHERE admin_id = ".$admin_id2;
  if ($result = $mysqli->query($sql)) {
    if($row = $result->fetch_assoc()){
      $name = $row['name'];

      $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Deleted Admin: $name')";
      $mysqli->query($sql);
    }
  }

  $sql = "DELETE FROM pavic_admin WHERE admin_id = $admin_id2";

  if ($mysqli->query($sql) === TRUE) {
    header('location: ../administrators.php?success=4');
  } else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../error.php?error=8');
  }
}
?>
