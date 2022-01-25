<?php
session_start();
if (ISSET($_POST['submit'])){
IF ($_POST['username']=='magacioner' && $_POST['password']=="#magacin123"){
$_SESSION['username']='magacioner';	
header('Location: '.'index.php');	
} else {
	$poruka='Pogresno korisnicko ime ili lozinka';	
	}	
}

if (ISSET($_GET['logout'])) session_destroy();
?>


<!doctype html>
<html lang="en">
  <head>
  	<title>Magacin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Magacin</h3>
				<p><?php if (ISSET($poruka)) echo $poruka ?></p>
		      	<form action="#" class="signin-form" method="POST">
		      		<div class="form-group">
		      			<input type="text" class="form-control" placeholder="Username" required name="username">
		      		</div>
	            <div class="form-group">
	              <input id="password-field" type="password" class="form-control" placeholder="Password" name="password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3" name="submit">Prijavite se</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	
								
	            </div>
	          </form>

		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

