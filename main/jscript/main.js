function validateContact() {
    var errFlag = 0;
    var name = $("#TxtName");
    var email = $("#TxtEmail");
    var mobile = $("#TxtMobile");
    var msg = $("#TxtMessage");

    if (!checkForBlank(name, "err-name")) {
        name.addClass("input-contact");
        if (errFlag == 0) {
            name.focus();
        }
        errFlag = 1;
    } else {
        name.removeClass("input-error");
        $("#err-name").hide();
    }

    if (!checkRegexp(email, "email", "err-email")) {
        email.addClass("input-contact");
        if (errFlag == 0) {
            email.focus();
        }
        errFlag = 1;
    } else {
        email.removeClass("input-error");
        $("#err-email").hide();
    }

    if (mobile.val().replace(/ /g, '').replace(/\n/g, '') != '') {
        if (!checkLength(mobile, "err-mobile", 12, 8)) {
            mobile.addClass("input-contact");
            if (errFlag == 0) {
                mobile.focus();
            }
            errFlag = 1;
        } else {
            if (!checkRegexp(mobile, "numeric", "err-mobile")) {
                mobile.addClass("input-contact");
                if (errFlag == 0) {
                    mobile.focus();
                }
                errFlag = 1;
            } else {
                mobile.removeClass("input-error");
                $("#err-mobile").hide();
            }
        }
    }

    if (!checkForBlank(msg, "err-msg")) {
        msg.addClass("input-contact");
        if (errFlag == 0) {
            msg.focus();
        }
        errFlag = 1;
    } else {
        msg.removeClass("input-error");
        $("#err-msg").hide();
    }

    if (errFlag == 0) {
        $("#BtnContact").replaceWith("<img src='" + baseURL + "/images/loader.gif' class='submitloader' />");
        document.FrmContact.action = baseURL + "/main/send.contact.php";
        document.FrmContact.submit();
    }
}

//reset contact form
function resetContactForm() {
    $("#FrmContact input[type=text],textarea").each(function() {
        $(this).val("");
        $(".err-msg").fadeOut();
        $("input,textarea").removeClass("input-error");
    });
}