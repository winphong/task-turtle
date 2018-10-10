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

			echo $taskid;

			echo '<form action="updateBid.php" method="POST">'."Enter your bid: ".'<input type="number" name="bidValue"/><input type="hidden" name="taskid" value='.$taskid.'><input type="submit" value="Submit your bid"/></form>'
		?>

		


	</body>
</html>