<?php
    require 'checkLoginStatus.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title> TaskTurtle | Account Settings </title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  </head>
    <body>
      <div id="header">
        <div id="branding"> <!-- contains sitename and logo to align left -->
          <img id="logo" src="assets/logo.png"></img>
          <p id="sitename"><a href="loggedInHomepage.html">TaskTurtle</a></p>
        </div>
        <ul class="nav" id="topnav">
          <?php include 'headermenu.php'; ?>
        </ul>
      </div> <!-- end header -->
	
	<?php

    require 'dbfunction.php';
    require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	}

	$_SESSION["state"] = 'personal';

	$creator = $userinfo['user_name'];

    $queryStr = "SELECT * FROM task WHERE creator = '$creator' ORDER BY post_date DESC";
	$retrieveTask = dbQuery($con, $queryStr);

	while ( $arr = dbFetchArray($retrieveTask) ) {

        echo "</br>".'<div style="border:1px solid; padding:20px; margin-bottom:20px;">'."Task title: ".$arr['title']."</br>"."Description: ".$arr['description']."</br>"."Date: ".$arr['task_date']."</br>"."Creator: ".$arr['creator'].'<form action="taskPage.php" method="POST"><button type="hidden" name="taskid" value='.$arr['taskid'].'>View more</button></form></div>';
    }

    echo '<a href="viewProfileSettings.php"><button>Back</button></a>';
?>
      
    </body>
</html>
