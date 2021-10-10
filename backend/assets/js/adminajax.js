
// -------------------------- -=========== Adding Admin Profiles ====================---------------------
$("form#add-new-profile-form").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "control/actions.php?process=add-new-admin",
        type: 'POST',
        data: formData,
        success: function (result) {
            // alert(result);
            if (result == "200") {
                window.location.reload();
            } else  {
                $("#add-new-profile-form .error").html(result).show();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


// ------------------------======================= Updating Admin Profile =================================-----------------------
$(".update-admin-profile-submit").on("click", function (e) {
    e.preventDefault();
    $formid = this.parentNode.parentNode.id;
    // alert($formid);
    var formdata = document.getElementById($formid);
    var formData = new FormData(formdata);
    $.ajax({
        url: "control/actions.php?process=update-admin-profile",
        type: 'POST',
        data: formData,
        success: function (result) {
            // alert(result);
            if (result == "200") {
                window.location.reload();
            } else {
                $("#" + $formid + " .error").html(result).show();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});



// ------------================================= Deleting Admin Profile =======================================------------------
$(".delete-admin-profile-btn").on("click", function (e) {
    e.preventDefault();
    $formid = this.parentNode.parentNode.id;
    // alert($formid);
    var formdata = document.getElementById($formid);
    var formData = new FormData(formdata);
    $.ajax({
        url: "control/actions.php?process=delete-admin-profile",
        type: 'POST',
        data: formData,
        success: function (result) {
            // alert(result);
            if (result == "200") {
                window.location.reload();
            } else {
                $("#" + $formid + " .error").html(result).show();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});



// -------------------------- -=========== Username Verification ====================---------------------
$("form#reset-password").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "control/actions.php?process=verify-username",
        type: 'POST',
        data: formData,
        success: function(result) {
            // alert(result);
            if (result == "402") {
                $("form#verification-code").hide();
                $("form#update-password").hide();
                $("form#reset-password .warning").html("Username not found. Access Denied.").show();
            } else {
                $("form#reset-password .warning").html(result).show();
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