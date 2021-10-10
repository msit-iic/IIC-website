/* -----------------------------------------------------------------------------------------------
Admin Profile Operations
------------------------------------------------------------------------------------------------*/
$("form#login-form").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "control/actions.php?process=login",
        type: 'POST',
        data: formData,
        success: function (result) {
            // alert(result);
            if (result == "200") {
                window.location.assign("dashboard");
            } else{
                $("#login-form .error").html(result).show();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});



// -------------------------- -=========== Username Verification ====================---------------------
$("form#username-verification").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "control/actions.php?process=verify-username",
        type: 'POST',
        data: formData,
        success: function(result) {
            // alert(result);
            if (result == "402") {
                // Username Not Verified
                $("form#username-verification .success").hide();
                $("form#verification-code").hide();
                $("form#update-password").hide();
                $("form#username-verification .warning").html("Username not found. Access Denied.").show();
            } else {
                $("form#username-verification .warning").hide();
                $("form#username-verification .success").html(result).show();
                $("form#verification-code").show();
                $("form#update-password").hide();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


// -------------------------- -=========== Code Verification ====================---------------------
$("form#verification-code").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "control/actions.php?process=verify-code",
        type: 'POST',
        data: formData,
        success: function(result) {
            // alert(result);
            if (result == "200") {
                $("form#verification-code .warning").hide();
                $("form#verification-code .success").html("Code Verification Successful. Enter new Password").show();
                $("form#update-password").show();
            } else {
                $("form#verification-code .success").hide();
                $("form#update-password").hide();
                $("form#verification-code .warning").html(result).show();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


// -------------------------- -=========== Update Password ====================---------------------
$("form#update-password").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "control/actions.php?process=update-password",
        type: 'POST',
        data: formData,
        success: function(result) {
            // alert(result);
            if (result == "200") {
                $("form#update-password .warning").hide();
                $("form#update-password .success").html("Password Updated. Now you can close this dialog and Login With New Credentials.").show();
            } else {
                $("form#update-password .success").hide();
                $("form#update-password .warning").html(result).show();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});