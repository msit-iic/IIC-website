<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tech Team IIC MSIT ">
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">
    <title>IIC Testing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <?php
    /*
    <link rel="stylesheet" href="assets/css/ui.css?v=<?php echo time(); ?>">
    */

    ?>

    <style type="text/css">
        section {
            padding: 100px;
        }

        .success,
        .info,
        .error {
            display: none;
        }
    </style>

</head>

<body>
    <section>

        <div class="container">
            <div class="row">
                <form id="subscribe-mails">
                    <div class="error alert-danger alert" role="alert"></div>
                    <div class="info alert-info alert" role="alert"></div>
                    <div class="success alert-success alert" role="alert"></div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Enter Email" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Subscribe to Emails</button>
                </form>
            </div>
        </div>
    </section>

    <?php
    /*
    <script src="assets/js/ui.js?v=<?php echo time(); ?>"></script>
*/ ?>

    <script>
        $("form#subscribe-mails").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "control/actions.php?process=subscribe",
                type: 'POST',
                data: formData,
                success: function(result) {
                    // alert(result);
                    if (result == "200") {
                        $("form#subscribe-mails .success").html("Added Successfully").show();
                        $("form#subscribe-mails .error").hide();
                        $("form#subscribe-mails .info").hide();
                    } else if (result == "500") {
                        $("form#subscribe-mails .success").hide();
                        $("form#subscribe-mails .error").hide();
                        $("form#subscribe-mails .info").html("Unable to Send Email").show();
                    } else {
                        $("form#subscribe-mails .info").hide();
                        $("form#subscribe-mails .success").hide();
                        $("form#subscribe-mails .error").html(result).show();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
</body>

</html>