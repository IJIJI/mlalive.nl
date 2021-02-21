<?php

//function verifyAccount($con, $minClearance){
//	if (isset($_SESSION['userID'])){
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
////		maybe add a logout if user doesn't exist anymore?
//		
//	}
//	elseif ($minClearance <= 0) {
//		return null;
//	}
//	else{
//		header("Location: /account/login.php");
//		die;
//	}
//}

function check_login($con)
{

	if(isset($_SESSION['userID']))
	{

		$id = $_SESSION['userID'];
		$query = "select * from accounts where userID = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: /account/login.php");
	die;

}

function check_admin($con) {
	$user_data = check_login($con);
	if($user_data['clearance'] >= 8){
		return $user_data;
	}
	header("Location: /account/login.php");
//	header("Location: {$_SERVER['HTTP_REFERER']}");
	die;
}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}