<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'mystore';

$con = mysqli_connect($host, $user, $password, $database);
if (!$con) {
    die(mysqli_connect_error());
}

?>
