<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
    </head>

    <body>
    	
    	<h1> Task Turtle </h1>

    	<table>

    		<?php
	
				require 'dbfunction.php';
				require 'dbqueryfunction.php';

				$con = getDbConnect();

				if (!$con) {
					echo 'Not connected to server';
				}

				session_start();
				$taskid = $_SESSION['taskid'];

				// Retrive list of bid for the particular task from the bid table
				$queryStr = "SELECT * FROM bid WHERE task='$taskid'";
				$retrieveBidList = dbQuery($con, $queryStr);
				
				$arr = dbFetchArray($retrieveBidList);

				if ( $arr ) {
					
					echo '<form action="selectBid.php" method="POST">';

					while ( $bid = dbFetchArray($retrieveBidList) ) {

						echo '<tr><td>'.$bid['bidder'].'</td><td>'.$bid['bid_value'].'</td><td><input type="radio" name="winningBidder" value='.$bid['bidder'].'></td></tr>';
					}

					echo '<input type="submit" value="Select bid"/>';
					echo '</form>';

				} else {

					echo 'No one has bid for the task yet!';				
				}

			?>

		</table>

		<a href="taskPage.php">
			<button> Back </button>
		</a>

    </body> 
</html>
