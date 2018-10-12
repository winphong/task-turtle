<?php
	
	require 'dbfunction.php';
	require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	}

	$taskid = $_POST['taskid'];

	session_start();
	$_SESSION['taskid'] = $taskid;

	if (isset($_POST['modify'])) {
		
		$result = dbQuery($con, "UPDATE task SET title = '$_POST[title_updated]', description = '$_POST[description_updated]', task_date = '$_POST[task_date_updated]', start_time = '$_POST[start_time_updated]', end_time = '$_POST[end_time_updated]', location = '$_POST[location_updated]', category = '$_POST[category_updated]', creator = '$_POST[creator_updated]' WHERE taskid = $_POST[taskid]");
		
		if (!$result) {
    		echo "Update failed!!";
		} else {
    		echo "Update successful!";
		}

		header("refresh:0.1; url = modifyTaskEntry.php");
	}

?>