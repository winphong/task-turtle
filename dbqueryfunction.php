<?php

    function dbQuery($con, $queryStr) {
        $dbType = "postgres";
        if ($dbType == "postgres") {
            // get a postgres query
            return pg_query($con, $queryStr);
        } else if ($dbType == "mysql") {
            // get a mysql query
            return mysqli_query($con, $queryStr);
        }
    }

    function dbFetchArray($queryResult) {
        $dbType = "postgres";
        if ($dbType == "postgres") {
            // get a postgres query
            return pg_fetch_array($queryResult, NULL, PGSQL_ASSOC);
        } else if ($dbType == "mysql") {
            // get a mysql query
            return mysqli_fetch_array($queryResult);
        }
    }

    function dbAffectedRows($con, $queryResult) {
        $dbType = "postgres";
        if ($dbType == "postgres") {
            // return number of affected rows for postgres database
            return pg_affected_rows($queryResult);
        } else if ($dbType == "mysql") {
            // return number of affected rows for mysql database
            return mysqli_affected_rows($con);
        }
    }
?>
