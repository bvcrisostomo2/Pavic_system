<?php
include('../../php/dbconfig.php');
session_start();

if(isset($_SESSION['admin_id'])){
  header("location: profile.php");
}

if(isset($_POST["login"])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT admin_id FROM pavic_admin WHERE email = '$email' AND password = '".md5($password)."'";
  $result = $mysqli->query($sql);

  if($result->num_rows == 1) {
    $row = $result->fetch_assoc();

    $_SESSION['admin_id'] = $row['admin_id'];

    $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES (".$_SESSION['admin_id'].", 'Logged In')";
    $mysqli->query($sql);

    header("location: ../overview.php");
  }else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../login.php?error=1');
  }
}
?>
