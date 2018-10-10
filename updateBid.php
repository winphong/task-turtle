<?php
	
	require 'dbfunction.php';
	require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		
		echo 'Not connected to server';
	}

	$bidValue = $_POST['bidValue'];
	$taskid = $_POST['taskid'];

	session_start();
	$username = $_SESSION["username"];
	$password = $_SESSION["password"];

	echo $username;
	echo $bidValue;
	echo $password;
	echo $taskid;

	$bidQueryStr = "INSERT INTO bid VALUES ('$username', '$taskid', '$bidValue', 'pending')";
	$bid = dbQuery($con, $bidQueryStr);

	if ($bid ) {
		echo "Bid submitted successfully";
	} else {
		echo "Failed";
	}
?>	