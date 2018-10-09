<?php

    $dbType = "none";

    function getDbConnect() {
        // get a database connection to postgres database
        $con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

        // check if postgres database connection failed
        if (!$con) {
            $con = mysqli_connect("localhost:3306", "newuser01", "st2220", "tasksourcingdb"); // get connection to mysql

            // if mysql database connection succeeds
            if ($con) {
                $dbType = "mysql";
            }
        } else {
            $dbType = "postgres";
        }

        return $con;
    }

?>
