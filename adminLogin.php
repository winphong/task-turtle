<?php

	$con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

	if (!$con) {

		echo 'Not connected to server';
	}

	if (isset($_POST['adminLogin'])) {

		$adminid = $_POST['adminUsername'];
		$password = $_POST['adminPassword'];

		$userLogin = pg_query("SELECT adminid FROM admin WHERE adminid='$adminid' AND password='$password'");

		if ($userLogin) {

			echo 'Redirecting to homepage';
			header("refresh:3; url = homepage.html");

		} else {

			echo 'Log in unsuccesful';
			header("refresh:3; url = loginPage.html");
		}
	}
?>
