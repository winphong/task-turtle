<?php

    $dbType = "none";

    function getDbConnect() {
        try {
            // get a database connection to postgres database
            $con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");

            // if postgres database connection succeeds
            if ($con) {
                $dbType = "postgres";
            }
            
        } catch (Exception $e) {
            try {
                // get a database connection to postgres database
                $con = mysqli_connect("localhost:3306", "newuser01", "st2220", "tasksourcingdb"); // get connection to mysql

                // if mysql database connection succeeds
                if ($con) {
                    $dbType = "mysql";
                }
            } catch (Exception $e) {
                echo "No database connection established.";
            }
        }


        return $con;
    }

?>
