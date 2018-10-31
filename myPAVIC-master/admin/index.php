<?php
include('php/admin_session.php');
if (isset($admin_info)) {
  header('location: overview.php');
}
?>
