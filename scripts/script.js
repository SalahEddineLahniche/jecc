$(document).ready(function () {
    $('textarea[max-length]').on('change keypress paste input blur', function() {
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


    var monthNames = [
    "January", "February", "March",
    "April", "May", "June", "July",
    "August", "September", "October",
    "November", "December"
    ];


    $('.new-post .btn').on('click', function () {
        var msg = $('textarea[max-length]');
        var usr = $(".navbar-right .navbar-link");
        msg.prop('disabled', true);
        var user_id = usr.data('id');
        var role = usr.data('role')
        var departement_id = ($('#navbar .nav').data('active'));
        var ptext = msg.val()
        var date = new Date();
        var day = date.getDate();
        var month = monthNames[date.getMonth()];
        var year = date.getFullYear();
        var pdate = day + ' ' + month + ' ' + year;
        var $input = $('.new-post input');
        var plink = $input.hasClass('hidden') ? "" : $input.val()
        $.post('post.php', {
            pnew: "anything !",
            user_id: user_id,
            departement_id: departement_id,
            ptext: ptext,
            plink: plink,
            pdate: pdate
        })
        .done(function () {
            msg.prop('disabled', false);
            msg.val("");
            var html = 
            '<div class="post"> \
				<div class="name"> \
					<span class="role">' + role + ':</span> \
					<span class="full-name">' + usr.html() + '</span> \
					<span class="date">' + pdate + '</span> \
				</div> \
				<div class="content">' + ptext + '</div> \
				' + (plink ? 
                '<div class="attachment"> \
					<div class="link-image glyphicon glyphicon-link"></div> \
					<div class="link-content"><a href="' + plink + '">' + plink + '</a></div> \
                </div>' : "") + '\
			</div>';
            $(".posts").append(html);
            msg.trigger('change');
            if (plink)
                $input.addClass('hidden');
                $input.val('http://');
                $input.next().html('Add link')
        });
    });

    $('.new-post a').on('click', function (e, sender) {
        var $input = $('.new-post input');
        if ($(this).html() == "Add link") {
            $(this).html('Remove link');
            $input.removeClass('hidden')
            .focus()
            [0].setSelectionRange($input.val().length, $input.val().length);
        } else {
            $input.addClass('hidden');
            $input.val('http://');
            $(this).html('Add link')
        }
    });

    $('#loadmore').on('click', function () {
        $posts = $('.posts');
        var current = parseInt($posts.data('current'));
        var count = parseInt($posts.data('count'));
        var departement_id = ($('#navbar .nav').data('active'));
        if (current > count) {
            $(this).addClass('hidden');
            return;
        }
        var length = 15;
        $.post('post.php', {
            get: 'anything !',
            departement_id: departement_id,
            current: current,
            length: length
        }, function (data) {
            $.each(data, function(index, post) {
                var html = 
                '<div class="post"> \
                    <div class="name"> \
                        <span class="role">' + post.urole + ':</span> \
                        <span class="full-name">' + post.uname + '</span> \
                        <span class="date">' + post.pdate + '</span> \
                    </div> \
                    <div class="content">' + post.ptext + '</div> \
                    ' + (post.plink ? 
                    '<div class="attachment"> \
                        <div class="link-image glyphicon glyphicon-link"></div> \
                        <div class="link-content"><a href="' + post.plink + '">' + post.plink + '</a></div> \
                    </div>' : "") + '\
                </div>';
                $(".posts").append(html);
                $posts.data('current', current + 15);
                current += 15;
                console.log(current);
                console.log(count);
                if (current > count) {
                    $('#loadmore').addClass('hidden');
                    return;
                }
                
            });
        }, "json");
    }); 
});
