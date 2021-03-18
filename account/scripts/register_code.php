<?php 


	include($_SERVER['DOCUMENT_ROOT'].'/blocks/error_message.php');


//	if($_SERVER['REQUEST_METHOD'] == "POST")
	if(isset($_POST['userName']) && isset($_POST['userSurName']) && isset($_POST['userMail']) && isset($_POST['userTel']) && isset($_POST['userPassword']))
	{
		//something was posted
		$userName = mysqli_real_escape_string($con, $_POST['userName']);
		$userSurName = mysqli_real_escape_string($con, $_POST['userSurName']);
		$userMail = mysqli_real_escape_string($con, $_POST['userMail']);
		$userTel = mysqli_real_escape_string($con, $_POST['userTel']);
		$userPassword = mysqli_real_escape_string($con, $_POST['userPassword']);
		$userPasswordRepeat = mysqli_real_escape_string($con, $_POST['userPasswordRepeat']);

		if(empty($userName) || empty($userSurName) || empty($userMail) || empty($userPassword) || is_numeric($userName) || is_numeric($userSurName) || is_numeric($userMail))
		{
			errorMessage("Please enter valid information!");
		}
//		elseif (!preg_match("/^[a-zA-Z-' ]*$/",$userName) || !preg_match("/^[a-zA-Z-' ]*$/",$userSurName)){
//			errorMessage("Only use letters and whitespace in your name!");
//		}
		else{
			//read from database
			$query = "select * from accounts where mail = '$userMail' limit 1";
			$result = mysqli_query($con, $query);


			if($result && mysqli_num_rows($result) > 0)
			{
				errorMessage("This email is already in use!");
			}
			elseif ($userPassword === $userPasswordRepeat){
				//save to database
				$userID = random_num(18);
				
				if (!empty($userTel)){
					$query = "insert into accounts (userID,name,surname,mail,tel,password) values ('$userID','$userName','$userSurName','$userMail','$userTel','$userPassword')";
				}
				else{
					$query = "insert into accounts (userID,name,surname,mail,password) values ('$userID','$userName','$userSurName','$userMail','$userPassword')";
				}

				mysqli_query($con, $query);

				sendMessage("Succes! Awaiting approval by admin.", 'succes');
			}
			else{
				errorMessage("Passwords do not match!");
				
			}


		}
	}
