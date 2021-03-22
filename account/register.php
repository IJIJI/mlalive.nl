
<?php 
	session_start();

	$currentPage = 'Register';
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

	<meta name="author" content="Developer: IJssel Koster" />
	<title>MLA Live - <?php echo($currentPage); ?></title>
	<meta name="description" content="Het MLA Live webportaal.">

	<?php echo('<meta property="og:title" content="MLA live - '.$currentPage.'">'); ?>

	<meta property="og:description" content="Het MLA Live webportaal.">
	<meta property="og:url" content="https://mlalive.nl/">
	<meta property="og:image" content="/img/tertair.png">
	
</head>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/nav.php'); ?>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/register_code.php'); ?>
<!--	<?php echo($currentPage); ?>-->
	
	<div class="login-page">
		<div class="form">
			<form method="post" class="login-form">
				<h1>REGISTER</h1>
<!--
				<input type="text" placeholder="mail"/>
				<input type="password" placeholder="password"/>
-->	
				<div class="textbox">
					 <input type="text" placeholder="Name" name="userName" />
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="text" placeholder="Surname" name="userSurName"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="email" placeholder="Mail" name="userMail"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="tel" placeholder="Tel." name="userTel"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="password" placeholder="Password" name="userPassword"/>
					 <div class="border"></div>
				</div>
				
				 <div class="textbox">
					 <input type="password" placeholder="Repeat Password" name="userPasswordRepeat"/>
					 <div class="border"></div>
				</div> 
				
				
				<button id="button">Register</button>
<!--				<input class="submitButton" id="button" type="submit" value="Register">-->
				<p class="message">Already registered?</p>
				<a class="message" href="/account/login.php?<?php echo $_SERVER['QUERY_STRING']?>">Log in to your account</a>
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