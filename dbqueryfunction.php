<?php

    function dbQuery($con, $queryStr) {
        $dbType = "mysql";
        if ($dbType == "postgres") {
            // get a postgres query
            return pg_query($con, $queryStr);
        } else if ($dbType == "mysql") {
            // get a mysql query
            return mysqli_query($con, $queryStr);
        }
    }

    function dbFetchArray($queryResult) {
        $dbType = "mysql";
        if ($dbType == "postgres") {
            // get a postgres query
            return pg_fetch_array($queryResult, NULL, PGSQL_ASSOC);
        } else if ($dbType == "mysql") {
            // get a mysql query
            return mysqli_fetch_array($queryResult);
        }
    }

?>
