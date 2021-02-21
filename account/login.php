
<?php 
	$currentPage = 'Login';
	$navbarTop = false;

?>
<?php 

session_start();

	include($_SERVER['DOCUMENT_ROOT'].'/account/account_connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'/account/account_functions.php');


	if($_SERVER['REQUEST_METHOD'] == "POST") 		
	{

		
		//something was posted
		$userMail = $_POST['userMail'];					
//		$userMail = 'klompmans@gmail.com';
		$userPassword = $_POST['userPassword'];	
//		$userPassword = 'klompie';

		if(!empty($userMail) && !empty($userPassword) && !is_numeric($userMail))
		{

			//read from database
			$query = "select * from accounts where mail = '$userMail' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$userData = mysqli_fetch_assoc($result);
					
					
					
					if($userData['password'] === $userPassword)
					{
						
						$_SESSION['userID'] = $userData['userID'];
						$_SESSION['userClearance'] = $userData['clearance'];
						$_SESSION['userName'] = $userData['name'];
						$_SESSION['userSurname'] = $userData['surname'];
						header("Location: /account/index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>
	<?php 

//		$query = "select * from accounts where mail = 'klompmans@gmail.com' limit 1";
//		$result = mysqli_query($con, $query);
//		$userData = mysqli_fetch_assoc($result);
//	
//		echo($_SESSION['userID']); 
//		echo($userData['userID']);
//	
//		$_SESSION['userID'] = $userData['userID'];
//	
//		echo($_SESSION['userID']); 
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

	<title>MLA Live - <?php echo($currentPage); ?></title>
	<meta name="description" content="Het MLA Live webportaal.">

	<?php echo('<meta property="og:title" content="MLA live - '.$currentPage.'">'); ?>

	<meta property="og:description" content="Het MLA Live webportaal.">
	<meta property="og:url" content="https://mlalive.nl/">
	<meta property="og:image" content="/img/tertair.png">
	
</head>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/nav.php'); ?>
<!--	<?php echo($currentPage); ?>-->
<!--	<?php echo($_SESSION['userID']); ?>-->

	
	<div class="login-page">
		<div class="form">
			<form method="post" class="login-form">
				<h1>ACCOUNT LOGIN</h1>
<!--
				<input type="text" placeholder="mail"/>
				<input type="password" placeholder="password"/>
-->
				<div class="textbox">
					 <input type="text" placeholder="mail" name="userMail"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="password" placeholder="wachtoord" name="userPassword"/>
					 <div class="border"></div>
				</div>
				
				
<!--				<input class="submitButton" id="button" type="submit" value="Login">-->
				<button id="button">login</button>
				<p class="message">Not registered?</p>
				<a class="message" href="/account/register.php">Create an account</a>
			</form>
		</div>
	</div>

</body>
</html>