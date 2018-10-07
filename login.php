<?php

	$con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

	if (!$con) {

		echo 'Not connected to server';
	}

	if (isset($_POST['login'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$userLogin = pg_query("SELECT userid FROM userTable WHERE userid='$username' AND password='$password'");

		if ($userLogin) {

			echo 'Succesful';
			header("refresh: 1; url = loggedInHomepage.php");

		} else {

			echo 'Log in unsuccesful';
			header("refresh:3; url = loginPage.html");
		}
	}
?>
