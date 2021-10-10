<?php
// Remote Development Credentials :
$host = "localhost";
$userName = "amar";
$password = "webadvisor@0401";
$dbName = "iic_msit";

$link = mysqli_connect($host, $userName, $password, $dbName);
if (mysqli_connect_error()) {
    print_r(mysqli_connect_error());
    exit();
}

?>
