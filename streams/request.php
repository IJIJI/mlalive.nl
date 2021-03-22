
<?php 
	session_start();
//	echo session_id();

	$currentPage = 'Request';
	$navbarTop = true;	

	include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/account_functions.php');
	include($_SERVER['DOCUMENT_ROOT'].'/account/scripts/mailing.php');

	$user_data = verifyAccount($con, 1);
?>


<!doctype html> 
<html>
<head>

	<meta charset="utf-8">

	<link rel="stylesheet" href="/css/styles.css">
	<link rel="stylesheet" href="/css/nav.css">
	<link rel="stylesheet" href="/css/modal.css">
	<link rel="stylesheet" href="/css/request_form.css">

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="shortcut icon" href="/img/tertair.png" type="image/x-icon"/> 
	
	<meta name="author" content="Developer: IJssel Koster" />
	<title>MLA Live - <?php echo($currentPage); ?></title>
	<meta name="description" content="Het MLA Live webportaal.">

	<?php echo('<meta property="og:title" content="MLA live - '.$currentPage.'Q&A Archief">'); ?>

	<meta property="og:description" content="Het MLA Live webportaal.">
	<meta property="og:url" content="https://mlalive.nl/">
	<meta property="og:image" content="/img/tertair.png">	

</head>
<body>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/nav.php'); ?>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/blocks/error_message.php'); ?>
<!--	<?php echo($currentPage); ?>-->
	
<!--	<?php echo($_SESSION['userID']); ?>-->
	
	<?php if ($user_data['clearance'] < 16): ?>
	<main class="request">
		<div class="request" onclick="event.stopPropagation();">
			<form method="post" class="modalForm">
					<div class="modalRow">
						<h2>This function is not yet implemented for non-administrators. Please mail <a style="color: var(--mla-lila)" href="mailto:request@mlalive.nl">request@mlalive.nl</a> with your request.</h2>
					</div>
			</form>
		</div>
	</main>
	
	
	<?php else: 
	
