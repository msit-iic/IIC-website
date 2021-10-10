<?php

//  ========================================================================================
//--------------------------Starting Session ------------------------------------------------
//  ========================================================================================

session_start();
require_once("hash.php");


//  ========================================================================================
// --------------------------------- Loggoing Out ------------------------------------------
//  ========================================================================================
if (isset($_GET['process']) && $_GET['process'] == "logout") {
    session_unset();
}


// =========================================================================================
# General Fetching Function 
// ========================================================================================
function fetchData($table, $column, $distinct = 0, $where = "", $unique = "", $limit = 0,$orderBy="")
{
    global $link;
    if ($distinct != 0) {
        $distinct = "DISTINCT";
    } else {
        $distinct = "";
    }

    if ($where != "") {
        $where = "WHERE `" . $unique . "`='" . mysqli_real_escape_string($link, $where) . "'";
    }

    if ($limit != 0) {
        $limit = "LIMIT " . $limit;
    } else {
        $limit = "";
    }

    if ($orderBy!= "") {
        $orderBy= "ORDER BY ".$orderBy." DESC";
    } else {
        $orderBy= "";
    }

    $sql = "SELECT " . $distinct . " " . $column . " FROM `" . $table . "` " . $where . " ".$orderBy." " . $limit . " ";
    $result = mysqli_query($link, $sql);


    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }
        return $arr;
    } else {
        return mysqli_error($link);
        // return "Unable to Fetch " . ucfirst($column) . " details.";
    }
}

// =========================================================================================
# General Fetching Function with Where Condition is NOT Equal to 
// ========================================================================================
function fetch($table, $column, $distinct = 0, $where = "", $unique = "",$not=0, $limit = 0,$orderBy="")
{
    global $link;
    if ($distinct != 0) {
        $distinct = "DISTINCT";
    } else {
        $distinct = "";
    }

    if ($where != "") {
        $where = "WHERE `" . $unique . "`='" . mysqli_real_escape_string($link, $where) . "'";
    }

    if($not!=0){
        $where = "WHERE `".$unique."` NOT IN ('".$not."')";
    }

    if ($limit != 0) {
        $limit = "LIMIT " . $limit;
    } else {
        $limit = "";
    }

    if ($orderBy!= "") {
        $orderBy= "ORDER BY ".$orderBy." DESC";
    } else {
        $orderBy= "";
    }

    $sql = "SELECT " . $distinct . " " . $column . " FROM `" . $table . "` " . $where . " " . $limit . " ".$orderBy." ";
    $result = mysqli_query($link, $sql);


    if ($result && mysqli_num_rows($result) > 0) {
        $arr=mysqli_fetch_all($result);
        return $arr;
    } else {
        // return mysqli_error($link);
        return "Unable to Fetch " . ucfirst($column) . " details.";
    }
}

// Function to Ecncrypt Strings for Table Title 
function encrypt($string){
    $string = str_replace(" ", "-", trim(strtolower($string)));
    $string = str_replace(str_split('\\/:*?"<,>|+-!@#$%^&=(){}\''), "", $string);
    $string=$string."contents";
    return $string;
}



// function to Calculate Time Since 

function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'min'),
        array(1 , 'sec')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}



// ===============------------  Function for creating Slug -----------------====================
function slug($title, $separator = '-')
{
    // convert String to Utf-8 Ascii
    $title = iconv(mb_detect_encoding($title, mb_detect_order(), true), "UTF-8", $title);
 
    // Convert all dashes/underscores into separator
    $flip = $separator == '-' ? '_' : '-';
 
    $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);
 
    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($title));
 
    // Replace all separator characters and whitespace by a single separator
    $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);
 
    return trim($title, $separator);
}