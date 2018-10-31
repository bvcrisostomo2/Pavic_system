<?php
  include('admin_session.php');

  if(isset($_POST['create_admin'])) {
    $id_picture = addslashes(file_get_contents($_FILES['id_picture']['tmp_name']));
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $head = $_POST['head'] == "Yes"? 1 : 0;
    $phone = $_POST['phone'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $region = $_POST['region'];

    $sql = "INSERT INTO pavic_admin(first_name, middle_name, last_name, phone, email, password, address_line1, address_line2, city, region, head, id_picture) VALUES ('$first_name', '$middle_name', '$last_name', '$phone', '$email', '".md5($password)."', '$address_line1', '$address_line2', '$city', '$region', $head, '{$id_picture}')";

    if ($mysqli->query($sql) === TRUE) {
      $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_admin WHERE admin_id = ".$mysqli->insert_id;
      if ($result = $mysqli->query($sql)) {
        if($row = $result->fetch_assoc()){
          $name = $row['name'];

          $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Created Admin: $name')";
          $mysqli->query($sql);
        }
      }
			header('location: ../administrators.php?success=3');

		} else {
			// echo "Error: " . $sql . "<br>" . $mysqli->error;
      header('location: ../error.php?error=2');

    }

		$mysqli->close();
  }

?>
