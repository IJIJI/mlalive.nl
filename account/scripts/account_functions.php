<?php

function verifyAccount($con, $minClearance){
	if (isset($_SESSION['userID'])){
		
		$id = $_SESSION['userID'];
		$query = "select * from accounts where userID = '$id' limit 1";
		
		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			
			if(false){
				
			}
			elseif($user_data['clearance'] <= 0){
				unset($_SESSION['userID']);
				
				if ($minClearance > 0){
					header("Location: /account/login.php?redirect=".urlencode($_SERVER['REQUEST_URI']));
					die;					
				}
				
			}
			else{
				return $user_data;
			}

		}
//		maybe add a logout if user doesn't exist anymore?
		
	}
	elseif ($minClearance <= 0) {
		return null;
	}
	else{
		header("Location: /account/login.php?redirect=".urlencode($_SERVER['REQUEST_URI']));
		die;
	}
}

function random_num($length)
{

	$text = "";


	for ($i=0; $i < $length; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}


function idUser($con, $userID){
		$query = "select * from accounts where userID = '$userID' limit 1";

		$creatorResult = mysqli_query($con,$query);
		if($creatorResult && mysqli_num_rows($creatorResult) > 0)
		{
			return $creatorData = mysqli_fetch_assoc($creatorResult);
		}
		else{
			return null;
		}
}

function idUserName($con, $userID) {
	$userData = idUser($con, $userID);
	return $userData['name'];
}

function idUserSurname($con, $userID) {
	$userData = idUser($con, $userID);
	return $userData['surname'];
}

function idUserFullName($con, $userID) {
	return idUserName($con, $userID)." ".idUserSurname($con, $userID);
}

//vv loesoe




//function check_login($con)
//{
//
//	if(isset($_SESSION['userID']))
//	{
//
//		$id = $_SESSION['userID'];
//		$query = "select * from accounts where userID = '$id' limit 1";
//
//		$result = mysqli_query($con,$query);
//		if($result && mysqli_num_rows($result) > 0)
//		{
//
//			$user_data = mysqli_fetch_assoc($result);
//			return $user_data;
//		}
//	}
//
//	//redirect to login
//	header("Location: /account/login.php");
//	die;
//
//}

//function check_admin($con) {
//	$user_data = check_login($con);
//	if($user_data['clearance'] >= 8){
//		return $user_data;
//	}
//	header("Location: /account/login.php");
////	header("Location: {$_SERVER['HTTP_REFERER']}");
//	die;
//}

