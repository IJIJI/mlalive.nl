
<?php 
	$currentPage = 'Admin';
	$navbarTop = true;
?>


<!doctype html>
<html>
<head>
<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/standard_head.php'); ?>
</head>

<body>
	
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/nav.php'); ?>
	<?php echo($currentPage); ?>
	
</body>
</html>