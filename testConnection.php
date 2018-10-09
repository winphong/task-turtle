<?php
    //session_start();

    require 'dbfunction.php';
	$con = getDbConnect();

	if (!$con) {
		echo "Not connected to server";
	} else {
	    echo "success";
	}

?>
