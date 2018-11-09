<?php

    session_start();

    require 'dbfunction.php';
    require 'dbqueryfunction.php';

    $con = getDbConnect();

    if (!$con) {
        echo 'Not connected to server';
    } else {

        if (isset($_POST['create_task'])) {

            $title = $_POST['title'];
            $description = ($_POST['description'] == "") ? "DEFAULT" : "'" . $_POST['description'] . "'";
            $task_date = $_POST['task_date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $location = $_POST['location'];
            $category = $_POST['category'];
            $post_date = date("Y-m-d");
            $username = isset($_POST['creator']) ? $_POST['creator'] : $_SESSION['username'];

            $queryStr = "INSERT INTO task(title, description, task_date, start_time, end_time, location, category, post_date, creator) VALUES ('$title', $description, '$task_date', '$start_time', '$end_time', '$location', '$category', '$post_date', '$username')";
            $userCreateTask = dbQuery($con, $queryStr);

            if (dbAffectedRows($con, $userCreateTask) > 0) {
                echo "Task created successfully!";

                if (isset($_POST['creator'])) {

                    header("refresh:0.5;url = 'adminSearchResultPage.html'");

                } else {

                    header("refresh:0.5; url = 'loggedInHomepage.html'");
                }

            } else {
                echo "Task creation failed. " . dbGetErrorMessage($con);
                header("refresh:3; url = createTask.php");
            }

        }

    }
?>