<?php

    require 'dbfunction.php';
    require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	}

	if (isset($_POST['adminLogin'])) {

		$admin_name = $_POST['adminUsername'];
		$password = $_POST['adminPassword'];

        $queryStr = "SELECT admin_name FROM admin WHERE admin_name='$adminid' AND password='$password'";
		$userLogin = dbQuery($queryStr);

		if ($userLogin) {

			echo 'Redirecting to homepage';
			header("refresh:3; url = homepage.html");

		} else {

			echo 'Log in unsuccessful';
			header("refresh:3; url = loginPage.html");
		}
	}
?>
