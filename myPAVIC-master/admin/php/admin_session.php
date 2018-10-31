<?php
  if (file_exists('../php/dbconfig.php')) {
    include('../php/dbconfig.php');
  }elseif (file_exists('../../php/dbconfig.php')) {
    include('../../php/dbconfig.php');
  }

  session_start();

  if(isset($_SESSION['admin_id'])){
    $admin_id = $_SESSION['admin_id'];

    $sql = "SELECT * FROM pavic_admin WHERE admin_id = $admin_id";

    $result = $mysqli->query($sql);

    $admin_info = mysqli_fetch_assoc($result);
  }else{
    header('location: login.php');
  }
?>
