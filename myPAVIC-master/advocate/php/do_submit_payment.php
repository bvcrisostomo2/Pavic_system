<?php
  include('advocate_session.php');

  if(isset($_POST['submit_payment'])) {
    $payment_method = isset($_POST['payment_method'])? $_POST['payment_method'] : "";
    $payment_slip = addslashes(file_get_contents($_FILES['payment_slip']['tmp_name']));
    $payment_slip_mime_type = $_FILES['payment_slip']['type'];
    $payment_slip_file_name = $_FILES['payment_slip']['name'];

    $sql = "INSERT INTO pavic_advocates_payments(advocate_id, payment_method, payment_slip, payment_slip_mime_type, payment_slip_file_name) VALUES ($advocate_id, '$payment_method', '{$payment_slip}', '$payment_slip_mime_type', '$payment_slip_file_name');";

    if ($mysqli->query($sql) === TRUE) {
			header('location: ../profile.php');

		} else {
			// echo "Error: " . $sql . "<br>" . $mysqli->error;
      header('location: ../error.php?error=6');

    }

		$mysqli->close();
  }

?>
