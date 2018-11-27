//== Class Definition
var SnippetLogin = function() {

    var login = $('#m_login');
    $.validator.addMethod("strong", function( value, element ) {
        return this.optional( element ) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test( value );
    });

    var showMsg = function(form, type, msg) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
        </div>');
        // Upper first letter.
        msg = msg.replace(/^\w/, c => c.toUpperCase());

        alert.prependTo(form);
        alert.animateClass('fadeIn animated');
        alert.find('span').html(msg);
        setTimeout(function () { 
            form.find('.alert').fadeOut('1000');
            // then(function (){
                form.find('.alert').remove();
            // });
        }, 3000);
    }

    //== Private Functions

    var displaySignUpForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');

        document.title = 'SecPass | Đăng ký';
        login.addClass('m-login--signup');
        login.find('.m-login__signup').animateClass('flipInX animated');
    }

    var displaySignInForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');

        document.title = 'SecPass | Đăng nhập';
        login.addClass('m-login--signin');
        login.find('.m-login__signin').animateClass('flipInX animated');
    }

    var displayForgetPasswordForm = function() {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');

        document.title = 'SecPass | Quên mật khẩu';
        login.addClass('m-login--forget-password');
        login.find('.m-login__forget-password').animateClass('flipInX animated');
    }
   
    var handleRememberMe = function() {
        $('#m_login_remember_me').click(function(e) {
            e.preventDefault();
            var form = login.find('.m-login__signin form');
            var alert = $('<div class="m-alert m-alert--outline alert alert-' + 'success' + ' alert-dismissible" role="alert">\
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
                <span></span>\
            </div>');
            form.find('.alert').remove();
            alert.prependTo(form);
            alert.animateClass('fadeIn animated');
            alert.find('span').html('Bạn không chỉ ngây thơ còn lười nữa. Hãy thức tỉnh đi!');
        });
    }

    var handleTerms = function() {
        $('#getTerms').click(function(e) {
            e.preventDefault();
            var form = login.find('.m-login__signup form');
            form.ajaxSubmit({
                url: 'legal/terms',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    console.log(response);
                    $('#terms').html(response);
                    $('#modalTerms').modal();
                },
                error: function(response, status, xhr, $form) {
                    // similate 1s delay
                    setTimeout(function() {
                        $('#modalTerms').modal('hide');
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

    var handleFormSwitch = function() {
        $('#m_login_forget_password').click(function(e) {
            e.preventDefault();
            displayForgetPasswordForm();
        });

        $('#m_login_forget_password_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });

        $('#m_login_signup').click(function(e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#m_login_signup_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });
    }

    var handleSignInFormSubmit = function() {
        $('#m_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            
            form.ajaxSubmit({
                url: '',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    if(response.message) {
                        setTimeout(function() {
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            showMsg(form, 'danger', response.message);
                        }, 1000);
                    }
                    else {
                        window.location = response.intended;
                    }
                },
                error: function(response, status, xhr, $form) {
                    // similate 1s delay
                    setTimeout(function() {
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

    var handleSignUpFormSubmit = function() {
        $('#m_login_signup_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        strong: true
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#register_password"
                    },
                    agree: {
                        required: true
                    }
                },
                messages: {
                    password_confirmation: {
                        equalTo: "Mật khẩu nhập lại không khớp."
                    },
                    agree: {
                        required: "Bạn cần đọc kỹ và chọn đồng ý Các thoả thuận và điều khoản để có thể sử dụng dịch vụ."
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            showMsg(form, '', 'Vui lòng chờ trong giây lát.');
           
            // Generate PGP key
            var options = {
                userIds: [{ name: form.find('input[name=name]').val() , 
                            email: form.find('input[name=email]').val() }], // multiple user IDs
                numBits: 2048,                                            // RSA key size
                passphrase: form.find('input[name=password]').val()         // protects the private key
            };
            console.log(options);

            openpgp.generateKey(options).then(function(key) {
                console.log(key)
                 // Set PGP to addon
                document.dispatchEvent(new CustomEvent('setUserPGPEvent', {detail: key}));

                form.ajaxSubmit({
                    url: 'register',                
                    type: 'POST',
                    success: function(response, status, xhr, $form) {
                        // similate 1s delay
                        setTimeout(function() {
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            form.clearForm();
                            form.validate().resetForm();

                            // display signin form
                            displaySignInForm();
                            var signInForm = login.find('.m-login__signin form');
                            signInForm.clearForm();
                            signInForm.validate().resetForm();

                            showMsg(signInForm, 'success', response.message);
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
                })
                .done(function(response){
                    let pgp_key = {
                        'user_id': response.user_id,
                        'key_created': key.keyPacket.created,
                        'fingerprint': key.keyPacket.fingerprint,
                        'key_id': key.keyPacket.keyid,
                        'uid': key.keyPacket.userid,
                        'armored_key': key.publicKeyArmored,
                        // 'revocationCertificate': key.revocationCertificate
                    };
                    console.log(pgp_key);
                    form.ajaxSubmit({
                        url: 'register/pgp',
                        type: 'POST',
                        data: pgp_key,
                        success: function(response, status, xhr, $form){
                            console.log(response);
                            showMsg(form, 'success', response.message);
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
            });
            
        });
    }

    var handleForgetPasswordFormSubmit = function() {
        $('#m_login_forget_password_submit').click(function(e) {
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
                url: '',
                success: function(response, status, xhr, $form) { 
                	// similate 2s delay
                	setTimeout(function() {
                		btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
	                    form.clearForm(); // clear form
	                    form.validate().resetForm(); // reset validation states

	                    // display signin form
	                    displaySignInForm();
	                    var signInForm = login.find('.m-login__signin form');
	                    signInForm.clearForm();
	                    signInForm.validate().resetForm();

	                    showMsg(signInForm, 'success', response.message);
                    }, 2000);
                },
                error: function(response, status, xhr, $form) {
                        $.each(response.responseJSON.errors, function(any, errors){
                            $.each(errors, function(idx) {
                                showMsg(form, 'danger', errors[idx]);
                            });
                        });
                }
            });
        });
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleRememberMe();
            handleTerms();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    SnippetLogin.init();
});