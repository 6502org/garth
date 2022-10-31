<?php

function garth_get_db_connection()
{
    $filename = realpath(dirname(__FILE__) . '/../database.sqlite3');
    return new PDO("sqlite:$filename");
}

function garth_exit_if_db_error($result)
{
    if ($result === false) {
      	echo("<p>Error performing query: " . var_export($dbcnx->errorInfo()) . "<p>");
      	exit();
    }
}
