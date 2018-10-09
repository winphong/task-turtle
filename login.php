<?php

	$con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

	if (!$con) {

		echo 'Not connected to server';
	}

	if (isset($_POST['login'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$userLogin = pg_query("SELECT user_name FROM userTable WHERE user_name='$username' AND password='$password'");

		if ($userLogin) {

			echo 'Succesful';
			header("refresh:0.3; url = loggedInHomepage.html");

		} else {

			echo 'Log in unsuccesful';
			header("refresh:3; url = loginPage.html");
		}
	}
?>
