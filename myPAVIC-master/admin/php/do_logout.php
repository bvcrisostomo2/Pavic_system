<?php
  include('admin_session.php');

  $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Logged Out')";
  $mysqli->query($sql);

  unset($_SESSION['admin_id']);

  header('location: ../login.php');
?>
