<?php

    function getDbConnect() {
        $dbType = "postgres";
        if ($dbType == "postgres") {
            // get a database connection to postgres database
            $con = pg_connect("host=localhost dbname=project user=postgres password=root port=5432");
            return $con;
        } else if ($dbType == "mysql") {
            // get a database connection to to mysql database
            $con = mysqli_connect("localhost:3306", "newuser01", "st2220", "tasksourcingdb");
            return $con;
        }
    }

?>
