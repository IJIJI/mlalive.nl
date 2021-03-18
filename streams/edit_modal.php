	<?php if (isset($_GET['modal']) && $_GET['modal'] == 'edit' && isset($_GET['tableID']) && !empty($_GET['tableID']) && $user_data['clearance'] >= 16): 
	


function getTable($con, $tableID){

	

	$query = "select * from streams where tableID = '$tableID' limit 1";

	$streamResult = mysqli_query($con,$query);
	if($streamResult && mysqli_num_rows($streamResult) > 0)
	{
		return mysqli_fetch_assoc($streamResult);
	}
	else{
			header("Location: ?");
			die;
	}
}


$streamData = getTable($con, $_GET['tableID']);

include($_SERVER['DOCUMENT_ROOT'].'/blocks/error_message.php');



if(	isset($_POST['streamName']) && isset($_POST['streamLocation']) && isset($_POST['streamDate']) && isset($_POST['streamDescription']) && isset($_POST['streamQaLink'])){
	
	$streamName = mysqli_real_escape_string($con, $_POST['streamName']);
	$streamLocation = mysqli_real_escape_string($con, $_POST['streamLocation']);
	$streamDate = mysqli_real_escape_string($con, $_POST['streamDate']);
	$streamDescription = mysqli_real_escape_string($con, $_POST['streamDescription']);
	$streamNotes = mysqli_real_escape_string($con, $_POST['streamNotes']);
	$streamQaLink = mysqli_real_escape_string($con, $_POST['streamQaLink']);
	
	if (isset($_POST['streamApproved'])){
		$streamApproved = mysqli_real_escape_string($con, $_POST['streamApproved']);
	}
	else{
		$streamApproved = 0;
	}

	if(	!empty($streamName) && !empty($streamLocation) && !empty($streamDate) && 
			!is_numeric($streamName) && !is_numeric($streamLocation) && !is_numeric($streamDescription) && !is_numeric($streamNotes) ) {
		
		
		$tableIDnumber = $streamData['tableID'];
		if ($streamApproved){
			$Aquery = "update streams SET name='$streamName', location='$streamLocation', date='$streamDate', description='$streamDescription', notes='$streamNotes', qaLink='$streamQaLink', approved=b'$streamApproved', lastEditedBy='".$_SESSION['userID']."', lastEditedAt=now(), approvedBy='".$_SESSION['userID']."', approvedAt=now() WHERE tableID = $tableIDnumber";
		}
		else {
			$Aquery = "update streams SET name='$streamName', location='$streamLocation', date='$streamDate', description='$streamDescription', notes='$streamNotes', qaLink='$streamQaLink', approved=b'$streamApproved', lastEditedBy='".$_SESSION['userID']."', lastEditedAt=now() WHERE tableID = $tableIDnumber";
		}
//		$query = "insert into streams (tableID,name,date,creator) values ('99','banaaan','2020-02-12 00:19:00','35481788182')";
		
		mysqli_query($con, $Aquery);
		
		sendMessage("Updated data! ", 'succes');

		$streamData = getTable($con, $_GET['tableID']);
		
	}
	else{
		sendMessage("Please enter valid information! ", 'error');
	}
	
}





	?>
<!--
	<main class="modalBackground" >
	</main>
-->
	<main class="modal" onclick="event.stopPropagation();window.location.href='?#<?php echo $streamData['tableID']; ?>';">
<!--		<div>-->
			<div class="modalForm" onclick="event.stopPropagation();">
				<form method="post" class="modalForm" autocomplete="off">

						

					<div class="modalRow">
						<h1>Edit</h1>
						<a class="modalRight" href="?#<?php echo $streamData['tableID']; ?>"><span style="font-size: inherit;" class="material-icons">close</span></a>
					</div>
					<div class="modalInputBox">
						<label for="inputVideoName">Name:<span class="requiredStar">*</span></label>
						<div class="modalTextbox">						
							<input id="inputVideoName" type="text" placeholder="name" value="<?php echo $streamData['name']; ?>" name="streamName" required/>
							<div class="border"></div>
						</div>
					</div>
					<div class="modalInputBox">
						<label for="inputVideoLocation">Location:<span class="requiredStar">*</span></label>
						<div class="modalTextbox">						
							<input id="inputVideoLocation" type="text" list="locations" placeholder="location" value="<?php echo $streamData['location']; ?>" name="streamLocation" required/>
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
							<input id="inputVideoDate" type="datetime-local" placeholder="YYYY-MM-DD HH:MM:SS" value="<?php echo date("Y-m-d\TH:i:s", strtotime($streamData['date'])) ?>" name="streamDate" required/>
							<div class="border"></div>
						</div>
					</div>
					<div class="modalInputBox">
						<label for="inputVideoDescription">Description:</label>
						<div class="modalTextbox">						
							<textarea id="inputVideoDescription" name="streamDescription"><?php echo $streamData['description']; ?></textarea>
							<div class="border"></div>
						</div>
					</div>
					<div title="Notes about setup, only admins can see this." class="modalInputBox">
						<label for="inputVideoNotes">Notes:</label>
						<div class="modalTextbox">						
							<textarea id="inputVideoNotes" name="streamNotes"><?php echo $streamData['notes']; ?></textarea>
							<div class="border"></div>
						</div>
					</div>
					<div class="modalInputBox">
						<label for="inputVideoID">Q&amp;A Link:</label>
						<div class="modalTextbox">
							<input id="inputVideoID" type="text" value="<?php echo $streamData['qaLink']; ?>" name="streamQaLink"/>
							<div class="border"></div>
						</div>
					</div>
					<div class="modalCheckBox">
						<label for="approvedCheckbox">Approved:</label>
						
						<label class="approvedCheckbox" for="approvedCheckbox">
							<input type="checkbox" id="approvedCheckbox" <?php if ($streamData['approved']) {echo 'checked';} ?> value="1" name="streamApproved">
							<span class="approvedCheckboxSlider round"></span>
						</label>
					</div>
					<button class="modalButton" id="button">submit</button>
					<?php if ($user_data['clearance'] >= 18): ?>
					<a class="modalButton warningButton" href="/streams/delete.php?tableID=<?php echo $streamData['tableID']; ?>">DELETE</a>
					<?php endif; ?>
						
						
	
				</form>
			</div>
<!--		</div>-->
	</main>
	<?php elseif (isset($_GET['modal']) && $_GET['modal'] == 'edit' && isset($_GET['tableID']) && !empty($_GET['tableID'])): 
								
								
	header("location: ?modal=info&tableID=".$_GET['tableID']);
?>

	<?php endif; ?>