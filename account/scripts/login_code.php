<?php 

include($_SERVER['DOCUMENT_ROOT'].'/blocks/error_message.php');


if(isset($_GET['redirect']) && !empty($_GET['redirect'])){
	$redirect = $_GET['redirect'];
}

if(isset($_SESSION['userID'])){

	if(isset($redirect) && !empty($redirect)){
		header("Location: ".$redirect);
		die;
	}
	else{
		header("Location: /account/index.php");
		die;
	}

}
elseif(isset($_POST['userMail']) && isset($_POST['userPassword']))
{

	//something was posted
	$userMail = mysqli_real_escape_string($con, $_POST['userMail']);
	$userPassword = mysqli_real_escape_string($con, $_POST['userPassword']);	


	if(!empty($userMail) && !empty($userPassword))
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
					if($userData['clearance'] >= 1){

						//REDIRECT
						$_SESSION['userID'] = $userData['userID'];
	
						if(isset($redirect) && !empty($redirect)){
							header("Location: ".$redirect);
							die;
						}
						else{
							header("Location: /account/index.php");
							die;
						}
					}
					elseif ($userData['clearance'] >= 0){
						errorMessage("Your account has not been activated by an administrator yet.");
					}
					else{
						errorMessage("Your account has been disabled.");
					}

				}
				else{
					errorMessage("Wrong username or password!");
				}
			}
			else{
				errorMessage("Wrong username or password!");
			}
		}
		else{
			errorMessage("Wrong username or password!");	
		}
	}else
	{
		errorMessage("Please enter valid credentials!");
	}
}


