<?php
  include('advocate_session.php');

  if(isset($_POST['edit_profile'])) {
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
    $birthday = $_POST['birthday'];
    $sex = $_POST['sex'];
    $landline = $_POST['landline'];
    $mobile_phone = $_POST['mobile_phone'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $region = $_POST['region'];
    $occupation = $_POST['occupation'];
    $spouse_first_name = $_POST['spouse_first_name'];
    $spouse_middle_name = $_POST['spouse_middle_name'];
    $spouse_last_name = $_POST['spouse_last_name'];
    $combined_income = $_POST['combined_income'];
    $relationship = $_POST['relationship'];

    $sql = "UPDATE pavic_advocates SET first_name='$first_name',middle_name='$middle_name',last_name='$last_name',birthday='$birthday',sex='$sex',mobile_phone='$mobile_phone',landline='$landline',email='$email',address_line1='$address_line1',address_line2='$address_line2',city='$city',region='$region',occupation='$occupation',combined_income='$combined_income',relationship='$relationship',spouse_first_name='$spouse_first_name',spouse_middle_name='$spouse_middle_name',spouse_last_name='$spouse_last_name' $isset_id_picture WHERE advocate_id = $advocate_id";

    if ($mysqli->query($sql) === TRUE) {
			header('location: ../profile.php');
		} else {
			// echo "Error: " . $sql . "<br>" . $mysqli->error;
      header('location: ../error.php?error=3');

    }

		$mysqli->close();
  }

?>
