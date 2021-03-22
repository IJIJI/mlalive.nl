<?php
function streamCreationMailLevel($con, $tableID, $minClearance){
	
	$query = "select * from accounts where clearance >= '$minClearance'";
	
	
	
	$result = mysqli_query($con,$query);
	if($result) //  && mysqli_num_rows($streamResult) > 0
	{
		while($adminUser = mysqli_fetch_assoc($result)){
		
			streamCreationMail($con, $tableID, $adminUser['userID']);
			
		}
	}
}

function streamCreationMail($con, $tableID, $userID){
	
	$query = "select * from accounts where userID = ".$userID." limit 1";
		
	$result = mysqli_query($con,$query);
	if($result && mysqli_num_rows($result) > 0)
	{
		$recieverData = mysqli_fetch_assoc($result);
	}
	
	
	$query = "select * from streams where tableID = '$tableID' limit 1";

	$streamResult = mysqli_query($con,$query);
	if($streamResult && mysqli_num_rows($streamResult) > 0)
	{
		$streamData = mysqli_fetch_assoc($streamResult);
	}
	
	$query = "select * from accounts where userID = ".$streamData['creator']." limit 1";
		
	$result = mysqli_query($con,$query);
	if($result && mysqli_num_rows($result) > 0)
	{
		$creatorData = mysqli_fetch_assoc($result);
	}

	$message = '
	<html>
	<head>
	<style>
		tr {
			padding: 10px 10px 10px 0;
			vertical-align: top;
		}
	</style>
	<title>New Stream Request!</title>
	</head>
	<body>
	<p>Hello '.$recieverData['name'].',</p>
	<p>A new stream has been '
		.(($streamData['approved'])?'created by: ':'requested by: ').$creatorData['name'].' '.$creatorData['surname'].((!$streamData['approved'])?', it has not yet been approved':'').'!</p>
	<table>
	<tr>
		<td><strong>NAME:</strong></td>
		<td>'.$streamData['name'].'</td>
	</tr>
	<tr>
		<td><strong>DATE:</strong></td>
		<td>'.date("d-m-Y H:i", strtotime($streamData['date'])).'</td>
	</tr>
	<tr>
		<td><strong>LOCATION:</strong></td>
		<td>'.$streamData['location'].'</td>
	</tr>
	'.((!empty($streamData['description']))?'
	<tr>
		<td><strong>DESCRIPTION:</strong></td>
		<td>'.$streamData['description'].'</td>
	</tr>
	':'')
	.((!empty($streamData['notes']))?'
	<tr>
		<td><strong>NOTES:</strong></td>
		<td>'.$streamData['notes'].'</td>
	</tr>
	':'').'
	<tr>
		<td><strong>APPROVED:</strong></td>
		<td>'.(($streamData['approved'])?'true':'false').'</td>
	</tr>
	<tr>
		<td><a href="https://mlalive.nl/streams/index.php?modal=edit&tableID='.$streamData['tableID'].'">EDIT</a></td>
	</tr>
	</table>
	</body>
	</html>
	';
	
	$to = $recieverData['mail'];
//	$to = 'ijsslkstr@gmail.com';
	$subject = "A new stream has been requested!";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//	$headers .= "X-Priority: 1 (Highest)\n";
//	$headers .= "X-MSMail-Priority: High\n";
//	$headers .= "Importance: High\n";

	// More headers
	$headers .= 'From: MLA Live Streams <no-reply@mlalive.nl>' . "\r\n";
//	$headers .= 'Cc: ijsslkstr@gmail.com' . "\r\n";

	mail($to,$subject,$message,$headers);

}