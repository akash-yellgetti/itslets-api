function encodeString(str) {
    for (i = 0; i < 5; i++) {
        str = reverse(base64_encode(str));
    }
    return str;
}

function base64_encode(data) {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
	var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
	ac = 0,
	enc = "",
	tmp_arr = [];
	if (!data) {
		return data;
	}
	data = this.utf8_encode(data + '');
	do { // pack three octets into four hexets
	o1 = data.charCodeAt(i++);
	o2 = data.charCodeAt(i++);
	o3 = data.charCodeAt(i++);
	bits = o1 << 16 | o2 << 8 | o3;
	h1 = bits >> 18 & 0x3f;
	h2 = bits >> 12 & 0x3f;
	h3 = bits >> 6 & 0x3f;
	h4 = bits & 0x3f;
	// use hexets to index into b64, and append result to encoded string
	tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
	} while (i < data.length);

	enc = tmp_arr.join('');

	var r = data.length % 3;

	return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
}

function utf8_encode(argString) {
    if (argString === null || typeof argString === "undefined") {
        return "";
    }

    var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
    var utftext = "",

        start, end, stringl = 0;

            start, end, stringl = 0;


    start = end = 0;
    stringl = string.length;
    for (var n = 0; n < stringl; n++) {
        var c1 = string.charCodeAt(n);
        var enc = null;

        if (c1 < 128) {
            end++;
        } else if (c1 > 127 && c1 < 2048) {
            enc = String.fromCharCode((c1 >> 6) | 192) + String.fromCharCode((c1 & 63) | 128);
        } else {
            enc = String.fromCharCode((c1 >> 12) | 224) + String.fromCharCode(((c1 >> 6) & 63) | 128) + String.fromCharCode((c1 & 63) | 128);
        }
        if (enc !== null) {
            if (end > start) {
                utftext += string.slice(start, end);
            }
            utftext += enc;
            start = end = n + 1;
        }
    }

    if (end > start) {
        utftext += string.slice(start, stringl);
    }

    return utftext;
}

function reverse(s) {
    return s.split("").reverse().join("");
}

/*Form Function*/
function checkPhone(min, max, o, errdiv) {
    numRegexp = /^[0-9]+$/;
    if (o.val().length < min || o.val().length > max || !numRegexp.test(o.val()) || o.val().charAt(0) == '0') {
        o.attr('class', "input-error");
        $('#' + errdiv).fadeIn();
        return false;
    } else {
        return true;
    }
}

function checkMobile(min, max, o, errdiv) {
    numRegexp = /^[0-9]+$/;
    if (o.val().length < min || o.val().length > max || !numRegexp.test(o.val())) {
        o.attr('class', "input-error");
        $('#' + errdiv).fadeIn();
        return false;
    } else {
        return true;
    }
}

function checkLength(o, errdiv, max, min) {
    if (o.val().length > max || o.val().length < min) {
        o.attr('class', "input-error");
        $('#' + errdiv).fadeIn();
        return false;
    } else {
        return true;
    }
}

function checkSelect(o, errdiv) {
    if (o.val() == 0 || o.val() == -1) {
        o.attr('class', "input-error");
        $('#' + errdiv).fadeIn();
        return false;
    } else {
        return true;
    }
}

function checkForBlank(o, errdiv) {
    if (o.val().replace(/ /g, '').replace(/\n/g, '') == '') {
        o.attr('class', "input-error");
        $('#' + errdiv).fadeIn();
        return false;
    } else {
        return true;
    }
}

function checkRegexp(o, regType, errdiv) {
    switch (regType) {
        case 'email':

            {
                regexp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
                break;
            }
        case 'word':
            {
                regexp = /^[a-z]([0-9a-z_])+$/i;
                break;
            }
        case 'decimal':
            {
                regexp = /^[0-9]+(\.[0-9]+)?$/;
                //            regexp=/^(\-)?[0-9]+(\.[0-9]+)?$/;  for negative value requirement
                break;
            }
        case 'numeric':
            {
                regexp = /^[-]?[0-9]+$/;
                break;
            }
        case 'password':
            {
                regexp = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;
                break;
            }
        case 'username':
            {
                regexp = /^[a-zA-Z]([0-9a-zA-Z_])+$/;
                break;
            }
        case 'url':
            {
                regexp = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
                break;
            }
        default:
            {
                regexp = /^[a-z]([0-9a-z_])+$/;
            }
      

    }
    if (!(regexp.test(o.val()))) {
        o.attr('class', "input-error");
        $('#' + errdiv).fadeIn();
        return false;
    } else {
        return true;
    }
}


