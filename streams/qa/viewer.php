
<?php 
	session_start();
//	echo session_id();

	$currentPage = 'Q&A Viewer';
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
	<link rel="stylesheet" href="/css/nav_min.css">
	<link rel="stylesheet" href="/css/qa_viewer.css">

	<script src="/js/toggle_fullscreen.js"></script>
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="shortcut icon" href="/img/tertair.png" type="image/x-icon"/> 

	<meta name="author" content="Developer: IJssel Koster" />
	<title>MLA Live - <?php echo($currentPage); ?></title>
	<meta name="description" content="Het MLA Live webportaal.">

	<?php echo('<meta property="og:title" content="MLA live - '.$currentPage.'Q&A Archief">'); ?>

	<meta property="og:description" content="Het MLA Live webportaal.">
	<meta property="og:url" content="https://mlalive.nl/">
	<meta property="og:image" content="/img/tertair.png">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/nav_min.php'); ?>
<!--	<?php echo($currentPage); ?>-->
	
<!--	<?php echo($_SESSION['userID']); ?>-->
	
	<?php
		if(isset($_GET['tableID']) && !empty($_GET['tableID'])){
//			echo "yay";

			$tableID = $_GET['tableID'];
			
			$query = "select * from streams where tableID = '$tableID' limit 1";
			$result = mysqli_query($con, $query);


			if($result && mysqli_num_rows($result) > 0)
			{

				$qaData = mysqli_fetch_assoc($result);
				echo '<iframe class="qaViewer" src="'.$qaData['qaLink'].'" frameborder="0"></iframe>';

			}
			else{

				header("Location: /streams/qa/index.php");
				die;
			}
			
		}
		else{
//			echo 'nay';
			header("Location: /streams/qa/index.php");
			die;
		}
	?>
	
<!--	<iframe class="qaViewer" src="https://vimeo.com/event/687994/chat/" frameborder="0"></iframe>-->
</body>
</html>