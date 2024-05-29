<?php


$DB_LOCAL = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "prak";

$db = mysqli_connect($DB_LOCAL, $DB_USER, $DB_PASS, $DB_NAME);

return $db;