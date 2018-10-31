<?php
  include('../../php/dbconfig.php');

  if(isset($_POST['register'])) {
    $id_picture = addslashes(file_get_contents($_FILES['id_picture']['tmp_name']));
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
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

    $sql = "INSERT INTO pavic_advocates(first_name, middle_name, last_name, birthday, sex, mobile_phone, landline, email, password, address_line1, address_line2, city, region, occupation, spouse_first_name, spouse_middle_name, spouse_last_name, combined_income, relationship, id_picture) VALUES ('$first_name','$middle_name','$last_name','$birthday','$sex','$mobile_phone','$landline','$email','".md5($password)."','$address_line1','$address_line2','$city','$region','$occupation','$spouse_first_name','$spouse_middle_name','$spouse_last_name','$combined_income','$relationship', '{$id_picture}');";

    if ($mysqli->query($sql) === TRUE) {
			header('location: ../login.php');

		} else {
			// echo "Error: " . $sql . "<br>" . $mysqli->error;
      header('location: ../error.php?error=4');

    }

		$mysqli->close();
  }

?>
