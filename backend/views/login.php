<?php 
    if(isset($_SESSION["id"])){
        header("location:dashboard");
    }else{
        include_once("admin_sections/login-header.php");
        include_once("admin_sections/login-form.php");
        include_once("admin_sections/login-footer.php");
    }    


?>