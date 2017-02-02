$('textarea[max-length]').on('keypress paste input blur', function() {
    // Store the maxlength and value of the field.
    var maxlength = $(this).attr('max-length');
    var val = $(this).val();
    counter = $(".new-post span")

    counter.html(maxlength - val.length)
    // Trim the field if it has content over the maxlength.
    if (val.length > maxlength) {
    	counter.css("color", "red")
    }
    else
    {
    	counter.css("color", "#000")
    }
});

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validate() {
    r = true;
    var emailInput = $("#email");
    var emailInputP = emailInput.parent().parent().parent();
    emailInputP.removeClass("has-error");
    var email = emailInput.val();
    if (!validateEmail(email)) {
        emailInputP.addClass("has-error");
        r = false;
    }
    var confirm_pass = $("#confirm");
    var password = $("#password");
    var confirm_passP = confirm_pass.parent().parent().parent();
    confirm_passP.removeClass("has-error");
    var pass = password.val();
    var confirm = confirm_pass.val();
    if (pass != confirm) {
        confirm_passP.addClass("has-error");
        r = false;
    }
    var name = $("#name");
    var nameP = name.parent().parent().parent();
    nameP.removeClass("has-error");
    var name_str = name.val();
    if (name_str == "") {
        nameP.addClass("has-error");
        r = false;
    }
    var role = $("#role");
    var roleP = role.parent().parent().parent();
    roleP.removeClass("has-error");
    var role_str = role.val();
    if (role_str == "") {
        roleP.addClass("has-error");
        r = false;
    }
    var pass = $("#password");
    var passP = pass.parent().parent().parent();
    passP.removeClass("has-error");
    var pass_str = pass.val();
    if (pass_str == "") {
        passP.addClass("has-error");
        r = false;
    }

    return r;    
}

$("form#register").bind("submit", validate);