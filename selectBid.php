<?php
	
	require 'dbfunction.php';
	require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	} else {
	    $winningBidder = $_POST['winningBidder'];

	    session_start();
	    $taskid = $_SESSION['taskid'];

	    $failedQueryStr = "UPDATE bid SET status='failed' WHERE task='$taskid' AND bidder!='$winningBidder'";

	    $successQueryStr = "UPDATE bid SET status='successful' WHERE task='$taskid' AND bidder='$winningBidder'";

	    $assignQueryStr = "INSERT INTO assigned_to VALUES ('$taskid', '$winningBidder', 'FALSE')";
	    $assignTask = dbQuery($con, $assignQueryStr);

	    if ( dbAffectedRows($con, $assignTask) > 0 ) {
	        dbQuery($con, $failedQueryStr);
	        dbQuery($con, $successQueryStr);
		    echo "Successfully assigned task to " . $winningBidder . ".";
		    header("refresh:1; url = 'loggedInHomepage.html'");
	    } else {
		    echo "Assign failed. " . dbGetErrorMessage($con);
		    header("refresh:2; url = 'taskPage.php'");
	    }
    }

?>