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

			$queryStr = "SELECT * FROM task WHERE taskid = $taskid";
			$retrieveTask = dbQuery($con, $queryStr);
			$arr = dbFetchArray($retrieveTask);

	        echo "<form name='update' action='modifyTaskEntry.php' method='POST' >  
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

    		if (isset($_POST['modify'])) {
    			$result = dbQuery($con, "UPDATE task SET  title = '$_POST[title_updated]', description = '$_POST[description_updated]', task_date = '$_POST[task_date_updated]', start_time = '$_POST[start_time_updated]', end_time = '$_POST[end_time_updated]', location = '$_POST[location_updated]', category = '$_POST[category_updated]', creator = '$_POST[creator_updated]' WHERE taskid = $_POST[taskid]");
        		if (!$result) {
            		echo "Update failed!!";
        		} else {
            		echo "Update successful!";
        		}
    		}
	        
 		?>
		
		<a href="adminLoggedInHomepage.html">
			<button> Back </button>
		</a>

		
	</body>
</html>
