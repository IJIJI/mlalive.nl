
<?php 
	session_start();
//	echo session_id();

	$currentPage = 'Admin';
	$navbarTop = true;

	include($_SERVER['DOCUMENT_ROOT'].'/account/account_connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'/account/account_functions.php');

	$user_data = check_admin($con);
?>

<?php 
//session_start();

//	include($_SERVER['DOCUMENT_ROOT'].'/account/account_connection.php');
//	include($_SERVER['DOCUMENT_ROOT'].'/account/account_functions.php');

//	$user_data = check_login($con);

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