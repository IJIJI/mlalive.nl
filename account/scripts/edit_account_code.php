<?php 

include($_SERVER['DOCUMENT_ROOT'].'/blocks/error_message.php');

if(!isset($_SESSION['userID'])){
	header("Location: /account/login.php");
	die;

}
elseif(	isset($_POST['userName']) && isset($_POST['userSurName']) && isset($_POST['userMail']) && isset($_POST['userTel']) && isset($_POST['userPassword'])){

	$userName = mysqli_real_escape_string($con, $_POST['userName']);
	$userSurName = mysqli_real_escape_string($con, $_POST['userSurName']);
	$userMail = mysqli_real_escape_string($con, $_POST['userMail']);
	$userTel = mysqli_real_escape_string($con, $_POST['userTel']);
	$userPassword = mysqli_real_escape_string($con, $_POST['userPassword']);

	if(	!empty($userName) && !empty($userSurName) && !empty($userMail) && !empty($userPassword) && 
			!is_numeric($userName) && !is_numeric($userSurName) ) {
		
					//read from database
		$id = $_SESSION['userID'];
		$query = "select * from accounts where userID = '$id' limit 1";
		$result = mysqli_query($con, $query);

	
		if($result && mysqli_num_rows($result) > 0)
		{

			$userData = mysqli_fetch_assoc($result);

			if(password_verify($userPassword, $userData['password']))
			{
//				$userID = random_num(20);
//				$query = "insert into accounts (userID,name,surname,mail,password) values ('$userID','$userName','$userSurName','$userMail','$userPassword')";
				if (!empty($userTel)){
					$query = "update accounts set name='$userName', surname='$userSurName', mail='$userMail', tel='$userTel' WHERE userID = $id";
				}
				else{
					$query = "update accounts set name='$userName', surname='$userSurName', mail='$userMail' WHERE userID = $id";
				}
				
				
				mysqli_query($con, $query);
				$user_data = verifyAccount($con, 0);
				sendMessage("Updated data!", 'succes');
			}
			else {
	  		errorMessage("Wrong password!");
			}
		}
		else {
	  	errorMessage("Error fetching data!");
		}
	}
	else {
		errorMessage("Please enter valid credentials!");	
	}
}
elseif (isset($_POST['userPassword']) && isset($_POST['userNewPassword']) && isset($_POST['userNewPasswordRepeat'])){

	$userPassword = $_POST['userPassword'];
	$userNewPassword = $_POST['userNewPassword'];
	$userNewPasswordRepeat = $_POST['userNewPasswordRepeat'];

	if(	!empty($userPassword) && !empty($userNewPassword) && !empty($userNewPasswordRepeat)) {
		
							//read from database
		$id = $_SESSION['userID'];
		$query = "select * from accounts where userID = '$id' limit 1";
		$result = mysqli_query($con, $query);

	
		if($result && mysqli_num_rows($result) > 0)
		{

			$userData = mysqli_fetch_assoc($result);



			if(password_verify($userPassword, $userData['password'])){
				if($userNewPassword === $userNewPasswordRepeat){
					
					$userNewPassword = password_hash($userNewPassword, PASSWORD_BCRYPT);
					$query = "update accounts set password='$userNewPassword' WHERE userID = $id";


					mysqli_query($con, $query);
					$user_data = verifyAccount($con, 0);
					sendMessage("Updated password!", 'succes');
				}
				else{
					errorMessage("Passwords do not match!");
				}
			}
			else{
				errorMessage("Wrong password!");
			}
		}
		else{
			errorMessage("Error fetching data.");	
		}
	}
	else{
		errorMessage("Please enter valid passwords!");	
	}
}

		

		
	