<?php
  include('admin_session.php');

  if(isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $advocate_id = $_POST['advocate_id'];

    $sql = "SELECT admin_id FROM pavic_admin WHERE admin_id = $admin_id AND password = '".md5($current_password)."'";
    $result = $mysqli->query($sql);

    if($result->num_rows == 1) {

      $sql = "UPDATE pavic_advocates SET password='".md5($new_password)."' WHERE advocate_id = $advocate_id";

      if ($mysqli->query($sql) === TRUE) {
        $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_advocate WHERE advocate_id = ".$advocate_id;
        if ($result = $mysqli->query($sql)) {
          if($row = $result->fetch_assoc()){
            $name = $row['name'];

            $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Changed Advocate Password: $name')";
            $mysqli->query($sql);
          }
        }
  			header('location: ../advocate-profile.php?success=2&advocate_id='.$advocate_id);
  		} else {
  			echo "Error: " . $sql . "<br>" . $mysqli->error;
        header('location: ../advocate-change-password.php?error=1&advocate_id='.$advocate_id);
      }

    }else{
      header('location: ../advocate-change-password.php?error=1$advocate_id='.$advocate_id);

    }

		$mysqli->close();
  }

?>
