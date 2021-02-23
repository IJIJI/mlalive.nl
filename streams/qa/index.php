
<?php 
	session_start();
//	echo session_id();

	$currentPage = 'Q&A';
	$navbarTop = true;	

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
	<link rel="stylesheet" href="/css/qa_page.css">

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
	
	<main class="qaList">
		<div class="qaMainTitle">
			<h1>Q&amp;A's</h1>
			
			<?php if (isset($_SESSION['userID']) && $user_data['clearance'] >= 16): ?>
			<a href="/account/edit_account.php"><span style="font-size: inherit;" class="material-icons">add</span></a>
			<?php endif; ?>
		</div>
		
		<a class="qaItem" href="/streams/qa/viewer.php?title=RepititieOuderWebinar_2021-02-11">
			<div class="qaTitle">
				<h1>Repititie Ouder Webinar</h1>
				<p>2021-02-11</p>	
			</div>
			<p class="qaDescription"></p>
			<?php if (isset($_SESSION['userID']) && $user_data['clearance'] >= 15): ?>
			<div class="qaDetails">
				<p>IJssel Koster</p>	
				<p>2021-02-23 09:11:20</p>
			</div>
			<?php endif; ?>
		</a>

		<a class="qaItem" href="/streams/qa/viewer.php">
			<div class="qaTitle">
				<h1>Generale Open dag</h1>
				<p>2021-01-28</p>	
			</div>
			<p class="qaDescription"></p>
			<?php if (isset($_SESSION['userID']) && $user_data['clearance'] >= 15): ?>
			<div class="qaDetails">
				<p>IJssel Koster</p>	
				<p>2021-02-23 10:42:58</p>	
			</div>
			<?php endif; ?>
		</a>
	</main>
</body>
</html>