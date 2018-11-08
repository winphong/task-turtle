<?php

    require 'dbfunction.php';
    require 'dbqueryfunction.php';

    $con = getDbConnect();

    if (!$con) {
        echo 'Not connected to server';
    } else {
        $bidValue = $_POST['bidValue'];
        $taskid = $_POST['taskid'];

        session_start();
        $username = $_SESSION["username"];
        $_SESSION["taskid"] = $taskid;

        $checkBidQuery = "SELECT bid_value FROM bid WHERE bidder='$username' AND task='$taskid'";
        $checkBidForTask =  dbQuery($con, $checkBidQuery);

        $currentBid = dbFetchArray($checkBidForTask);

        // If the bidder has bid for the task before
        if ( $currentBid ) {

            // If the bid value is the same
            if ( $currentBid['bid_value'] == $bidValue ) {
                echo "The exact same bid has already been submitted";
                header("refresh:1; url = bidPage.php");
            } else { // If the bid value is different, update the bid value

                $bidUpdateQueryStr = "UPDATE bid SET bid_value='$bidValue' WHERE bidder='$username' AND task='$taskid'";
                $bidUpdate = dbQuery($con, $bidUpdateQueryStr);
                echo "Bid updated successfully";
                header("refresh:1; url = taskPage.php");
            }

        } else { // If the bidder never bid for the task before

            $bidInsertQueryStr = "INSERT INTO bid VALUES ('$username', '$taskid', '$bidValue', 'pending')";
            $bidInsert = dbQuery($con, $bidInsertQueryStr);

            if (dbAffectedRows($con, $bidInsert) > 0) {
                echo "Bid submitted successfully";
                header("refresh:1; url = taskPage.php");
            } else {
                echo "Bid failed. " . dbGetErrorMessage($con);
                header("refresh:2; url = taskPage.php");
            }
        }

    }
?>