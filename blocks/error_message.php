
<?php

function errorMessage($message){
	
//	echo 
//		'<div class="errorMessage">
//			<h1>'.$message.'</h1>
//		</div>';
	sendMessage($message, 'error');
}

function sendMessage($message, $type){
	switch ($type){
			case 'error':
				$messageClass = "alertMessage error";
				break;
			case 'succes':
				$messageClass = "alertMessage succes";
				break;
			case 'warning':
				$messageClass = "alertMessage warning";
				break;
		
	}
	
	echo 
	'<div class="'.$messageClass.'">
		<h1>'.$message.'</h1>
	</div>';
}