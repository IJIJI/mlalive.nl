
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

	<link rel="stylesheet" href="..\css\styles.css">
	<link rel="stylesheet" href="..\css\nav.css">
	<link rel="stylesheet" href="../css/accountForm.css">
	<link rel="stylesheet" href="../css/account.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="shortcut icon" href="/img/tertair.png" type="image/x-icon"/> 

	<meta name="author" content="Developer: IJssel Koster" />
	<title>MLA Live - <?php echo($currentPage); ?></title>
	<meta name="description" content="Het MLA Live webportaal.">

	<?php echo('<meta property="og:title" content="MLA live - '.$currentPage.'Q&A Archief">'); ?>

	<meta property="og:description" content="Het MLA Live webportaal.">
	<meta property="og:url" content="https://mlalive.nl/">
	<meta property="og:image" content="/img/tertair.png">

</head>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/nav.php'); ?>
<!--	<?php echo($currentPage); ?>-->
	
	
	<div class="login-page">
		<div class="form">
			<form action="logout.php" class="login-form">
				
				<div class="userAccount">
					<h1><?php echo($user_data['name']." ".$user_data['surname']); ?></h1>
					<a class="userAccount" href="/account/edit_account.php"><span style="font-size: inherit;" class="material-icons">edit</span></a>
				</div>

				<div class="textbox">
					 <p class="mailBox"><?php echo($user_data['mail']); ?></p>
				</div>
				
<!--
				<div class="textbox">
					 <input type="password" placeholder="oud wachtwoord" name="userPassword"/>
					 <div class="border"></div>
				</div>
				
				<div class="textbox">
					 <input type="password" placeholder="nieuw wachtwoord" name="userPassword"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="password" placeholder="herhaaling nieuw wachtwoord" name="userPassword"/>
					 <div class="border"></div>
				</div>
-->
				
				<!-- <div class="textbox">
					 <input type="password" placeholder="wachtwoord herhalen" name="userPasswordRepeat"/>
					 <div class="border"></div>
				</div> -->
				
				
				<button id="button">Log Uit</button>

			</form>
		</div>
</body>
</html>