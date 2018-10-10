<?php
	
	require 'dbfunction.php';
	require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	}

	$winningBidder = $_POST['winningBidder'];

	session_start();
	$taskid = $_SESSION['taskid'];

	$failedQueryStr = "UPDATE bid SET status='failed' WHERE task='$taskid' AND bidder!='$winningBidder'";
	$updateFailedStatus = dbQuery($con, $failedQueryStr);

	$successQueryStr = "UPDATE bid SET status='successful' WHERE task='$taskid' AND bidder='$winningBidder'";
	$updateSuccessStatus = dbQuery($con, $successQueryStr);

	$assignQueryStr = "INSERT INTO assigned_to VALUES ('$taskid', '$winningBidder')";
	$assignTask = dbQuery($con, $assignQueryStr);

	if ( $updateFailedStatus AND $updateSuccessStatus AND $assignQueryStr ) {
		echo "Successfully assigned task to ".$winningBidder;
	} else {
		echo "Assign failed";
	}


?>