//== Class Definition
var SnippetVerify = function() {

    //var verify = $('#m_login'); //Dùng luôn css của login

    var showMsg = function(form, type, msg) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<span></span>\
        </div>');
        // Upper first letter.
        msg = msg.replace(/^\w/, c => c.toUpperCase());

        form.find('.alert').remove();
        alert.prependTo(form);
        alert.animateClass('fadeIn animated');
        alert.find('span').html(msg);
    }

    //== Private Functions
    var handleSignInButton = function () {
        $('#m_login_redirect_submit').click(function(e) {
            e.preventDefault();
            window.location='/login';
        });
    }

    var handleSignInRedirect = function () {
        if ($('#m_login_redirect_submit').length != 0) {
            setTimeout(function () { 
                window.location='/login';
            }, 5000);
        }
    }

    var handleVerifyResendFormSubmit = function() {
        $('#m_verify_resend_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/register/verify',                
                type: 'POST',
                success: function(response, status, xhr, $form) {
                	// similate 1s delay
                	setTimeout(function() {
	                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
	                    form.clearForm();
                        form.validate().resetForm();

	                    showMsg(form, response.status, response.message);
                    }, 1000);
                },
                error: function(response, status, xhr, $form) {
                    // similate 1s delay
                    setTimeout(function() {
                        console.log(response);
	                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                        $.each(response.responseJSON.errors, function(any, errors){
                            $.each(errors, function(idx) {
                                showMsg(form, 'danger', errors[idx]);
                            });
                        });
                    }, 1000);
                }
            });
        });
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleVerifyResendFormSubmit();
            handleSignInButton();
            handleSignInRedirect();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    SnippetVerify.init();
});