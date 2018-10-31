<?php
    require 'checkLoginStatus.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title> TaskTurtle | Account Settings </title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  </head>
    <body>
      <div id="header">
        <div id="branding"> <!-- contains sitename and logo to align left -->
          <img id="logo" src="assets/logo.png"></img>
          <p id="sitename"><a href="loggedInHomepage.html">TaskTurtle</a></p>
        </div>
        <ul class="nav" id="topnav">
          <?php include 'headermenu.php'; ?>
        </ul>
      </div> <!-- end header -->

      <main class="flex">
      	<h1>Account Settings</h1>
          <table>
            <tr>
              <td>Username:</td>
              <td><?= $userinfo['user_name'] ?></td>
            </tr>
            <tr>
              <td>Display name:</td>
              <td><?= $userinfo['display_name'] ?></td>
            </tr>
            <tr>
              <td>Profile bio:</td>
              <td><?= $userinfo['user_profile'] ?></td>
            </tr>
          </table>
          <ul class="nav">
            <li class="special-button" onclick="location.href='passwordChange.php';">Change Password</li>
            <li class="special-button" onclick="location.href='editProfileSettings.php';">Edit Biography</li>
            <li class="special-button" onclick="location.href='listOfPostedTask.php';">Posted Task</li>
            <li class="special-button" onclick="location.href='assignedTaskForBidder.php';">Succesful Bidder's Task</li>
          </ul>
      </main>
    </body>
</html>
