<?php
  if (file_exists('../php/dbconfig.php')) {
    include('../php/dbconfig.php');
  }elseif (file_exists('../../php/dbconfig.php')) {
    include('../../php/dbconfig.php');
  }

  session_start();

  if(isset($_SESSION['advocate_id'])){
    $advocate_id = $_SESSION['advocate_id'];

    $sql = "SELECT * FROM pavic_advocates WHERE advocate_id = $advocate_id";

    $result = $mysqli->query($sql);

    if($row = $result->fetch_assoc()){
      $advocate_info = $row;
    }
  }else{
    header('location: login.php');
  }
?>
