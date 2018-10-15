//== Class Definition
var SnippetLogin = function() {

    var login = $('#m_login');

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
            form.find('.alert').fadeOut('1000').then(function (){
                form.find('.alert').remove();
            });
        }, 3000);
    }

    //== Private Functions

    var displaySignUpForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');

        login.addClass('m-login--signup');
        login.find('.m-login__signup').animateClass('flipInX animated');
    }

    var displaySignInForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');

        login.addClass('m-login--signin');
        login.find('.m-login__signin').animateClass('flipInX animated');
    }

    var displayForgetPasswordForm = function() {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');

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
                },
                messages: {
                    email: {
                        required: "Trường nhập bắt buộc.",
                        email: "Vui lòng nhập với định dạng email hợp lệ."
                    },
                    password: {
                        required: "Trường nhập bắt buộc."
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
                    window.location = response.intended;
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
                        required: true
                    },
                    rpassword: {
                        required: true
                    },
                    agree: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Trường nhập bắt buộc."
                    },
                    email: {
                        required: "Trường nhập bắt buộc.",
                        email: "Vui lòng nhập với định dạng email hợp lệ."
                    },
                    password: {
                        required: "Trường nhập bắt buộc."
                    },
                    rpassword: {
                        required: "Trường nhập bắt buộc."
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

            form.ajaxSubmit({
                url: '/register',                
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
                },
                messages: {
                    email: {
                        required: "Trường nhập bắt buộc.",
                        email: "Vui lòng nhập với định dạng email hợp lệ."
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