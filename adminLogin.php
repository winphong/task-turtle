<?php

	$con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

	if (!$con) {

		echo 'Not connected to server';
	}

	if (isset($_POST['adminLogin'])) {

		$admin_name = $_POST['adminUsername'];
		$password = $_POST['adminPassword'];

		$userLogin = pg_query("SELECT admin_name FROM admin WHERE admin_name='$adminid' AND password='$password'");

		if ($userLogin) {

			echo 'Redirecting to homepage';
			//header("refresh:3; url = homepage.html");

		} else {

			echo 'Log in unsuccesful';
			header("refresh:3; url = loginPage.html");
		}
	}
?>
