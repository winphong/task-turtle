<?php
    require 'checkLoginStatus.php';
?>
<html>
    <head>
        <title>Task Turtle - Change Password</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function checkPasswordMatch() {
                var password = $("#newPassword").val();
                var confirmPassword = $("#confirmPassword").val();
                if (password != confirmPassword && password != "" && confirmPassword != "") {
                    $("#divCheckPasswordMatch").html("Passwords do not match.");
                } else {
                    $("#divCheckPasswordMatch").html("");
                }
            }
            function validateForm() {
                var oldPass = $("#oldPassword").val();
                var newPass = $("#newPassword").val();
                var confirmPass = $("#confirmPassword").val();
                if (oldPass === "" || newPass === "" || confirmPass === "") {
                    alert("All fields must be filled out.");
                    return false;
                } else if (newPass !== confirmPass && newPass !== "" && confirmPass !== "") {
                    alert("Passwords do not match. Please check again.");
                    return false;
                }
            }

            $(document).ready(function() {
                $("#confirmPassword").keyup(checkPasswordMatch);
            });
        </script>
    </head>
    <body>
        <?php
            include 'headermenu.php';
        ?>
        <h1> Task Turtle </h1>
        <div>
        <?php
        require 'dbfunction.php';
        require 'dbqueryfunction.php';
        $oldPassword = (!isset($_POST['oldPassword'])) ? NULL : $_POST['oldPassword'];
        $newPassword = (!isset($_POST['newPassword'])) ? NULL : $_POST['newPassword'];
        if ((!empty($newPassword) && !empty($oldPassword)) || (($newPassword != NULL) && ($oldPassword != NULL))) {
            $con = getDbConnect();

            if (!$con) {
                echo 'Not connected to server. Please try again later.';
            } else {
                $queryStr = "UPDATE userTable SET password = '$newPassword' WHERE user_name = '" . $userinfo['user_name'] . "' AND password = '$oldPassword'";
                $result = dbQuery($con, $queryStr);

                if (dbAffectedRows($con, $result) > 0) {
                    echo "Password has been updated.";
                    header("refresh:2; url = viewProfileSettings.php");
                } else {
                    echo "An error has occurred. Please check if your old password is correct.<br /><br /><a href=''>Back</a>";
                }
            }

        } else {
            echo "
        <h2>Change Password</h2>
        <form action='passwordChange.php' method='post' onsubmit='return validateForm()'>
          <table>
            <tr>
              <td>Old Password:</td>
              <td><input id='oldPassword' type='password' name='oldPassword' /></td>
            </tr>
            <tr>
              <td>New Password:</td>
              <td><input id='newPassword' type='password' name='newPassword' /></td>
            </tr>
            <tr>
              <td>Re-enter your New Password:</td>
              <td><input id='confirmPassword' type='password' /></td>
            </tr>
          </table>
          <div id='divCheckPasswordMatch'></div>
          <input style='padding:2px 7px 2px 7px;margin-left:16.4em;' type='submit' name='submit' value='Change Password' />
        </form>\n";
        }
        ?>
        </div>
    </body>
</html>