<?php
  include('admin_session.php');

  if(isset($_POST['edit_admin'])) {
    if ($_FILES['id_picture']['size'] != 0) {
      $id_picture = addslashes(file_get_contents($_FILES['id_picture']['tmp_name']));
      $isset_id_picture = ",id_picture='{$id_picture}'";
    }else{
      $isset_id_picture = "";
    }
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $head = $_POST['head'] == "Yes"? 1 : 0;
    $phone = $_POST['phone'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    $admin_id2 = $_POST['admin_id'];

    $sql = "UPDATE pavic_admin SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',head=$head,phone='$phone',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',region='$region' $isset_id_picture WHERE admin_id = $admin_id2";

    if ($mysqli->query($sql) === TRUE) {
      $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_admin WHERE admin_id = ".$admin_id2;
      if ($result = $mysqli->query($sql)) {
        if($row = $result->fetch_assoc()){
          $name = $row['name'];

          $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Edited Admin: $name')";
          $mysqli->query($sql);
        }
      }
			header('location: ../administrators.php?success=1');
		} else {
			// echo "Error: " . $sql . "<br>" . $mysqli->error;
      header('location: ../error.php?error=5&admin_id='.$admin_id2);
    }

		$mysqli->close();
  }

?>
