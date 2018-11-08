<?php

    require 'dbfunction.php';
    require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	}

	session_start();

	if (isset($_POST['adminLogin'])) {

		$admin_name = $_POST['adminUsername'];
		$password = $_POST['adminPassword'];

        $queryStr = "SELECT * FROM admin WHERE admin_name='$admin_name' AND password='$password'";
		$adminLogin = dbQuery($con, $queryStr);
		$result = dbFetchArray($adminLogin);

		if ($result) {

			echo 'Successful';
			$_SESSION['userinfo'] = $result;
			header("refresh:1; url = adminLoggedInHomepage.html");

		} else {

			echo 'Log in unsuccessful';
			header("refresh:1; url = loginPage.html");
		}
	}
?>
