
<?php 
	session_start();
//	echo session_id();

	$currentPage = 'Account';
	$navbarTop = true;

	include("scripts/account_connection.php");
	include("scripts/account_functions.php");

	$user_data = verifyAccount($con, 1);

?>


<!doctype html> 
<html>
<head>

	<meta charset="utf-8">

	<link rel="stylesheet" href="../css/styles.css">
	<link rel="stylesheet" href="../css/nav.css">
	<link rel="stylesheet" href="../css/accountForm.css">
	<link rel="stylesheet" href="../css/account.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="shortcut icon" href="/img/tertair.png" type="image/x-icon"/> 

	<title>MLA Live - <?php echo($currentPage); ?></title>
	<meta name="description" content="Het MLA Live webportaal.">

	<?php echo('<meta property="og:title" content="MLA live - '.$currentPage.'Q&A Archief">'); ?>

	<meta property="og:description" content="Het MLA Live webportaal.">
	<meta property="og:url" content="https://mlalive.nl/">
	<meta property="og:image" content="/img/tertair.png">

</head>
<body>
	
	<?php include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/edit_account_code.php'); ?>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/nav.php'); ?>
	
<!--	<?php echo($currentPage); ?>-->
	
	<div class="login-page">
		<div class="form">
			<form method="post" class="login-form">
					
				<div class="userAccount">
			 		<h1>GEGEVENS</h1>
					<a class="userAccount" href="/account/index.php"><span style="font-size: inherit;" class="material-icons">close</span></a>
				</div>

				<div class="textbox">
					 <input type="text" placeholder="Name" value="<?php echo($user_data['name']); ?>" name="userName"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="text" placeholder="Surname" value="<?php echo($user_data['surname']); ?>" name="userSurName"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="email" placeholder="Mail" value="<?php echo($user_data['mail']); ?>" name="userMail"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="tel" placeholder="Tel." value="<?php echo($user_data['tel']); ?>" name="userTel"/>
					 <div class="border"></div>
				</div>				
				<div class="textbox">
					 <input type="password" placeholder="Password" name="userPassword"/>
					 <div class="border"></div>
				</div>
				
				
				<input type="hidden" name="action" value="credentials">
				<input class="submitButton" id="button" type="submit" value="Gegevens Aanpassen">
			</form>
			<form method="post" class="login-form">
				<h1>WACHTWOORD</h1>

				
				<div class="textbox">
					 <input type="password" placeholder="Old Password" name="userPassword"/>
					 <div class="border"></div>				
				</div>
				<div class="textbox">
					 <input type="password" placeholder="New Password" name="userNewPassword"/>
					 <div class="border"></div>				
				</div>
				<div class="textbox">
					 <input type="password" placeholder="Repeat New Password" name="userNewPasswordRepeat"/>
					 <div class="border"></div>				
				</div>
				
				
				<input type="hidden" name="action" value="password">
				<input class="submitButton" id="button" type="submit" value="Wachtwoord Aanpassen">
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