<?php
  include('advocate_session.php');

  unset($_SESSION['advocate_id']);

  header('location: ../login.php');
?>
