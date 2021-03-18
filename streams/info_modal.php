	<?php if (isset($_GET['modal']) && $_GET['modal'] == 'info' && isset($_GET['tableID']) && !empty($_GET['tableID']) && $user_data['clearance'] > 0): 
	
		$tableID = $_GET['tableID'];
	
		$query = "select * from streams where tableID = '$tableID' limit 1";

		$streamResult = mysqli_query($con,$query);
		if($streamResult && mysqli_num_rows($streamResult) > 0)
		{
			$streamData = mysqli_fetch_assoc($streamResult);
		}
		else{
				header("Location: ?");
				die;
		}
	
	?>
<!--
	<main class="modalBackground" >
	</main>
-->
	<main class="modal" onclick="event.stopPropagation();window.location.href='?';">
<!--		<div>-->
			<div class="modalForm" onclick="event.stopPropagation();">
				<form action="post" class="modalForm">
					<div class="modalRow">
						<h1><?php echo $streamData['name']; ?></h1>
						<a class="modalRight" href="?"><span style="font-size: inherit;" class="material-icons">close</span></a>
					</div>
					<div class="modalRow">
						<p><?php echo $streamData['date']; ?></p>
						<p><b><?php echo $streamData['location']; ?></b></p>
					</div>
					
					<div>
						<p><?php echo $streamData['description']; ?></p>
					</div>		
					
					
					<?php if(isset($_SESSION['userID']) && $user_data['clearance'] >= 15): ?>
					
					<?php if(!empty($streamData['notes'])): ?>
					<div>
<!--						<p><strong>Notes:</strong></p>-->
						<h2>Notes:</h2>
						<p><?php echo $streamData['notes']; ?></p>
					</div>
					
					<?php endif; ?>
					
					<div>
						<h2>Requested:</h2>
						<div class="modalRow">
							<p><b>By</b></p>
							<p><?php echo idUserFullName($con, $streamData['creator']); ?></p>
							<p><b>at</b></p>
							<p><?php echo $streamData['createdTime']; ?></p>
						</div>
					</div>						

					<div>
						<h2>Approved:</h2>
						<?php if ($streamData['approved']): ?>				
						<div class="modalRow">
							<p><b>By</b></p>
							<p><?php echo idUserFullName($con, $streamData['approvedBy']); ?></p>
							<p><b>at</b></p>
							<p><?php echo $streamData['approvedAt']; ?></p>
						</div>						
						<?php else: ?>
						<p><b>Not approved.</b></p>
						<?php endif; ?>
					</div>

					<div>
						<h2>Last Edited:</h2>				
						<div class="modalRow">
							<p><b>By</b></p>
							<p><?php echo idUserFullName($con, $streamData['lastEditedBy']); ?></p>
							<p><b>at</b></p>
							<p><?php echo $streamData['lastEditedAt']; ?></p>
						</div>
						<?php endif; ?>
					</div>		
				</form>
			</div>
<!--		</div>-->
	</main>
	<?php endif; ?>