<?php
include('php/advocate_session.php');
if (isset($advocate_info)) {
  header('location: profile.php');
}
?>
