<?php
  include('admin_session.php');

  if(isset($_POST['create_report'])) {
    $sex = $_POST['sex'];
    $cause_of_blindness = $_POST['cause_of_blindness'];
    $region = $_POST['region'];
    $vision_left = $_POST['vision_left'];
    $vision_right = $_POST['vision_right'];
    $totally_blind = $_POST['totally_blind'];
    $low_vision = $_POST['low_vision'];
    $normal_vision = $_POST['normal_vision'];
    $comments = $_POST['comments'];

    $sql = "INSERT INTO pavic_reports(sex, cause_of_blindness, region, vision_left, vision_right, totally_blind, low_vision, normal_vision, comments) VALUES ('$sex', '$cause_of_blindness', '$region', '$vision_left', '$vision_right', '$totally_blind', '$low_vision', '$normal_vision', '$comments')";

    if ($mysqli->query($sql) === TRUE) {
      $inserted_id = $mysqli->insert_id;
      $sql = "SELECT timestamp FROM pavic_reports WHERE report_id = ".$inserted_id;
      if ($result = $mysqli->query($sql)) {
        if($row = $result->fetch_assoc()){
          $timestamp = $row['timestamp'];

          $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Created Reports: $timestamp')";
          $mysqli->query($sql);
        }
      }
			header('location: ../reports.php?success=1&report_id='.$inserted_id);

		} else {
			// echo "Error: " . $sql . "<br>" . $mysqli->error;
      header('location: ../error.php?error=3');
    }

		$mysqli->close();
  }

?>
