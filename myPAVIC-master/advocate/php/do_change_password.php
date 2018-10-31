<?php
  include('advocate_session.php');

  if(isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $sql = "SELECT advocate_id FROM pavic_advocates WHERE advocate_id = $advocate_id AND password = '".md5($current_password)."'";
    $result = $mysqli->query($sql);

    if($result->num_rows == 1) {

      $sql = "UPDATE pavic_advocates SET password='".md5($new_password)."' WHERE advocate_id = $advocate_id AND password = '".md5($current_password)."'";

      if ($mysqli->query($sql) === TRUE) {
  			header('location: ../profile.php');
  		} else {
  			echo "Error: " . $sql . "<br>" . $mysqli->error;
        header('location: ../change-password.php?error=1');
      }

    }else{
      header('location: ../change-password.php?error=1');

    }

		$mysqli->close();
  }

?>
