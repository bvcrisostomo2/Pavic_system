<?php
include('admin_session.php');

if(isset($_GET['child_id']) && isset($_GET['previous'])) {
  $child_id = $_GET['child_id'];

  $sql = "SELECT CONCAT(first_name,' ', middle_name, ' ', last_name) name FROM pavic_children WHERE children_id = ".$children_id;
  if ($result = $mysqli->query($sql)) {
    if($row = $result->fetch_assoc()){
      $name = $row['name'];

      $sql = "INSERT INTO pavic_admin_logs(admin_id, activity) VALUES ($admin_id, 'Deleted Child: $name')";
      $mysqli->query($sql);
    }
  }

  $sql = "DELETE FROM pavic_children WHERE child_id = $child_id";

  if ($mysqli->query($sql) === TRUE) {
    header('location: ../'.$_GET['previous'].'&success=4');
  } else {
    // echo "Error: " . $sql . "<br>" . $mysqli->error;
    header('location: ../error.php?error=10&previous='.$_GET['previous']);
  }
}
?>
