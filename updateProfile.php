<?php

    session_start();

    require 'dbfunction.php';
    require 'dbqueryfunction.php';

    $con = getDbConnect();

    if (!$con) {
        echo 'Not connected to server';
    }

    if (isset($_POST['update_settings'])) {
        $display_name = ($_POST['display_name'] == "") ? $_SESSION['userinfo']['display_name'] : $_POST['display_name'];
        $user_profile = ($_POST['user_profile'] == "") ? "DEFAULT" : "'" . $_POST['user_profile'] . "'";
        $username = $_SESSION['userinfo']['user_name'];

        $queryStr = "UPDATE userTable SET display_name = '$display_name', user_profile = $user_profile WHERE user_name = '$username'";
        $updateUser = dbQuery($con, $queryStr);

        if ($updateUser) {
            $queryStr = "SELECT * FROM userTable WHERE user_name='$username'";
            $_SESSION['userinfo'] = dbFetchArray(dbQuery($con, $queryStr));
            echo "Profile updated!";
            header("refresh:0.5; url = viewProfileSettings.php");
        } else {
            echo "Failed to update profile.";
            header("refresh:1; url = editProfileSettings.php");
        }
    }

?>