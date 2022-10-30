<?php

require_once dirname(__FILE__) . '../../../../../config/environment.php';

function garth_get_db_connection()
{
    // read config
    $config = Horde_Yaml::loadFile(MAD_ROOT.'/config/database.yml');
    $spec = $config[MAD_ENV];

    // connect to the database server
    $dbcnx = @mysql_connect($spec['host'], $spec['username'], $spec['password']);
    if (!$dbcnx) {
    	die("<p>Unable to connect to the database server at this time.</p>");
    }

    // Select the database
    $result = mysql_select_db($spec['database']);
    if (!$result) {
     	die("<p>Database error: " . mysql_error() . "<p>");
    }

    return $dbcnx;    
}
