<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "new-myapp";
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Database tidak terhubung");
}
// echo "database connected";
