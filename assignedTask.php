<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
    </head>

    <body>
    	<h1> Task Turtle </h1>

    	<h3> Assigned task </h3>
        
		 <?php

		    require 'dbfunction.php';
		    require 'dbqueryfunction.php';

			$con = getDbConnect();

			if (!$con) {
				echo 'Not connected to server';
			}

			session_start();
			$assignee = $_SESSION['username'];

			$retrieveAssignedToTaskQueryStr = "SELECT * FROM assigned_to WHERE assignee='$assignee'";
			$retrieveAssignedTask = dbQuery($con, $retrieveAssignedToTaskQueryStr);
			$assignedTaskArr = dbFetchArray($retrieveAssignedTask);
			$task = $assignedTaskArr['task'];
		
			// If assigned 
			if ( $assignedTaskArr ) {

				$retrieveTaskQueryStr = "SELECT * FROM task WHERE taskid='$task'";
				$retrieveTask = dbQuery($con, $retrieveTaskQueryStr);

				$arr = dbFetchArray($retrieveTask);

				echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'."Task title: ".$arr['title']."</br>"."Description: ".$arr['description']."</br>"."Date: ".$arr['task_date']."</br>"."Creator: ".$arr['creator']."</br>"."Status: ".$status.'</div>';

			} else { // If not assigned

				echo 'Not assigned any task';
			}

			echo "</br>".'<a href="loggedInHomepage.html"><button> Back </button></a>';
		?>		
    </body> 
</html>