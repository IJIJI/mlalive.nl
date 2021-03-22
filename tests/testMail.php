<?php 
session_start();
//	echo session_id();

$currentPage = 'testMail';
$navbarTop = true;	

include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_functions.php');

$user_data = verifyAccount($con, 20);

include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/mailing.php');
streamCreationMail($con, 2291379947, 609831253378473612);
