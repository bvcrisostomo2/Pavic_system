<?php
  include 'php/admin_session.php';

  $previous = '';
  $message = '';

  if(isset($_GET['error'])){

    switch ($_GET['error']) {
      case 1:
        if (isset($_GET['advocate_id'])) {
          $previous = 'add-child.php?advocate_id='.$_GET['advocate_id'];
          $message = 'adding a child';
        }
        break;
      case 2:
        $previous = 'create-admin.php';
        $message = 'creating an admin';
        break;
      case 3:
        $previous = 'reports.php';
        $message = 'creating a report';
        break;
      case 4:
        $previous = 'edit-account.php';
        $message = 'editting your account';
        break;
      case 5:
        if (isset($_GET['admin_id'])) {
          $previous = 'edit-admin.php?admin_id='.$_GET['admin_id'];
          $message = 'editting an admin';
        }
        break;
      case 6:
        if (isset($_GET['advocate_id'])) {
          $previous = 'edit-advocate.php?advocate_id='.$_GET['advocate_id'];
          $message = 'editting an advocate';
        }
        break;
      case 7:
        if (isset($_GET['advocate_id']) && isset($_GET['child_id'])) {
          $previous = 'edit-child.php?advocate_id='.$_GET['advocate_id'].'&child_id='.$_GET['child_id'];
          $message = 'adding a child';
        }
        break;
      case 8:
        $previous = 'administrators.php';
        $message = 'removing an admin';
        break;
      case 9:
        $previous = 'advocates.php';
        $message = 'removing an advocate';
        break;
      case 10:
        if (isset($_GET['previous'])) {
          $previous = $_GET['previous'];
          $message = 'removing a child';
        }
        break;
      case 11:
        $previous = 'reports.php';
        $message = 'removing a report';
        break;
      case 12:
        $previous = 'anouncements.php';
        $message = 'removing anouncement';
        break;
      case 13:
        $previous = 'anouncements.php';
        $message = 'adding anouncement';
        break;
      case 14:
        $previous = 'unconfirmed.php';
        $message = 'rejecting advocate payment';
        break;
      case 15:
        $previous = 'unconfirmed.php';
        $message = 'confirming advocate payment';
        break;
      case 16:
        $previous = 'events.php';
        $message = 'creating event';
        break;
      case 17:
        $previous = 'events.php';
        $message = 'editting event';
        break;
      default:
        $previous = '';
        $message = '';
        break;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Error - PAVIC</title>

    <?php include 'includes/links.php'; ?>
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
      <div class="row">
        <div class="jumbotron push-down">
          <div class="hero-unit text-center">
              <h1>OOPS! <small><font face="Tahoma" color="red">Something Went Wrong!</font></small></h1>
              <br />
              <p>The was a problem in <?php echo $message; ?>, please try again or if the problem persists contact your webmaster. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from</p>
              <p><b>Or you could just press this neat little button:</b></p>
              <a href="<?php echo $previous; ?>" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Take Me Home</a>
          </div>
        </div>
      </div>
    </div>

    <?php include 'includes/scripts.php'; ?>
  </body>
</html>