/*Alert Function*/
function showPageMsg(cssClassName, message) {
    $("#pagemsg").attr("class", cssClassName);
    $("#pagemsg").html(message);
    $("#pagemsg").fadeIn();
    setTimeout("hidePageMsg()", 2000);
}

function hidePageMsg() {
    $("#pagemsg").fadeOut("slow");
}


function openModal(header, msg, boxType, functionName) {
    var actionVal = "";
    if (functionName == "") {
        functionName = "closeModal()";
    }
    if (boxType == 1) {
        actionVal = actionVal + "<div class='modal-footer'><input type='button' name='BtnDialogOK' id='BtnDialogOK' class='btn btn-success' value='OK' onclick='" + functionName + "'></div>";
    } else if (boxType == 2) {

        actionVal = actionVal + "<div class='modal-footer'>" +
            "<input type='button' name='BtnDialogOK' id='BtnDialogOK' class='btn btn-success' value='OK' onclick='" + functionName + "'>" +
            "<input type='button' name='BtnDialogCancel' id='BtnDialogCancel' class='btn btn-danger' value='CANCEL' onclick='closeModal()'>" +
            "</div>";
    } else if (boxType == 3) {
        actionVal = actionVal + "<div class='modal-footer'>" +
            "<input type='button' name='BtnDialogYes' id='BtnDialogYes' class='btn btn-success' value='YES' onclick='" + functionName + "'>" +
            "<input type='button' name='BtnDialogNo' id='BtnDialogNo' class='btn btn-danger' value='NO' onclick='closeModal()'>" +
            "</div>";
    } else {
        actionVal = actionVal + "";
    }
    htmlval = "<div class='modal-dialog modal-md'>" +
        "<div class='modal-content'>" +
        "<div class='modal-header gen-modal-header'>" +
        " <h5 class='h4 modal-title gen-modal-title'>" + header + "</h5>" +
        "<button type='button' class='close' data-dismiss='modal' aria-hidden='true'><span aria-hidden='true'>&times;</span></button>" +
        "</div>" +
        "<div class='modal-body'>" +
        "<div class='row'>" +
        " <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 '>" +
        msg +
        "</div>" +
        "</div>" +
        "</div>" +
        actionVal +
        "</div>" +
        "</div>";      


    $("#general-modal").html(htmlval);
    $("#general-modal").modal();
}

function closeModal() {
    $("#general-modal").html("");
    $("#general-modal").modal("hide");
}

function getWindowWidth() {
    return Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
}

function getWindowHeight() {
    return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
}

function showLeftMenu() {
    if ($(".main-wrapper").hasClass("main-wrapper-menu")) {
        $(".main-wrapper").removeClass("main-wrapper-menu");
        $(".sidebar-container").hide();
        $(".sidebar-wrapper").animate({
            width: 0
        }, 300);

    } else {
        $(".main-wrapper").addClass("main-wrapper-menu");
        $(".sidebar-wrapper").animate({
            width: 220

        }, 300, function() {

        }, 300, function () {

            $(".sidebar-container").fadeIn(100);
        });
    }
}

//function to ge the file name in the text box
function getUploadFlName(obj) {
    filePath = $(obj).val();

    if (filePath != '') {
        fileName = filePath.substring(filePath.lastIndexOf("\\") + 1, filePath.length);
        $(obj).siblings(".custom-file-label").html(fileName);
    } else {
        $(obj).siblings(".custom-file-label").html("choose file");
    }
}

function showHideMenu() {
    if ($(".dvmenu").is(":visible")) {
        $(".dvmenu").animate({ right: '-260px' }, 500, function() {
            $(".dvmenu").fadeOut();
        });
    } else {
        $(".dvmenu").fadeIn();
        $(".dvmenu").animate({ right: '0px' }, 500);
    }
}