if(	isset($_POST['streamName']) && isset($_POST['streamLocation']) && isset($_POST['streamDate']) && isset($_POST['streamDescription']) && isset($_POST['streamNotes']) && isset($_POST['streamQaLink'])){
	
	$streamName = mysqli_real_escape_string($con, $_POST['streamName']);
	$streamLocation = mysqli_real_escape_string($con, $_POST['streamLocation']);
	$streamDate = mysqli_real_escape_string($con, $_POST['streamDate']);
	$streamDescription = mysqli_real_escape_string($con, $_POST['streamDescription']);
	$streamNotes = mysqli_real_escape_string($con, $_POST['streamNotes']);
	$streamQaLink = mysqli_real_escape_string($con, $_POST['streamQaLink']);
	
	if (isset($_POST['streamApproved'])){
		$streamApproved = mysqli_real_escape_string($con, $_POST['streamApproved']);
	}
	
	if (isset($_POST['streamBroadcast'])){
		$streamBroadcast = mysqli_real_escape_string($con, $_POST['streamBroadcast']);
	}
	
	if (!empty($_POST['streamName']) && !empty($_POST['streamLocation']) && !empty($_POST['streamDate'])){
		
		$tableID = random_num(10);
		$variableNames = array('tableID', 'name', 'location', 'date', 'creator', 'createdTime', 'lastEditedBy', 'lastEditedAt');
		$variableContent = array($tableID, $streamName, $streamLocation, $streamDate, $_SESSION['userID'], 'now()', $_SESSION['userID'], 'now()');
		
		if (!empty($streamDescription)){
			$variableNames[] = 'description';
			$variableContent[] = $streamDescription;
		}
		if (!empty($streamNotes)){
			$variableNames[] = 'notes';
			$variableContent[] = $streamNotes;
		}
		if (!empty($streamQaLink)){
			if (!is_numeric($streamQaLink)){
				$variableNames[] = 'qaLink';
				$variableContent[] = $streamQaLink;
			}
			else{
				sendMessage("Please enter a valid link!", "error");
			}
		}
		if (!empty($streamApproved)){
			$variableNames[] = 'approved';
			$variableContent[] = '1';	
			$variableNames[] = 'approvedBy';
			$variableContent[] = $_SESSION['userID'];	
			$variableNames[] = 'approvedAt';
			$variableContent[] = 'now()';	
		}
//		if (!empty($streamBroadcast)){
//			
//		}		
		
		$nameQuery = "";
		$contentQuery= "";
		
		for ($x = 0; $x < count($variableNames); $x++) {
			if ($x > 0){
				$nameQuery .= ",";
				$contentQuery .= ",";
			}
			$nameQuery .= $variableNames[$x];
			
			if ($variableContent[$x] == 'now()'){
				$contentQuery .= $variableContent[$x];
			}
			elseif ($variableContent[$x] == 1)
				$contentQuery .= "b'".$variableContent[$x]."'";
			else{
				$contentQuery .= "'".$variableContent[$x]."'";
			}
			
		}
		
		//save to database
		$query = 'insert into streams ('.$nameQuery.') values ('.$contentQuery.')';
//		echo $query;

		if (!mysqli_query($con, $query)){
			sendMessage("Error: " . mysqli_error($con), 'error');
//			echo "Error: " . mysqli_error($con);
//			sendMessage("Error: SQL connection.", 'error');
		}
		elseif (!empty($streamApproved) && empty($streamBroadcast)){
			sendMessage("Succes! Created stream.", 'succes');
		}
		elseif (!empty($streamApproved) && !empty($streamBroadcast)) {
			sendMessage("Succes! Broadcasting stream to administrators.", 'succes');
			streamCreationMailLevel($con, $tableID, 17);
		}
		else{
			sendMessage("Succes! Awaiting approval by admin.", 'succes');
			streamCreationMailLevel($con, $tableID, 17);
		}
						
	}
	else{
		sendMessage("Please enter complete information!", "error");
	}


		
}
	
	?>
	
	<main class="request">
		<div class="request" onclick="event.stopPropagation();">
			<form method="post" class="modalForm" autocomplete="off">
					<div class="modalRow">
						<h1>Request</h1>
						<?php if ($user_data['clearance'] >= 16): ?>
						<p class="modalRight" >Admin</p>
						<?php else: ?>
						<p class="modalRight" >User</p>
						<?php endif; ?>
					</div>
					<div class="modalInputBox">
						<label for="inputVideoName">Name:<span class="requiredStar">*</span></label>
						<div class="modalTextbox">						
							<input id="inputVideoName" type="text" placeholder="name" value="" name="streamName" required/>
							<div class="border"></div>
						</div>
					</div>
					<div class="modalInputBox">
						<label for="inputVideoLocation">Location:<span class="requiredStar">*</span></label>
						<div class="modalTextbox">						
							<input id="inputVideoLocation" type="text" list="locations" placeholder="location" value="" name="streamLocation" required/>
							<div class="border"></div>
						</div>
						<datalist id="locations">
						<?php
							$query = "SELECT * FROM locations";
							$result = mysqli_query($con, $query);

							if($result){

								while($row = mysqli_fetch_assoc($result)){

									echo ("
									<option>".$row['name']."</option>
									");
								}
							}					
						?>
						</datalist>
					</div>
					<div class="modalInputBox">
						<label for="inputVideoDate">Date:<span class="requiredStar">*</span></label>
	<!--							<input id="inputVideoDate" type="datetime-local" placeholder="date" name="streamDate"/>-->
						<div class="modalTextbox">						
							<input id="inputVideoDate" type="datetime-local" placeholder="YYYY-MM-DD HH:MM:SS" value="" name="streamDate" required/>
							<div class="border"></div>
						</div>
					</div>
					<div class="modalInputBox">
						<label for="inputVideoDescription">Description:</label>
						<div class="modalTextbox">						
							<textarea id="inputVideoDescription" name="streamDescription"></textarea>
							<div class="border"></div>
						</div>
					</div>
					<?php if ($user_data['clearance'] >= 16): ?>
					<div title="Notes about setup, only admins can see this." class="modalInputBox">
						<label for="inputVideoNotes">Notes:</label>
						<div class="modalTextbox">						
							<textarea id="inputVideoNotes" name="streamNotes"></textarea>
							<div class="border"></div>
						</div>
					</div>
					<div title="Link used for embedding chat" class="modalInputBox">
						<label for="inputVideoID">Q&amp;A Link:</label>
						<div class="modalTextbox">
							<input id="inputVideoID" placeholder="https://vimeo.com/..." type="text" value="" name="streamQaLink"/>
							<div class="border"></div>
						</div>
					</div>
					<div class="modalCheckBox">
						<label for="approvedCheckbox">Approved:</label>
						
						<label class="approvedCheckbox" for="approvedCheckbox">
							<input type="checkbox" id="approvedCheckbox"  value="1" name="streamApproved">
							<span class="approvedCheckboxSlider round"></span>
						</label>
					</div>
					<div title="Send message to administrators" style="" class="modalCheckBox">
						<label for="broadcastCheckbox">Broadcast:</label>

						<label class="approvedCheckbox" for="broadcastCheckbox">
							<input type="checkbox" id="broadcastCheckbox" checked value="1" name="streamBroadcast">
							<span class="approvedCheckboxSlider round"></span>
						</label>
					</div>
					<?php endif; ?>
					<button class="modalButton" id="button">submit</button>						

				
			</form>
		</div>
	</main>
	
	
	<?php endif; ?>
	
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>