
<?php 
	session_start();
//	echo session_id();

	$currentPage = 'Home';
	$navbarTop = true;

	include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_functions.php');


	$user_data = verifyAccount($con, 0);
?>


<!doctype html> 
<html>
<head>

	<meta charset="utf-8">

	<link rel="stylesheet" href="css\styles.css">
	<link rel="stylesheet" href="css\nav.css">
	<link rel="stylesheet" href="css\home.css">

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
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/nav.php'); ?>
<!--	<?php echo($currentPage); ?>-->
	
<!--	<?php echo($_SESSION['userID']); ?>-->
	
<?php // Permanent 301 Redirect via PHP
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /streams/index.php");
	exit();
?>
	
	<main class="home">
		<div class="home">
			<img src="/img/logo_live.svg" alt="">
			<h1>Web Portaal</h1>
			<div class="home">
				<a href="/account/login.php">Login</a>
				<a href="/account/login.php">Register</a>
			</div>
		</div>
	</main>
</body>
</html>