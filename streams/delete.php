<?php 
	session_start();
//	echo session_id();

	$currentPage = 'Delete';
	$navbarTop = false;	

	include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_functions.php');
	include($_SERVER['DOCUMENT_ROOT'].'/blocks/error_message.php');

	$user_data = verifyAccount($con, 18);
?>


<!doctype html> 
<html>
<head>

	<meta charset="utf-8">

	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/nav.css">
	<link rel="stylesheet" href="/css/accountForm.css">
	<link rel="stylesheet" href="/css/account.css">

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
	
	<?php if (isset($_GET['tableID']) && !empty($_GET['tableID']) && $user_data['clearance'] >= 18): 
	


	function getTable($con, $tableID){


		$tableIDescape = mysqli_real_escape_string($con, $tableID);
		$query = "select * from streams where tableID = '$tableIDescape' limit 1";

		$streamResult = mysqli_query($con,$query);
		if($streamResult && mysqli_num_rows($streamResult) > 0)
		{
			return mysqli_fetch_assoc($streamResult);
		}
		else{
				header("Location: ?");
				die;
		}
	}


	$streamData = getTable($con, $_GET['tableID']);




	if(	isset($_POST['tableID']) && isset($_POST['userPassword']) && isset($_POST['deleteCheck']) && !empty($_POST['userPassword'])){
		
		$streamData = getTable($con, $_GET['tableID']);
		
		$userPassword = mysqli_real_escape_string($con, $_POST['userPassword']);
		
//		sendMessage("Me Workie!", "succes");
		
		$id = $_SESSION['userID'];
		$query = "select * from accounts where userID = '$id' limit 1";
		$result = mysqli_query($con, $query);

	
		if($result && mysqli_num_rows($result) > 0)
		{

			$userData = mysqli_fetch_assoc($result);

			if($user_data['password'] === $userPassword)
			{
				
				$query = "DELETE FROM streams WHERE tableID=".mysqli_real_escape_string($con, $_GET['tableID']);
				
				if(mysqli_query($con, $query)){
					sendMessage("Deleted stream!", 'succes');
				}
				else{
					sendMessage("Error removing stream!", "error");				
				}		
			}
			else{
				sendMessage("Incorrect password!", "error");				
			}
		}
	}
	
	?>
	

	
	<div class="login-page">
		<div class="form">
			<form method="post" class="login-form">

				<div class="userAccount">
					<h1>Really Delete?</h1>
					<a class="userAccount" href="/streams/index.php?modal=edit&tableID=<?php echo $streamData['tableID']; ?>"><span style="font-size: inherit;" class="material-icons">close</span></a>
				</div>
	<!--
				<input type="text" placeholder="mail"/>
				<input type="password" placeholder="password"/>
	-->
				<p><strong><?php echo $streamData['name']; ?></strong> <?php echo date("d-m-Y H:i", strtotime($streamData['date'])) ?></p>
				<div class="textbox">
				 	<input type="password" placeholder="password" name="userPassword"/>
				 	<div class="border"></div>
				</div>
				<input style="display: none" type="checkbox" checked value="1" name="deleteCheck">
				<input style="display: none" type="text" value="<?php echo $streamData['tableID']; ?>" name="tableID">

	<!--				<input class="submitButton" id="button" type="submit" value="Login">-->
				<button id="button">Delete</button>
			</form>
		</div>
	</div>
	<?php else: 
	
	errorMessage("Stream not found!", "error");
	?>
	
	<?php endif; ?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>