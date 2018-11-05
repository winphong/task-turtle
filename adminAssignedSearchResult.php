<?php

    require 'dbfunction.php';
    require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	}
	
	date_default_timezone_set("Singapore");

	$date = date("Y-m-d");

	$searchWord = $_POST['searchWord'];

	$queryStr = "SELECT t.*, a.* FROM task t, assigned_to a WHERE t.taskid = a.task AND (lower(t.title) LIKE lower('%$searchWord%')) ORDER BY t.post_date";
	$retrieveTask = dbQuery($con, $queryStr);

	echo '<p>Task Table</p>';

    echo '<div style="display:table;">
        <table border="1"><tr><th>taskid</th><th>title</th><th>description</th><th>task_date</th><th>start_time</th><th>end_time</th><th>location</th><th>category</th><th>post_date</th><th>creator</th><th>status</th><th>assignee</th><th></th><th></th></tr>';

    while ( $arr = dbFetchArray($retrieveTask) ) {

      if ( $arr['completed'] == 't' || $arr['completed'] == 1 ) {
        
        $status = 'Completed';
      
      } else {

        $status = 'Pending';
      }

        echo '<tr><td>'.$arr['taskid'].'</td><td>'.$arr['title'].'</td><td>'.$arr['description'].'</td><td>'.$arr['task_date'].'</td><td>'.$arr['start_time'].'</td><td>'.$arr['end_time'].'</td><td>'.$arr['location'].'</td><td>'.$arr['category'].'</td><td>'.$arr['post_date'].'</td><td>'.$arr['creator'].'</td><td>'.$status.'</td><td>'.$arr['assignee'].'</td><td>'.'<form action="modifyTaskEntry.php" method="POST"><button type="hidden" name="taskid" value='.$arr['taskid'].'>Modify</button></form>'.'</th><th>'.'<form action="deleteTaskEntry.php" method="POST"><button type="hidden" name="taskid" value='.$arr['taskid'].'>Delete</button></form>'.'</th><th>';
    }
  
    echo '</table></div>';
?>



