<?php
    require 'checkLoginStatus.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
    </head>
    <body>
        <?php
            include 'headermenu.php';
        ?>
    	<h1> Task Turtle </h1>

		<?php

			require 'dbfunction.php';
			require 'dbqueryfunction.php';

			$con = getDbConnect();

			if (!$con) {
				echo 'Not connected to server';
			}

			$taskid = (!isset($_POST['taskid'])) ? NULL : $_POST['taskid'];

			// To retrieve info from database when redirected back after submit bid
			$username = $_SESSION["username"];

			if ($taskid != null) {
				$_SESSION["taskid"] = $taskid;
			} else {	
	        	$taskid = $_SESSION["taskid"];
	        }
			

			$queryStr = "SELECT * FROM task WHERE taskid = $taskid";
			$retrieveTask = dbQuery($con, $queryStr);
			$arr = dbFetchArray($retrieveTask);

	        echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'."Task title: ".$arr['title']."</br>"."Description: ".$arr['description']."</br>"."Task date: ".$arr['task_date']."</br>"."Start time: ".$arr['start_time']."</br>"."End time: ".$arr['end_time']."</br>"."Location :".$arr['location']."</br>"."Category: ".$arr['category']."</br>"."Post date: ".$arr['post_date']."</br>"."Task creator: ".$arr['creator'].'</div>';

	        //TO-DO: Add condition to check if current start time > assigned end time, don't allow bid
	        // Assigned-to component
	        // Get assigned task in assigned_to table
	        $retrieveTaskQueryStr = "SELECT task FROM assigned_to WHERE assignee='$username'";
			$retrieveTask2 = dbQuery($con, $retrieveTaskQueryStr);
			$taskArr = dbFetchArray($retrieveTask2);
			$assignedTaskId = $taskArr['task']; // output -> taskid;

			// Get assigned task in task table
			$retrieveAssignedToTaskQueryStr = "SELECT * FROM task WHERE taskid='$assignedTaskId'";
			$retrieveAssignedTask = dbQuery($con, $retrieveAssignedToTaskQueryStr);
			$assignedTaskArr = dbFetchArray($retrieveAssignedTask);

	        if ( $arr['creator'] == $username ) {
	        	
	        	// View bid
	        	echo '<a href="viewBid.php"><button>View bid</button></a>';

	        } else if ( $arr['task_date'] == $assignedTaskArr['task_date'] AND $assignedTaskArr['end_time'] > $arr['start_time'] ) {
				
				echo 'Bidding not allowed! </br>';
			
			} else {
				
				// Bid now
				echo '<form action="bidPage.php" method="POST"><button type="hidden" name="taskid" value='.$taskid.'>Bid now</button></form>';
	        }

	        $state = $_SESSION["state"];

	        if ( $state == 'personal' ) {

				echo '<a href="listOfPostedTask.php"><button> Back </button></a>';
			
			} else {

				echo '<a href="loggedInHomepage.html"><button> Back </button></a>';
			}        
 		?>
	</body>
</html>
