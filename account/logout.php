<?php

session_start();

if(isset($_SESSION['userID']))
{
	unset($_SESSION['userID']);

}

if(isset($_SESSION['userClearance']))
{
	unset($_SESSION['userClearance']);

}

if (isset($_SESSION['userName']))
{
	unset($_SESSION['userName']);
}
if (isset($_SESSION['userSurname']))
{
	unset($_SESSION['userSurname']);
}

header("Location: /account/login.php");
die;