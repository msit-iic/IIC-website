$("form#subscribe-mails").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "control/actions.php?process=subscribe",
        type: 'POST',
        data: formData,
        success: function (result) {
            // alert(result);
            if (result == "200") {
                $("form#subscribe-mails .success").html("Added Successfully").show();
                $("form#subscribe-mails .error").hide();
                $("form#subscribe-mails .info").hide();
            } else if (result == "201") {
                $("form#subscribe-mails .success").hide();
                $("form#subscribe-mails .error").hide();
                $("form#subscribe-mails .info").html("You have already subscribed. Stay tuned for Updates").show();
            }else if (result == "500") {
                $("form#subscribe-mails .info").hide();
                $("form#subscribe-mails .success").hide();
                $("form#subscribe-mails .error").hide();
            }else {
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

