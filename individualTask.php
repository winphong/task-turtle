<?php

	$con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

	if (!$con) {

		echo 'Not connected to server';
	}

	//session_start();

	//$passedOnTitle = $_SESSION['taskName'];

	//echo $passedOnTitle;

	$name = $_GET[task];

	echo $name;

	$task = pg_query("SELECT title, description, task_date, creator FROM task WHERE title = '$name'");

	if ($task) {

		while ( $arr = pg_fetch_array( $task, NULL, PGSQL_ASSOC ) ) {


	} else {

		echo 'Unsuccesful';
	}
?>
