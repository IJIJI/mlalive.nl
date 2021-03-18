
<?php 
	session_start();

	$currentPage = 'Login';
	$navbarTop = false;	

	include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_functions.php');

	$user_data = verifyAccount($con, 0);
?>


<!doctype html> 
<html>
<head>

	<meta charset="utf-8">

	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/nav.css">
	<link rel="stylesheet" href="/css/accountForm.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="shortcut icon" href="/img/tertair.png" type="image/x-icon"/> 

	<title>MLA Live - <?php echo($currentPage); ?></title>
	<meta name="description" content="Het MLA Live webportaal.">

	<?php echo('<meta property="og:title" content="MLA live - '.$currentPage.'">'); ?>

	<meta property="og:description" content="Het MLA Live webportaal.">
	<meta property="og:url" content="https://mlalive.nl/">
	<meta property="og:image" content="/img/tertair.png">
	
</head>
	
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/nav.php'); ?>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/login_code.php'); ?>
<!--	<?php echo($currentPage); ?>-->
<!--	<?php echo($_SESSION['userID']); ?>-->

	
	<div class="login-page">
		<div class="form">
			<form method="post" class="login-form">
				<h1>ACCOUNT LOGIN</h1>
<!--
				<input type="text" placeholder="mail"/>
				<input type="password" placeholder="password"/>
-->
				<div class="textbox">
					 <input type="email" placeholder="mail" name="userMail" contenteditable="false"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="password" placeholder="wachtoord" name="userPassword"/>
					 <div class="border"></div>
				</div>
				
				
<!--				<input class="submitButton" id="button" type="submit" value="Login">-->
				<button id="button">login</button>
				<p class="message">Not registered?</p>
				<a class="message" href="/account/register.php?<?php echo $_SERVER['QUERY_STRING']?>">Create an account</a>
			</form>
		</div>
	</div>

	
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>