<?php
	
	require 'dbfunction.php';
	require 'dbqueryfunction.php';

	$con = getDbConnect();

	if (!$con) {

		echo 'Not connected to server';
	}

	if (isset($_POST['signup'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$userProfile = ($_POST['userProfile'] == "") ? "DEFAULT" : "'" . $_POST['userProfile'] . "'";

        $queryStr = "INSERT INTO userTable VALUES ('$username', '$password', '$name', $userProfile)";
		$userSignUp = dbQuery($con, $queryStr);

		if ($userSignUp) {
			echo "Account created successfully";
			header("refresh:3; url = homepage.php");
		} else {
			echo 'Account not created';
			header("refresh:3; url = signupPage.html");
		}
	}
?>