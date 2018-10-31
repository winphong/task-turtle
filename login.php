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

        $queryStr = "SELECT * FROM userTable WHERE user_name='$username' AND password='$password'";
        $userLogin = dbQuery($con, $queryStr);
        $result = dbFetchArray($userLogin);

        session_start();
        // Double recorded
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

        if ($result) {
            // Double recorded
            $_SESSION['userinfo'] = $result;
            echo 'Successful';
            header("refresh:0.1; url = loggedInHomepage.html");

        } else {

            echo 'Log in unsuccessful';
            header("refresh:0.1; url = loginPage.html");
        }
    }
?>
