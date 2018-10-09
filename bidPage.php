<?php
	
	require 'dbfunction.php';
	require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		
		echo 'Not connected to server';
	}

	$bidTaskId = $_POST['bidTaskId'];

	echo $bidTaskId;
?>