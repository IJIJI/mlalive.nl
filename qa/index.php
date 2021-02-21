
<?php 
	session_start();
//	echo session_id();

	$currentPage = 'Q&A';
	$navbarTop = true;
?>


<!doctype html> 
<html>
<head>

	<meta charset="utf-8">

	<link rel="stylesheet" href="\css\styles.css">
	<link rel="stylesheet" href="\css\nav.css">

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
	<?php echo($currentPage); ?>
	

</body>
</html>