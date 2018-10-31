<?php
  include('admin_session.php');

  if(isset($_GET['advocates_payment_id']) && isset($_GET['advocate_id'])) {
    $advocates_payment_id = $_GET['advocates_payment_id'];
    $advocate_id = $_GET['advocate_id'];
    $expiration = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day"));

    $sql = "SELECT * FROM pavic_advocates_payments WHERE advocates_payment_id = $advocates_payment_id";
    $result = $mysqli->query($sql);

    if($result->num_rows == 1){
      $sql = "UPDATE pavic_advocates_payments SET expiration = '$expiration' WHERE advocates_payment_id = $advocates_payment_id";

      if ($mysqli->query($sql) === TRUE) {
        $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_advocates WHERE advocate_id = ".$advocate_id;
        if ($result = $mysqli->query($sql)) {
          if($row = $result->fetch_assoc()){
            $name = $row['name'];

            $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Confirmed Advocate Payment: $name')";
            $mysqli->query($sql);
          }
        }
        header('location: ../unconfirmed.php?success=1');
      } else {
        // echo "Error: " . $sql . "<br>" . $mysqli->error;
        header('location: ../error.php?error=15');
      }
    }else {
      $sql = "INSERT INTO pavic_advocates_payments(advocate_id, expiration) VALUES ($advocate_id, '$expiration')";

      if ($mysqli->query($sql) === TRUE) {
        $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_advocates WHERE advocate_id = ".$advocate_id;
        if ($result = $mysqli->query($sql)) {
          if($row = $result->fetch_assoc()){
            $name = $row['name'];

            $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Confirmed Advocate Payment: $name')";
            $mysqli->query($sql);
          }
        }
        header('location: ../unpayed.php?success=1');
      } else {
        // echo "Error: " . $sql . "<br>" . $mysqli->error;
        header('location: ../error.php?error=15');
      }
    }


		$mysqli->close();
  }

?>
