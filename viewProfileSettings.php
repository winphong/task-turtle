<?php
    require 'checkLoginStatus.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle - Profile Settings </title>
    </head>
    <body>
        <?php
            include 'headermenu.php';
        ?>
    	<h1> Task Turtle </h1>
    	<h2>Settings</h2>
        <div>
            <h3>Account Information</h3>
            <table>
            <tr>
                <td>Username: <?= $userinfo['user_name'] ?></td>
            </tr>
            <tr>
                <td>Display name: <?= $userinfo['display_name'] ?></td>
            </tr>
            <tr>
                <td><button onclick="location.href='passwordChange.php';">Change Password</button></td>
            </tr>
            </table>
        </div>
        <div>
            <h3>Profile Bio</h3>
            <p><?= $userinfo['user_profile'] ?></p>
        </div>
        <button onclick="location.href='editProfileSettings.php';">Edit</button>
    </body>
</html>