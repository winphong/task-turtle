<?php
    require 'checkLoginStatus.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title> TaskTurtle | Account Settings </title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  </head>
    <body>
      <div id="header">
        <div id="branding"> <!-- contains sitename and logo to align left -->
          <img id="logo" src="assets/logo.png"></img>
          <p id="sitename"><a href="loggedInHomepage.html">TaskTurtle</a></p>
        </div>
        <ul class="nav" id="topnav">
          <?php include 'headermenu.php'; ?>
        </ul>
      </div> <!-- end header -->
	
	<?php

		require 'dbfunction.php';
    	require 'dbqueryfunction.php';

    	$con = getDbConnect();

		if (!$con) {
			echo 'Not connected to server';
		}

		$creator = $userinfo['user_name'];

		if (isset($_POST["completeTheJob"]) && $_POST["completeTheJob"] == TRUE) {
			//Update task completed status
			$assignee = $_POST["assignee"];

			$updateAssignedTaskCompleteStatusQueryStr = "UPDATE assigned_to SET completed = TRUE WHERE assignee='$assignee'";
			$updateAssignedTaskCompleteStatus = dbQuery($con, $updateAssignedTaskCompleteStatusQueryStr);
		}

		$queryStr = "SELECT t.*, a.* FROM task t, assigned_to a WHERE a.task = t.taskid AND t.creator='$creator'";
		$query = dbQuery($con, $queryStr);


		while ( $arr = dbFetchArray($query) ) {

			if ( $arr['completed'] == 't' || $arr['completed'] == 1 ) {
				$status = 'Completed';
			} else {
				$status = 'Pending';
			}

        	echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'."Task title: ".$arr['title']."</br>"."Description: ".$arr['description']."</br>"."Date: ".$arr['task_date']."</br>"."Creator: ".$arr['creator']."</br>"."Status: ".$status.'</div>';

        	$assignee = $arr['assignee'];

        	if ( $status == 'Pending' ) {
        		echo '<form action="assignedTaskForBidder.php" method="POST"><input type="hidden" name="assignee" value='.$assignee.'><button style="display: inline-block;" type="hidden" name="completeTheJob" value="TRUE">Mark as done</button></form>';
        	}
    	}

    	echo '<a href="viewProfileSettings.php"><button style="display: inline-block;"> Back </button></a>'; 
	?>
    </body>
</html>
