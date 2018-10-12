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

        $queryStr = "SELECT admin_name FROM admin WHERE admin_name='$admin_name' AND password='$password'";
		$adminLogin = dbQuery($con, $queryStr);
		$result = dbFetchArray($adminLogin);

		if (isset($result)) {

			echo 'Successful';
			header("refresh:3; url = adminLoggedInHomepage.html");

		} else {

			echo 'Log in unsuccessful';
			header("refresh:3; url = loginPage.html");
		}
	}
?>
