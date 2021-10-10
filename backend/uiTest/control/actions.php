<?php
if ($_GET["process"] == "subscribe") {

    $email = $_POST["email"];
    if ($email == "") {
        echo "No Email ID provided";
        exit();
    }
    $timezone = "Asia/Kolkata";
    $currentTime = new DateTime("now", new DateTimeZone($timezone));
    $dateTime = $currentTime->format('Y-m-d H:i:s');

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
                                            <img src="https://matrixinfotechsolution.com/uiTest/assets/img/logo.png" alt="IIC, MSIT">                                     
                                            <img src="https://matrixinfotechsolution.com/uiTest/assets/img/logo_name.png" alt="Instituition\'s Innovation Council,MSIT">                                     
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
                                            
                                            <a href="https://iic.msit.in" target="_blank">Web: https://iic.msit.in</a><br>  
                                            <a href="https://www.instagram.com/iic.msit">Instagram: https://www.instagram.com/iic.msit</a><br>
                                            <a href="https://facebook.com/iicmsit">Facebook: https://facebook.com/iicmsit</a><br>
                                            <a href="https://www.linkedin.com/company/iic-msit/">LinkedIn: https://www.linkedin.com/company/iic-msit/ </a><br>
                                            
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
}
