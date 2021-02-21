
<?php 
	$currentPage = 'Register';
	$navbarTop = false;
?>


<?php 
session_start();

	include($_SERVER['DOCUMENT_ROOT'].'/account/account_connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'/account/account_functions.php');


//	if($_SERVER['REQUEST_METHOD'] == "POST")
	if(isset($_POST['userName']) && isset($_POST['userSurName']) && isset($_POST['userMail']) && isset($_POST['userPassword']))
	{
		//something was posted
		$userName = $_POST['userName'];
		$userSurName = $_POST['userSurName'];
		$userMail = $_POST['userMail'];
		$userPassword = $_POST['userPassword'];

		if(!empty($userName) && !empty($userSurName) && !empty($userMail) && !empty($userPassword) && !is_numeric($userName) && !is_numeric($userSurName) && !is_numeric($userMail))
		{

			//save to database
			$userID = random_num(20);
			$query = "insert into accounts (userID,name,surname,mail,password) values ('$userID','$userName','$userSurName','$userMail','$userPassword')";

			mysqli_query($con, $query);

			header("Location: /account/login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
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
	
	<div class="login-page">
		<div class="form">
			<form method="post" class="login-form">
				<h1>REGISTER</h1>
<!--
				<input type="text" placeholder="mail"/>
				<input type="password" placeholder="password"/>
-->
				<div class="textbox">
					 <input type="text" placeholder="voornaam" name="userName"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="text" placeholder="achternaam" name="userSurName"/>
					 <div class="border"></div>
				</div>
				<div class="textbox">
					 <input type="text" placeholder="mail" name="userMail"/>
					 <div class="border"></div>
				</div>
				
				<div class="textbox">
					 <input type="password" placeholder="wachtwoord" name="userPassword"/>
					 <div class="border"></div>
				</div>
				
				<!-- <div class="textbox">
					 <input type="password" placeholder="wachtwoord herhalen" name="userPasswordRepeat"/>
					 <div class="border"></div>
				</div> -->
				
				
				<button id="button">Register</button>
<!--				<input class="submitButton" id="button" type="submit" value="Register">-->
				<p class="message">Already registered?</p>
				<a class="message" href="/account/login.php">Log in to your account</a>
			</form>
		</div>
	</div>

</body>
</html>