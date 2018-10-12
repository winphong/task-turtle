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
            
            if ($taskid == null) {
                session_start();
                $taskid = $_SESSION['taskid'];
            }

			$queryStr = "SELECT * FROM task WHERE taskid = $taskid";
			$retrieveTask = dbQuery($con, $queryStr);
			$arr = dbFetchArray($retrieveTask);

	        echo "<form name='update' action='handleModifyTaskEntry.php' method='POST' >  
    				taskid: $arr[taskid]<input type='hidden' name='taskid' value='$arr[taskid]' /></br>
    				title:
    				<input type='text' name='title_updated' value='$arr[title]' /></br>
    				description: 
    				<input type='text' name='description_updated' value='$arr[description]' /></br>
    				task_date:
    				<input type='text' name='task_date_updated' value='$arr[task_date]' /></br>
    				start_time:
    				<input type='text' name='start_time_updated' value='$arr[start_time]' /></br>
    				end_time:
    				<input type='text' name='end_time_updated' value='$arr[end_time]' /></br>
    				location:
    				<input type='text' name='location_updated' value='$arr[location]' /></br>
    				category:
    				<input type='text' name='category_updated' value='$arr[category]' /></br>
    				creator:
    				<input type='text' name='creator_updated' value='$arr[creator]' /></br>
    				<input type='submit' name='modify' value='Modify'/>
    				</form>";

 		?>
		
		<a href="adminLoggedInHomepage.html">
			<button> Back </button>
		</a>

		
	</body>
</html>
