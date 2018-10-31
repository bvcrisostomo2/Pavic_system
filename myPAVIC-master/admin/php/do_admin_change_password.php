<?php
  include('admin_session.php');

  if(isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $admin_id2 = $_POST['admin_id'];

    $sql = "SELECT admin_id FROM pavic_admin WHERE admin_id = $admin_id AND password = '".md5($current_password)."'";
    $result = $mysqli->query($sql);

    if($result->num_rows == 1) {

      $sql = "UPDATE pavic_admin SET password='".md5($new_password)."' WHERE admin_id = $admin_id2";

      if ($mysqli->query($sql) === TRUE) {
        $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_admin WHERE admin_id = ".$admin_id2;
        if ($result = $mysqli->query($sql)) {
          if($row = $result->fetch_assoc()){
            $name = $row['name'];

            $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Changed Admin Password: $name')";
            $mysqli->query($sql);
          }
        }
  			header('location: ../administrators.php?success=2');
  		} else {
  			echo "Error: " . $sql . "<br>" . $mysqli->error;
        header('location: ../admin-change-password.php?error=1&admin_id='.$admin_id2);
      }

    }else{
      header('location: ../admin-change-password.php?error=1&admin_id='.$admin_id2);

    }

		$mysqli->close();
  }

?>
