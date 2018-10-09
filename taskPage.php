<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle </title>
    </head>

    <body>
    	<h1> Welcome to Task Turtle </h1>
	
		<?php

		$con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

		if (!$con) {

			echo 'Not connected to server';
		}

		$taskid = $_POST['taskid'];

		$retrieveTask = pg_query("SELECT title, description, task_date, creator FROM task where taskid = $taskid");

		$arr = pg_fetch_array( $retrieveTask, NULL, PGSQL_ASSOC );

		//TODO: edit info to be displayed, add edit/bid buttons
        echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'.$arr['title']."</br>".$arr['description']."</br>".$arr['task_date']."</br>".$arr['creator'].'</div>';

		?>
	</body> 
</html>
