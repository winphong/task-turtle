<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
    </head>
    <body>

    	<h1> Welcome to Task Turtle </h1>

		<?php

			require 'dbfunction.php';
			require 'dbqueryfunction.php';

			$con = getDbConnect();

			if (!$con) {
				echo 'Not connected to server';
			}

			$taskid = $_POST['taskid'];
			$queryStr = "SELECT title, description, task_date, creator FROM task where taskid = $taskid";
			$retrieveTask = dbQuery($con, $queryStr);
			$arr = dbFetchArray($retrieveTask);
			//TODO: edit info to be displayed, add edit/bid buttons

	        echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'.$arr['title']."</br>".$arr['description']."</br>".$arr['task_date']."</br>".$arr['creator'].'</div>';


	        //Pass value to bidPage but I have no idea why is it not working
	        echo "</br>".'<div><form action="bidPage.php" method="POST"><input type="hidden" name="bidTaskId" value='.$arr['taskid'].'><input type="submit" value="Bid now"></form></div>';
		?>
		
		<a href="taskList.php">
			<button> Back </button>
		</a>

		
	</body>
</html>
