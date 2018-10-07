<?php

	$con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

	if (!$con) {

		echo 'Not connected to server';
	}

	$retrieveTask = pg_query("SELECT title, description, task_date, creator FROM task ORDER BY post_date DESC");

	while ( $arr = pg_fetch_array( $retrieveTask, NULL, PGSQL_ASSOC ) ) {

            echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'.$arr['title']."</br>".$arr['description']."</br>".$arr['task_date']."</br>".$arr['creator'].'</div>';
    }
?>
