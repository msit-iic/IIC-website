<?php

if (isset($_GET["process"])) {

    include_once("function.php");
    $error = "";

    // Unauthorized Access 
    if ($_GET["process"] == "") {
        include_once("../views/access_denied.php");
    }

    /* ----------------------------------------------------------------------------------------------------------
Admin Authentication Operations : 
------------------------------------------------------------------------------------------------------------*/

    // ------- Login Action --------
    if (isset($_GET["process"]) && $_GET["process"] == "login") {
        if (!isset($_POST["username"]) || !isset($_POST["password"])) {
            include_once("../views/access_denied.php");
            exit();
        } else {
            if ($_POST["username"] == "") {
                $error = "<li>Username is Required.</li>";
            }

            if ($_POST["password"] == "") {
                $error .= "<li>Password is Required.</li>";
            }

            if ($error != "") {
                echo "<h4>Please Lookout for these points :</h4> 
                <ul>
            " . $error .
                    "</ul>";
                exit();
            }

            // ------- Validations Done : 
            // ------ Signing in the user after checking if username Password Match ------ 
            $sql1 = "SELECT * FROM `admin` WHERE `username` = '" . mysqli_real_escape_string($link, $_POST['username']) . "' LIMIT 1";
            $result1 = mysqli_query($link, $sql1);
            if ($result1 && mysqli_num_rows($result1) > 0) {
                $row = mysqli_fetch_assoc($result1);
                if ($row['password'] == md5(md5($row['id']) . $_POST['password'])) {
                    $id = $row['id'];
                    $_SESSION['id'] = $id;
                    echo "200";
                } else {
                    $error = "Could not find that Username-Password Combination ! Please try Again !";
                }
            } else {
                $error = "Username Invalid. Access Denied.";
            }
            if ($error != "") {
                echo $error;
            }
        }
    }



    // -------------- ========== Reset Password =========================-----------------------
    // Verify Username 
    if ($_GET["process"] == "verify-username") {
        // Form Validation ------------
        if (!isset($_POST["username"])) {
            include_once("../views/access_denied.php");
            exit();
        } else {
            if ($_POST["username"] == "") {
                $error .= "<br>A Username is required. ";
            }
            if ($error != "") {
                echo "Your Form has the following Problem(s) : " . $error;
                exit();
            }

            // --------------- Reset Password Searching Username ------------

            $sql1 = "SELECT * FROM `admin` WHERE `username`='" . mysqli_real_escape_string($link, $_POST['username']) . "' LIMIT 1";
            $result1 = mysqli_query($link, $sql1);
            if ($result1 && mysqli_num_rows($result1) > 0) {
                $row1 = mysqli_fetch_assoc($result1);
                $id = $row1["id"];
                $_SESSION["tmp_id"] = $id;
                // Making Verification Code : 
                $code = substr(md5(md5(md5($id) . time()) . $row1["username"]), 4, 6);
                $sql2 = "UPDATE `admin` SET `code`='" . mysqli_real_escape_string($link, $code) . "' WHERE `id`='" . mysqli_real_escape_string($link, $id) . "'";
                $result2 = mysqli_query($link, $sql2);

                // Sending Verification Code via Mail : 
                $to = $row1["email"];

                // Email subject 
                $subject = 'Code for Reseting Password.';

                // Sender 
                $from = 'noreply@iic.msit.in';
                $fromName = 'IIC MSIT';

                // Email Content  
                $htmlContent = '<html><body>';
                $htmlContent .= '<div style="background-color:whitesmoke;padding:20px;font-size:16px;line-height:20px;">';
                $htmlContent .= 'Hello ' . $row1["username"] . ',' . '<br><br>';
                $htmlContent .= "There is an attempt to Reset your Password for your Admin Profile for the IIC MSIT website. ";
                $htmlContent .= "If you did not try to do so, make sure no one else has access to this email and relax. ";
                $htmlContent .= "If you do want to reset the Password here is the code : ";
                $htmlContent .= '<br>
                <div style="padding:12px; margin:10px;background-color:black;color:white;font-size:48px;font-weight:900;width:max-content;">
                    ' . $code . '
                </div>
            <br>';

                $htmlContent .= "<br>Regards,<br>Technical Team,<br>IIC MSIT";
                $htmlContent .= '</div>';
                $htmlContent .= "</body></html>";


                // Header for sender info 
                $headers = "From: $fromName" . " <" . $from . ">";

                // Boundary  
                $semi_rand = md5(time());
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

                // Headers for attachment  
                $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

                // Multipart boundary  
                $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";


                if (mail($to, $subject, $message, $headers)) {
                    echo "Username Verified. An Email with 6 digit code is Sent to your Username Associated Email (" . substr($row1["email"], 0, 7) . "...)";
                } else {
                    echo 'Username Verified. But we were unable to send Email for Code. Ask other admins to Update your Email ID';
                }
            } else {
                // Username Not Found 
                echo "402";
                exit();
            }
        }
    }



    // Verify Username 
    if ($_GET["process"] == "verify-code") {
        // Form Validation ------------
        if (!isset($_POST["verification-code"])) {
            include_once("../views/access_denied.php");
            exit();
        } else {

            if ($_POST["verification-code"] == "") {
                $error .= "<br>Code is required. ";
            }
            if ($error != "") {
                echo "Your Form has the following Problem(s) : " . $error;
                exit();
            }

            if (isset($_SESSION["tmp_id"])) {
                $id = $_SESSION["tmp_id"];
                $sql1 = "SELECT `code` FROM `admin` WHERE `id`=" . mysqli_real_escape_string($link, $id);
                $result1 = mysqli_query($link, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row1 = mysqli_fetch_assoc($result1);
                    if ($_POST["verification-code"] == $row1["code"]) {
                        echo "200";
                    } else {
                        echo "Verification Code not matched. Access Denied";
                    }
                }
            } else {
                // print_r($_SESSION);
                echo "Something Went Wrong, Please try again Later";
            }
        }
    }

    // Update Password 
    if ($_GET["process"] == "update-password") {
        // Form Validation ------------

        if (!isset($_POST["update-password"])) {
            include_once("../views/access_denied.php");
            exit();
        } else {
            if ($_POST["update-password"] == "") {
                $error .= "<br>Password is required. ";
            }
            if ($error != "") {
                echo "Your Form has the following Problem(s) : " . $error;
                exit();
            }

            if (isset($_SESSION["tmp_id"])) {
                $id = $_SESSION["tmp_id"];
                $sql1 = "UPDATE `admin` SET `password`='" . mysqli_real_escape_string($link, md5(md5($id) . $_POST["update-password"])) . "' WHERE `id`=" . mysqli_real_escape_string($link, $id);
                $result1 = mysqli_query($link, $sql1);
                if ($result1) {
                    unset($_SESSION["tmp_id"]);
                    echo "200";
                } else {
                    echo "Something Went Wrong, Please try again Later";
                }
            } else {
                echo "Something Went Wrong, Please try again Later";
            }
        }
    }


    /* ----------------------------------------------------------------------------------------------------------
Admin Profile Operations : 
------------------------------------------------------------------------------------------------------------*/


    // --------- Adding new Admin -----------
    if (isset($_GET["process"]) && $_GET["process"] == "add-new-admin") {
        if (!isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["password"])) {
            include_once("../views/access_denied.php");
            exit();
        } else {
            if ($_POST["username"] == "") {
                $error = "<li>Username is Required.</li>";
            }

            if ($_POST["email"] == "") {
                $error .= "<li>An Email Id is required.</li>";
            } else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
                $error .= "<li>Entered Email Address is Invalid.</li>";
            }

            if ($_POST["password"] == "") {
                $error .= "<li>Password is Required.</li>";
            }

            if ($error != "") {
                echo "<h4>Please Lookout for these points :</h4> 
                <ul>
            " . $error .
                    "</ul>";
                exit();
            }

            // Validations Done : 
            // --------------- Checking if the Signing Up input email is already taken ------------
            $sql1 = "SELECT * FROM `admin` WHERE `username`='" . mysqli_real_escape_string($link, $_POST['username']) . " LIMIT 1";
            $result1 = mysqli_query($link, $sql1);
            if ($result1 && mysqli_num_rows($result1) > 0) {
                $error = "This Username is already taken !";
            } else {
                //  ---------------- Siging up if no user found with entered email ----------
                $sql2 = "INSERT INTO `admin` (`username`,`email`,`password`) VALUES ('" . mysqli_real_escape_string($link, $_POST['username']) . "','" . mysqli_real_escape_string($link, $_POST['email']) . "','" . mysqli_real_escape_string($link, $_POST['password']) . "')";
                $result2 = mysqli_query($link, $sql2);
                if ($result2) {
                    $id = mysqli_insert_id($link);
                    // ---------------- Password Hashing --------------------- 
                    $query = "UPDATE `admin` SET `password` = '" . md5(md5($id) . $_POST['password']) . "' WHERE `id`=" . $id . " LIMIT 1";
                    mysqli_query($link, $query);
                    echo "200";
                } else {
                    $error = "Couldn't Create User - Please try again later ".mysqli_error($link);
                }
            }

            if ($error != "") {
                echo $error;
            }
        }
    }

    //  =======================================----------- Updating Admin Profile -------------------======================================
    if ($_GET["process"] == "update-admin-profile") {
        if (!isset($_POST["username"]) || !isset($_POST["email"]) || !isset($_POST["admin-id"])) {
            include_once("../views/access_denied.php");
            exit();
        } else {
            $sql1 = "UPDATE `admin` SET 
            `username`='" . mysqli_real_escape_string($link, $_POST["username"]) . "',
            `email`='" . mysqli_real_escape_string($link, $_POST["email"]) . "'
            WHERE `id`=" . mysqli_real_escape_string($link, $_POST["admin-id"]);
            $result1 = mysqli_query($link, $sql1);
            if ($result1) {

                echo "200";
            } else {
                echo 'Something Gone Wrong. Please try Again.';
            }
        }
    }


    //  =======================================----------- Deleting Admin Profile -------------------======================================
    if ($_GET["process"] == "delete-admin-profile") {
        if (!isset($_POST["username"])) {
            include_once("../views/access_denied.php");
            exit();
        } else {
            $sql1 = "DELETE FROM `admin` WHERE `username`='" . mysqli_real_escape_string($link, $_POST["username"]) . "'";
            $result1 = mysqli_query($link, $sql1);
            if ($result1) {
                echo "200";
            } else {
                echo 'Something Gone Wrong. Please try Again Later.';
            }
        }
    }


    // ==================-----------------  Subscribe to Mails Response :  User Interface For Testing ----------------============  
    if ($_GET["process"] == "subscribe") {
        if (!isset($_POST["email"])) {
            include_once("../views/access_denied.php");
            exit();
        } else {
            $email = $_POST["email"];
            if ($email == "") {
                echo "No Email ID provided";
                exit();
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo "Entered Email Address is Invalid.";
                exit();
            }

            $checkmail = fetchData("mailing-list", "*", 0, $email, "email");
            if (is_array($checkmail)) {
                // Mail Already Subscribed
                echo "201";
                exit();
            } else {
                $timezone = "Asia/Kolkata";
                $currentTime = new DateTime("now", new DateTimeZone($timezone));
                $dateTime = $currentTime->format('Y-m-d H:i:s');
                // Validations Done
                $sql1 = "INSERT INTO `mailing-list` (`email`,`created_at`) VALUES ('" . mysqli_real_escape_string($link, $email) . "','" . mysqli_real_escape_string($link, $dateTime) . "')";
                $result1 = mysqli_query($link, $sql1);

                if ($result1) {
                    // Time to Send Subscription Mail
                    // Sending Verification Code via Mail : 
                    $to = $email;

                    // Email subject 
                    $subject = "Thank You for Subscribing to Instituition's Innovation Council, MSIT.";

                    // Sender 
                    $from = 'noreply@iic.msit.in';
                    $fromName = 'IIC MSIT';

                    // Email Content  
                    $htmlContent = '<html>
    <head>
        <style type="text/css">
            body{
                margin:0px;
                padding:20px;
                background-color:whitesmoke;
            }   
            .section-title{
                font-size:40px;
                line-height:50px;
                font-family:"Times New Roman", Times, serif;
                font-weight:500;
                text-align:center;
                vertical-align: middle;
            }
            .section-title-logo{
                height:200px;
                width:100%;
            }
            .section-title-logo img{
                margin:20px 40px;
            }
            .mail-body{
                position:relative;
                font-family:Verdana, Geneva, Tahoma, sans-serif;
                font-size:16px;
                line-height:20px;
            }
            .mail-body a{
                text-decoration:none;
                color:black;
                font-weight:800;
                font-size:14px;
                line-height:17.5px;
            }
            </style>    
    </head>
    <body style="padding:20px;background-color:whitesmoke;">';
                    $htmlContent .= '<section class="mail-body" style="background-color:whitesmoke;padding:20px;">
        <div class="section-title" style="background-color:whitesmoke;">
            Instituition\'s Innovation Council of MSIT
        </div>
        <div class="section-title-logo" style="display:flex;justify:space-around;">    
            <img src="https://iic.msit.in/backend/assets/img/logo.png" alt="IIC, MSIT">                                     
            <img src="https://iic.msit.in/backend/assets/img/logo_name.png" alt="Instituition\'s Innovation Council,MSIT">                                     
        </div>';
                    $htmlContent .= '<div>
            Hi ' . $email . ',<br><br>

            Thanks for subscribing to newsletter and blog of Institution Innovation Council of MSIT.<br><br>
            
            You’re signed up to get periodic and regular notification about IIC’s activities.<br><br>
            
            We’re going to take you on a tour of Innovation and Entrepreneurship.<br><br>
            
            Stay tuned, something awesome is coming soon and we are working hard.<br>
            We are almost ready to get you on the safari. Be first to know.<br>
            <br>
            Cheers,<br>
            IIC MSIT<br><br>
            
            Web: <a href="https://iic.msit.in" target="_blank">https://iic.msit.in</a><br>  
            Instagram: <a href="https://www.iic.msit.in/Instagram" target="_blank">https://www.iic.msit.in/Instagram</a><br>
            Facebook: <a href="https://www.iic.msit.in/Facebook" target="_blank">https://www.iic.msit.in/Facebook</a><br>
            LinkedIn: <a href="https://www.iic.msit.in/LinkedIn" target="_blank">https://www.iic.msit.in/LinkedIn </a><br>
            
        </div>
    </section>';
                    $htmlContent .= '</body>
    </html>';


                    // Header for sender info 
                    $headers = "From: $fromName" . " <" . $from . ">";

                    // Boundary  
                    $semi_rand = md5(time());
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

                    // Headers for attachment  
                    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

                    // Multipart boundary  
                    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";


                    if (mail($to, $subject, $message, $headers)) {
                        echo "200";
                    } else {
                        // Unable to Send Mail 
                        echo "500";
                    }
                } else {
                    // Unable to Insert Data to the Database
                    echo "Something went Wrong! Please try again later";
                }
            }
        }
    }






    // ==================-----------------  Message Sent Response :  User Interface For Testing ----------------============  
    if ($_GET["process"] == "message") {
        if (!isset($_POST["email"])) {
            include_once("../views/access_denied.php");
            exit();
        } else {

            $name = $_POST["name"];
            $email = $_POST["email"];
            $message = $_POST["message"];

            if ($email == "") {
                echo "No Email ID provided.";
                exit();
            } else if ($name == "") {
                echo "Full Name not provided.";
                exit();
            } else if ($message == "") {
                echo "Message not provided.";
                exit();
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                echo "Entered Email Address is Invalid.";
                exit();
            }

            // Validations Done
            $sql1 = "INSERT INTO `message-data` (`name`,`email`,`message`) VALUES ('" . mysqli_real_escape_string($link, $name) . "','" . mysqli_real_escape_string($link, $email) . "','" . mysqli_real_escape_string($link, $message) . "')";
            $result1 = mysqli_query($link, $sql1);

            if ($result1) {
                // Time to Send Subscription Mail
                // Sending Verification Code via Mail : 
                $to = $email;

                // Email subject 
                $subject = "Thank You for Contacting Instituition's Innovation Council, MSIT.";

                // Sender 
                $from = 'noreply@iic.msit.in';
                $fromName = 'IIC MSIT';

                // Email Content  
                $htmlContent = '<html>
    <head>
        <style type="text/css">
            body{
                margin:0px;
                padding:20px;
                background-color:whitesmoke;
            }   
            .section-title{
                font-size:40px;
                line-height:50px;
                font-family:"Times New Roman", Times, serif;
                font-weight:500;
                text-align:center;
                vertical-align: middle;
            }
            .section-title-logo{
                height:200px;
                width:100%;
            }
            .section-title-logo img{
                margin:20px 40px;
            }
            .mail-body{
                position:relative;
                font-family:Verdana, Geneva, Tahoma, sans-serif;
                font-size:16px;
                line-height:20px;
            }
            .mail-body a{
                text-decoration:none;
                color:black;
                font-weight:800;
                font-size:14px;
                line-height:17.5px;
            }
            </style>    
    </head>
    <body style="padding:20px;background-color:whitesmoke;">';
                $htmlContent .= '<section class="mail-body" style="background-color:whitesmoke;padding:20px;">
        <div class="section-title" style="background-color:whitesmoke;">
            Instituition\'s Innovation Council of MSIT
        </div>
        <div class="section-title-logo" style="display:flex;justify:space-around;">    
            <img src="https://iic.msit.in/backend/assets/img/logo.png" alt="IIC, MSIT">                                     
            <img src="https://iic.msit.in/backend/assets/img/logo_name.png" alt="Instituition\'s Innovation Council,MSIT">                                     
        </div>';
                $htmlContent .= '<div>
            Hi ' . $email . ',<br><br>

            Thanks for contacting Institution Innovation Council of MSIT.<br><br>
            
            We value your interactions very highly! <br>
            We will get back to you soon.! <br>

            Keep Innovating!!!<br>
            
            <br>
            Cheers,<br>
            IIC MSIT<br><br>

            Web: <a href="https://iic.msit.in" target="_blank">https://iic.msit.in</a><br>  
            Instagram: <a href="https://www.iic.msit.in/Instagram" target="_blank">https://www.iic.msit.in/Instagram</a><br>
            Facebook: <a href="https://www.iic.msit.in/Facebook" target="_blank">https://www.iic.msit.in/Facebook</a><br>
            LinkedIn: <a href="https://www.iic.msit.in/LinkedIn" target="_blank">https://www.iic.msit.in/LinkedIn </a><br>
                      
        </div>
    </section>';
                $htmlContent .= '</body>
    </html>';


                // Header for sender info 
                $headers = "From: $fromName" . " <" . $from . ">";

                // Boundary  
                $semi_rand = md5(time());
                $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

                // Headers for attachment  
                $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

                // Multipart boundary  
                $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";


                if (mail($to, $subject, $message, $headers)) {
                    echo "200";
                } else {
                    // Unable to Send Mail 
                    echo "500";
                }
            } else {
                // Unable to Insert Data to the Database
                echo "Something went Wrong! Please try again later";
            }
        }
    }
} else {
    include_once("../views/access_denied.php");
    exit();
}
