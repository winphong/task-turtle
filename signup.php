<?php
	
	$con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

	if (!$con) {

		echo 'Not connected to server';
	}

	if (isset($_POST['signup'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$userProfile = $_POST['userProfile'];

		$userSignUp = pg_query("INSERT INTO userTable VALUES ('$username', '$password', '$name', '$userProfile')");

		echo $userSignUp;

		if ($userSignUp) {

			//echo "Account created successfully";
			//header("refresh:3; url = homepage.html");

		} else {

			//echo 'Account not created';
			//header("refresh:3; url = signupPage.html");
		}
	}
?>