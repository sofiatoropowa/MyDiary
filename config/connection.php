<?php

$db_host = "localhost";
$db_username = "root";
$db_pass = "";
$db_name = "diary";
$connect = new mysqli($db_host, $db_username, $db_pass, $db_name);

// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>