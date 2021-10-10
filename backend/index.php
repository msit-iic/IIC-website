<?php
include_once("control/function.php");



if (isset($_GET["url"])) {
    $url = $_GET["url"];
    if (isset($_SESSION["id"])) {
        if(strcmp($url,"admins")=="0"){
            include_once("views/admins.php");
        }else if(strcmp($url,"blogs")=="0"){
            include_once("views/blogs.php");
        }else if(strcmp($url,"mailing-list")=="0"){
            include_once("views/mailing-list.php");
        }else if(strcmp($url,"compose")=="0"){
            include_once("views/compose.php");
        }else {
            include_once("views/dashboard.php");
        }
    } else {
        if(strcmp($url,"access_denied")=="0"){
            include_once("views/access_denied.php");
        }else if(strcmp($url,"user-interface")=="0"){
            include_once("views/user-interface.php");
        }else{
            include_once("views/login.php");
        }
    }
} else {
    include_once("views/login.php");
}
