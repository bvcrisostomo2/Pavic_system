<?php
  include 'php/admin_session.php';

  $previous = '';
  $message = '';

  if(isset($_GET['error'])){

    switch ($_GET['error']) {
      case 1:
        $previous = 'add-child.php';
        $message = 'adding a child';
        break;
      case 2:
        if (isset($_GET['child_id'])) {
          $previous = 'edit-child.php?child_id='.$_GET['child_id'];
          $message = 'edditing a child';
        }
        break;
      case 3:
        $previous = 'edit-profile.php';
        $message = 'editting your profile';
        break;
      case 4:
        $previous = 'register.php';
        $message = 'registering';
        break;
      case 5:
        $previous = 'profile.php';
        $message = 'removing child';
        break;
      case 6:
        $previous = 'submit-payment.php';
        $message = 'submitting payment slip';
        break;
      case 7:
      $previous = 'profile.php';
      $message = 'getting tickets';
        break;
      case 8:
      $previous = 'profile.php';
      $message = 'editting tickets';
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
