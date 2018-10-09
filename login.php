<?php

	require 'dbfunction.php';
	require 'dbqueryfunction.php';

    $con = getDbConnect();

	if (!$con) {
		echo 'Not connected to server';
	}

	if (isset($_POST['login'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];

        $queryStr = "SELECT user_name FROM userTable WHERE user_name='$username' AND password='$password'";
		$userLogin = dbQuery($con, $queryStr);
		$result = dbFetchArray($userLogin);

		if ($result) {

			echo 'Successful';
			header("refresh:0.3; url = loggedInHomepage.html");

		} else {

			echo 'Log in unsuccessful';
			header("refresh:3; url = loginPage.html");
		}
	}
?>
