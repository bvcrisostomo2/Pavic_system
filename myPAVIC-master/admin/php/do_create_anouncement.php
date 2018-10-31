<?php
  include('admin_session.php');

  if(isset($_POST['create_anouncement'])) {
    $title = $_POST['title'];
    $text = $_POST['text'];

    $sql = "INSERT INTO pavic_anouncements(title, text) VALUES ('$title', '$text')";

    if ($mysqli->query($sql) === TRUE) {
      $sql = "SELECT title FROM pavic_anouncements WHERE anouncement_id = ".$mysqli->insert_id;
      if ($result = $mysqli->query($sql)) {
        if($row = $result->fetch_assoc()){
          $title = $row['title'];

          $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Created Anouncement: $title')";
          $mysqli->query($sql);
        }
      }
			header('location: ../anouncements.php?success=1');

		} else {
			// echo "Error: " . $sql . "<br>" . $mysqli->error;
      header('location: ../error.php?error=13');

    }

		$mysqli->close();
  }

?>
