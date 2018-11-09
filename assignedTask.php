<?php require 'checkLoginStatus.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle | Assigned Tasks </title>
    </head>

    <body>
        <?php include 'template.php'; ?>
    	<h1> Task Turtle </h1>

    	<h3> Assigned task </h3>
        
		 <?php

		    require 'dbfunction.php';
		    require 'dbqueryfunction.php';

			$con = getDbConnect();

			if (!$con) {
				echo 'Not connected to server';
			}

			$assignee = $_SESSION['username'];

			$retrieveAssignedToTaskQueryStr = "SELECT * FROM assigned_to, task WHERE task = taskid AND assignee='$assignee' ORDER BY completed, task_date DESC";
			$retrieveAssignedTask = dbQuery($con, $retrieveAssignedToTaskQueryStr);
			$assignedTaskArr = dbFetchArray($retrieveAssignedTask);
		
			// If assigned 
			if ( $assignedTaskArr ) {
			    $status = ($assignedTaskArr['completed'] == "t" || $assignedTaskArr['completed'] == 1) ? "Completed" : "Pending";
			    echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'."Task title: ".$assignedTaskArr['title']."</br>"."Description: ".$assignedTaskArr['description']."</br>"."Date: ".$assignedTaskArr['task_date']."</br>"."Start Time: ".$assignedTaskArr['start_time']."</br>"."End Time: ".$assignedTaskArr['end_time']."</br>"."Creator: ".$assignedTaskArr['creator']."</br>"."Status: ".$status.'</div>';
			    while ($arr = dbFetchArray($retrieveAssignedTask)) {
			        $status = ($arr['completed'] == "t" || $arr['completed'] == 1) ? "Completed" : "Pending";
			        echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'."Task title: ".$arr['title']."</br>"."Description: ".$arr['description']."</br>"."Date: ".$arr['task_date']."</br>"."Start Time: ".$arr['start_time']."</br>"."End Time: ".$arr['end_time']."</br>"."Creator: ".$arr['creator']."</br>"."Status: ".$status.'</div>';
			    }
			} else { // If not assigned

				echo 'Not assigned any task';
			}

			echo "</br>".'<a href="loggedInHomepage.html"><button> Back </button></a>';
		?>		
    </body> 
</html>