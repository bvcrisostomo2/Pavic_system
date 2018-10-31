<?php
include('../../php/dbconfig.php');
session_start();

if(isset($_SESSION['advocate_id'])){
  header("location: profile.php");
}

if(isset($_POST["login"])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT advocate_id FROM pavic_advocates WHERE email = '$email' AND password = '".md5($password)."'";
  $result = $mysqli->query($sql);

  if($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    $_SESSION['advocate_id'] = $row['advocate_id'];

    header("location: ../profile.php");
  }else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../login.php?error=1');
  }
}
?>
