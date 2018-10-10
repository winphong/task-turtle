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

	$failedQueryStr = "UPDATE bid SET status='failed' WHERE taskid='$taskid' AND bidder!='$winningBidder'";
	$updateFailedStatus = dbQuery($con, $failedQueryStr);

	$successQueryStr = "UPDATE bid SET status='successful' WHERE taskid='$taskid' AND bidder='$winningBidder'";
	$updateSuccessStatus = dbQuery($con, $successQueryStr);

	$retrieveSuccessStr = "SELECT task FROM bid WHERE status=successful";
	$retrieveSuccess = dbQuery($con, $retrieveSuccessStr)
	$arr = dbFetchArray($retrieveSuccess);

	$assignQueryStr = "INSERT INTO assigned_to VALUES ('$taskid', '$winningBidder')";
	
?>