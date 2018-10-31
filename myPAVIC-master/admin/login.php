<?php
if (isset($_GET['error']) && $_GET['error'] == 1) {
  $error_message = "The password is invalid or the user does not have a password.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Admin Login - PAVIC</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <!-- Bootstrap Css -->
    <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="../lib/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="../lib/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="../lib/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="../lib/Lightbox/dist/css/lightbox.css" rel="stylesheet">
    <link href="../lib/Icons/et-line-font/style.css" rel="stylesheet">
    <link href="../lib/animate.css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

</head>

<body>
    <section class"advocate">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="#"><img src="../img/paviclogo2.png" height="80"></a>
                </div>
                <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
                    <div class="col-md-8 col-xs-13 nav-wrap">
                        <ul class="nav navbar-nav">
                            <li><a href="../index.php" class="page-scroll">Home</a></li>
                            <li><a href="../index.php#about" class="page-scroll">About</a></li>
                            <li><a href="../advocate/register.php">Register</a></li>
                            <li><a href="../advocate">Login</a></li>
                            <li><a href="../admin">Admin</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
		</section>
		<div class="center1">
			<div class="container wrapper">
      			<div class="row">
      			 <div class="col-md-6 text-center">
       		   <img src="../img/paviclogo2.png" alt="" width="60%">
          		<h2>Welcome Admin!</h2>
        		</div>
       		<div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">Log In</div>
            <div class="panel-body">
              <div class="text-center">
                <?php
                if (isset($error_message)) {
                  echo "<span style='color:red'>$error_message</span>";
                }
                ?>
              </div>
                            <form class="" action="php/do_login.php" method="post">
                <span class="input input--nao">
					<input class="input__field input__field--nao" type="email" id="email" name="email"/>
					<label class="input__label input__label--nao" for="input-1">
						<span class="input__label-content input__label-content--nao">Email Address</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span>
				<br>
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="password" id="password" name="password"/>
					<label class="input__label input__label--nao" for="input-1">
						<span class="input__label-content input__label-content--nao">Password</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span>
				<br>
				<button class="btn1 btn1-6 btn1-6l" name="login" id="login" type="submit">Login</button>
				<br>
                  
              </form>
    	   </div>
          </div>
         </div>
      	</div>
       </div>
    <script src="js/classie.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="../lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="../lib/jquery.easing.min.js"></script>
    <script src="../lib/waypoints/jquery.waypoints.min.js"></script>
    <script src="../lib/countTo/jquery.countTo.js"></script>
    <script src="../lib/inview/jquery.inview.min.js"></script>
    <script src="../lib/Lightbox/dist/js/lightbox.min.js"></script>
    <script>
			(function() {
				if (!String.prototype.trim) {
					(function() {P
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );
				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}
				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
			})();
		</script>

</body>

</html>
