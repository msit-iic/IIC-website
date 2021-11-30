<?php
// Remote Development Credentials :
$host = "127.0.0.1";
$userName = "iic_msit";
$password = "iicmsit@2021";
$dbName = "iic_msit";

$link = mysqli_connect($host, $userName, $password, $dbName);
if (mysqli_connect_error()) {
    print_r(mysqli_connect_error());
    exit();
}

?>
