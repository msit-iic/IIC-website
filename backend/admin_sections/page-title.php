<?php 
$title="";
    if(strcmp($url,"admins")=="0"){
        $title="Manage Admin Profile | IIC MSIT";
    }else if(strcmp($url,"blogs")=="0"){
        $title="Blogs | IIC MSIT";
    }else if(strcmp($url,"mailing-list")=="0"){
        $title="Mailing List | IIC MSIT";
    }else if(strcmp($url,"compose")=="0"){
        $title="Compose Mail | IIC MSIT";
    }else {
        $title="Dashboard | IIC MSIT";
    }
?>