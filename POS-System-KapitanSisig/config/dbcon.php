<?php

define('DB_SERVER', "localhost");
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DB_DATABASE', "db_kapitanSisig");

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, 4306);

if(!$conn){
    die("Connection Failed: ". mysqli_connect_error());
}

?>