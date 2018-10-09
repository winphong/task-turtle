<?php

	$con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

	if (!$con) {

		echo 'Not connected to server';
	}

	$taskList = array();
	$index = 0;

	$retrieveTask = pg_query("SELECT title, description, task_date, creator FROM task ORDER BY post_date DESC");

	/* while ( $arr = pg_fetch_array( $retrieveTask, NULL, PGSQL_ASSOC ) ) {

			$y = $arr['title'];

            echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;"> <a href="individualTask.php?task=Washing car">'.$arr['title'].'</a>'."</br>".$arr['description']."</br>".$arr['task_date']."</br>".$arr['creator'].'</div>';

            //session_start();

            //$_SESSION['taskName'] = $arr['title']; */


	$retrieveTask = pg_query("SELECT taskid, title, description, task_date, creator FROM task ORDER BY post_date DESC");

	while ( $arr = pg_fetch_array( $retrieveTask, NULL, PGSQL_ASSOC ) ) {

		$taskid = $arr['taskid'];

        echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'."Task title: ".$arr['title']."</br>"."Description: ".$arr['description']."</br>"."Date: ".$arr['task_date']."</br>"."Creator: ".$arr['creator'].'<form action="taskPage.php" method="POST"><input type="hidden" name="taskid" value='.$taskid.'><input type="submit" value="Go to task"></form></div>';

    }
?>



