<?php

    require 'dbfunction.php';
    require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	}

    $queryStr = "SELECT title, description, task_date, creator FROM task ORDER BY post_date DESC";
	$retrieveTask = dbQuery($con, $queryStr);

	while ( $arr = dbFetchArray($retrieveTask) ) {

            echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'.$arr['title']."</br>".$arr['description']."</br>".$arr['task_date']."</br>".$arr['creator'].'</div>';
    }
?>
