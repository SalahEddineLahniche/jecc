var Avgrund = (function(){

	var container = document.documentElement,
		popup = document.querySelector( '.avgrund-popup-animate' ),
		cover = document.querySelector( '.avgrund-cover' ),
		currentState = null;

	container.className = container.className.replace( /\s+$/gi, '' ) + ' avgrund-ready';

	// Deactivate on ESC
	function onDocumentKeyUp( event ) {
		if( event.keyCode === 27 ) {
			deactivate();
		}
	}

	// Deactivate on click outside
	function onDocumentClick( event ) {
		if( event.target === cover ) {
			deactivate();
		}
	}

	function activate( state ) {
		document.addEventListener( 'keyup', onDocumentKeyUp, false );
		document.addEventListener( 'click', onDocumentClick, false );
		document.addEventListener( 'touchstart', onDocumentClick, false );

		removeClass( popup, currentState );
		addClass( popup, 'no-transition' );
		addClass( popup, state );

		setTimeout( function() {
			removeClass( popup, 'no-transition' );
			addClass( container, 'avgrund-active' );
		}, 0 );

		currentState = state;
	}

	function deactivate() {
		document.removeEventListener( 'keyup', onDocumentKeyUp, false );
		document.removeEventListener( 'click', onDocumentClick, false );
		document.removeEventListener( 'touchstart', onDocumentClick, false );

		removeClass( container, 'avgrund-active' );
		removeClass( popup, 'avgrund-popup-animate')
	}

	
	function addClass( element, name ) {
		element.className = element.className.replace( /\s+$/gi, '' ) + ' ' + name;
	}

	function removeClass( element, name ) {
		element.className = element.className.replace( name, '' );
	}

	function show(selector){
		popup = document.querySelector( selector );
		addClass(popup, 'avgrund-popup-animate');
		activate();
		return this;
	}
	function hide() {
		deactivate();
	}

	return {
		activate: activate,
		deactivate: deactivate,
		show: show,
		hide: hide
	}

})();

function openDialog() {
    Avgrund.show( "#default-popup" );
}
function closeDialog() {
    Avgrund.hide();
}

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

    $('.activate').on('click', function () {
        var $user = $(this).parent();
        var user_id = $user.data('id');
        var activated = $user.data('activated');
        activated = activated ? 0 : 1;
        $.post('admin.php', {
            update: 'anything !',
            user_id: user_id,
            activated: activated
        }, function (data) {
            if (data == '1') {
                $button = $user.children('button');
                if (activated == 1) {
                    $button.removeClass('btn-success')
                    .addClass('btn-danger')
                    .html('Deactivate');
                    $user.data('activated', 1);
                } else {
                    $button.removeClass('btn-danger')
                    .addClass('btn-success')
                    .html('Activate Now');
                    $user.data('activated', 0);
                }
            } else {
                openDialog();
            }
        });
    });
});
