<?php

    session_start();

    require 'dbfunction.php';
	require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {

		echo 'Not connected to server';
	}

	if (isset($_POST['create_task'])) {

		$title = $_POST['title'];
		$description = $_POST['description'];// == "") ? "DEFAULT" : "'" . $_POST['description'] . "'";
		$task_date = $_POST['task_date'];
		$start_time = $_POST['start_time'];
		$end_time = $_POST['end_time'];
		$location = $_POST['location'];
		$category = $_POST['category'];
		$post_date = date("Y-m-d");
		$username = $_SESSION['username'];
		
		$queryStr = "INSERT INTO task(title, description, task_date, start_time, end_time, location, category, post_date, creator) VALUES ('$title', '$description', '$task_date', '$start_time', '$end_time', '$location', '$category', '$post_date', '$username')";
		$userCreateTask = dbQuery($con, $queryStr);

		if ($userCreateTask) {
			echo "Task created successfully!";
			header("refresh:1; url = loggedInHomepage.html");
		} else {
			echo "Task creation failed.";
			header("refresh:2; url = createTask.php");
		}
	}

?>