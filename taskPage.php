<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
    </head>
    <body>

    	<h1> Task Turtle </h1>

		<?php

			require 'dbfunction.php';
			require 'dbqueryfunction.php';

			$con = getDbConnect();

			if (!$con) {
				echo 'Not connected to server';
			}

			$taskid = $_POST['taskid'];

			// To retrieve info from database when redirected back after submit bid
			session_start();
			$username = $_SESSION["username"];

			if ($taskid != null) {
				$_SESSION["taskid"] = $taskid;
			} else {	
	        	$taskid = $_SESSION["taskid"];
	        }
			

			$queryStr = "SELECT * FROM task where taskid = $taskid";
			$retrieveTask = dbQuery($con, $queryStr);
			$arr = dbFetchArray($retrieveTask);
			//TODO: edit info to be displayed, add edit/bid buttons

	        echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'.$arr['title']."</br>".$arr['description']."</br>".$arr['task_date']."</br>".$arr['creator'].'</div>';

	        if ( $arr['creator'] == $username ) {
				
				// View bid
				//echo '<form action="viewBid.php" method="POST"><button type="hidden" name="taskid" value='.$taskid.'>View bid</button></form>';

				echo '<a href="viewBid.php"><button>View bid</button></a>';
			
			} else {
				
				// Bid now
				echo '<form action="bidPage.php" method="POST"><button type="hidden" name="taskid" value='.$taskid.'>Bid now</button></form>';
	        }
	        
 		?>
		
		<a href="loggedInHomepage.html">
			<button> Back </button>
		</a>

		
	</body>
</html>
