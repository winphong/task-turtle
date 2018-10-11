<?php

    require 'dbfunction.php';
    require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	}

	$date = date("Y-m-d");
	echo $date;

    $queryStr = "SELECT t.* FROM task t, assigned_to a WHERE (t.taskid NOT IN (SELECT DISTINCT a.task)) AND (t.task_date >= '$date') ORDER BY post_date DESC";
	$retrieveTask = dbQuery($con, $queryStr);

	while ( $arr = dbFetchArray($retrieveTask) ) {

        echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'."Task title: ".$arr['title']."</br>"."Description: ".$arr['description']."</br>"."Date: ".$arr['task_date']."</br>"."Creator: ".$arr['creator'].'<form action="taskPage.php" method="POST"><button type="hidden" name="taskid" value='.$arr['taskid'].'>View more</button></form></div>';
    }
?>



