<?php
    require 'checkLoginStatus.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Task Turtle | Profile Settings </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            $('document').ready(function() {
                $("#cancel").click(function(e) {
                    e.preventDefault();
                    location.href = 'viewProfileSettings.php';
                });
                $("#passwordchange").click(function(e) {
                    e.preventDefault();
                    location.href = 'passwordChange.php';
                });
            });
        </script>
    </head>
    <body>
        <?php
            include 'template.php';
        ?>
        <h1> Task Turtle </h1>
        <h2 style="padding-bottom: 0.5em;">Settings - Edit Mode</h2>
        <form action="updateProfile.php" method="post">
            <div>
                <h3>Account Information</h3>
                <table>
                <tr>
                    <td>Username: <?= $userinfo['user_name'] ?></td>
                </tr>
                <tr>
                    <td>Display name: <input type="text" name="display_name" value="<?= $userinfo['display_name'] ?>" /></td>
                </tr>
                <tr>
                    <td><button id="passwordchange">Change Password</button></td>
                </tr>
                </table>
            </div>
            <br />
            <div>
                <h3>Profile Bio</h3>
                <p><input type="text" name="user_profile" value="<?= $userinfo['user_profile'] ?>"></p>
            </div>
            <button id="cancel">Cancel</button><input type="submit" name="update_settings" value="Confirm" />
        </form>
    </body>
</html>