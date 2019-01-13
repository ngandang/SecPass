
function generate() {
    $('#addAccountForm input[name=password]').val(randomPassword());
}
function generateEdit(){
    $('#editAccountForm input[name=password]').val(randomPassword());
}

$(document).ready(function(){

    $(document).on('click', '.portlet-account', function (e) {
        // Ignore this event if head-tools has been clicked.
        if($(this).find('.m-portlet__head-tools').data('clicked'))
            return;

        var showEditForm = $(this).find(".account-edit");
        if(showEditForm[0])
            showEditForm[0].click();
        else
            showEditForm.click();
        
    });

    $('.toggle-password').click(function() {
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
            $(this).removeClass("fa-eye-slash");
        } else {
            $(this).addClass("fa-eye-slash");
            input.attr("type", "password");
        }
    });

    $(document).on('click', '.account-username', function (e) {
        copy($(this).text());
        swal({
            position: 'center',
            type: 'success',
            title: 'Đã sao chép tên đăng nhập',
            showConfirmButton: false,
            timer: 1500
        });
        e.stopPropagation();
        
    });
        
    $(document).on('click', '.account-copy-username', function (e) {            
        copy($(this).closest('.m-portlet').find('.account-username').text());
        swal({
            position: 'center',
            type: 'success',
            title: 'Đã sao chép tên đăng nhập',
            showConfirmButton: false,
            timer: 1500
        });
    });
    
    $(document).on('click', '.account-copy-content', function (e) {
        var data = {
            'id': $(this).closest('.m-portlet').find('input[name=id]').val(),
        };
        console.log(data.id);
        $.ajax({
            url: 'account/getContent',
            type: 'POST',
            data: data,
            success: function(response, status, xhr, $form) {
                cipherToDecrypt = response.content;

                decryptFunction(function (result) {
                    // Không copy nhanh được nên phải dùng như bên dưới
                    swal({
                        title: "Giải mã mật khẩu thành công",
                        type: 'success',
                        confirmButtonText: 'Sao chép',
                        onClose: (input) => {
                            copy(result);
                        }
                    });                            
                });
            },
            error: function(response, status, xhr, $form) {
                console.log(response);
                swal("", response.responseJSON.message, "error");
            }
        });
        e.stopPropagation();
    });

    $(document).on('click', '.account-edit', function (){
        var data = {
            'id': $(this).closest(".m-portlet").find("input[name=id]").val(),
        };
        $.ajax({
            url: 'account/detail',
            type: 'POST',
            data: data,
            success: function(response, status, xhr, $form) {
                $('#editAccountForm input[name=id]').val(response.id);
                $('#editAccountForm input[name=name]').val(response.name);
                $('#editAccountForm input[name=username]').val(response.username);
                $('#editAccountForm input[name=url]').val(response.uri);
                $('#editAccountForm textarea[name=description]').val(response.description);
                $('#editAccountForm .last_updated').text(response.updated_at);
                $('#editAccountForm .toggle-password').addClass('fa-eye-slash');
                $('#editAccountForm input[name=password]').attr('type', 'password');
                $('#getPassword i').removeClass('fa-unlock');
                $('#getPassword i').addClass('fa-lock');
            },
            error: function(response, status, xhr, $form) {
                console.log(response);
                swal("", response.responseJSON.message, "error");
            }
        });
    });

    $(document).on('click', '.account-share', function (e) {
        var id = $(this).closest(".m-portlet").find("input[name=id]").val();
        $('#shareAccountForm input[name=id]').val(id);
    });

    $(document).on('click', ".account-delete", function(){
        var id = $(this).closest(".m-portlet").find("input[name=id]").val();
        $('#deleteAccountForm input[name=id]').val(id);
    })

    $('#getPassword').click(function () {
        var data = {
            'id': $('#editAccountForm input[name=id]').val(),
        };
        $.ajax({
            url: 'account/getContent',
            type: 'POST',
            data: data,
            success: function(response, status, xhr, $form) {
                cipherToDecrypt = response.content;

                decryptFunction(function (result) {
                    console.log(result);      
                    $('#editAccountForm input[name=password]').val(result);
                    $('#getPassword i').removeClass('fa-lock');
                    $('#getPassword i').addClass('fa-unlock');
                });
            },
            error: function(response, status, xhr, $form) {
                console.log(response);
                swal("", response.responseJSON.message, "error");
            }
        });
    });

    $('#addAccountSubmit').click(function(e){
        e.preventDefault();
        var btn = $(this);
        var form = $(this).closest('form');

        form.validate({
            rules: {
                url: {
                    url: true
                }
            }
        });

        if (!form.valid()) {
            return;
        }

        btn.addClass('m-loader m-loader--right m-loader--light');
        btn.attr('disabled', true);

        // Encrypt password with OpenPGPjs
        form.find('input[name=password]').prop('disabled', true);

        messageToEncrypt = form.find("input[name=password]").val();
        encryptFunction(pubkey, function (result) {
            if(result) {
                var $temp = $("<textarea name='cipher'>");
                form.append($temp);      
                form.append('</textarea>');
                $temp.val(result);
            }
            form.ajaxSubmit({
                url: 'account/add',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#addAccountForm').modal('hide');});

                    $('.m-section').html(response.view);                        
                    form.clearForm();
                    form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    console.log(response);
                    swal("", response.responseJSON.message, "error");
                }
            });
            if($temp)
                $temp.remove();
            form.find('input[name=password]').prop('disabled', false);
        }, function (error) {
            btn.attr('disabled', false);
            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            form.find('input[name=password]').prop('disabled', false);
        });        
    });

    $('#editAccountSubmit').click(function(e){
        e.preventDefault();
        var btn = $(this);
        var form = $(this).closest('form');

        form.validate({
            rules: {
                url: {
                    url: true
                }
            }
        });

        if (!form.valid()) {
            return;
        }

        btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
        btn.attr('disabled', true);

        // Encrypt password with OpenPGPjs
        form.find('input[name=password]').prop('disabled', true);

        messageToEncrypt = form.find("input[name=password]").val();
        encryptFunction(pubkey, function (result) {
            if(result) {
                var $temp = $("<textarea name='cipher'>");
                form.append($temp);      
                form.append('</textarea>');
                $temp.val(result);
            }
            form.ajaxSubmit({
                url: 'account/edit',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#editAccountForm').modal('hide');});

                    $('.m-section').html(response.view);
                    form.clearForm();
                    form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("", response.responseJSON.message, "error");
                    console.log(response);
                }
            });
            if($temp)
                $temp.remove();
            form.find('input[name=password]').prop('disabled', false);
        }, function (error) {
            btn.attr('disabled', false);
            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            form.find('input[name=password]').prop('disabled', false);
        });
    });

    $('#deleteAccountSubmit').click(function(e){
        e.preventDefault();
        var btn = $(this);
        var form = $(this).closest('form');
        
        btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

        form.ajaxSubmit({
            url: 'account/delete',
            type: 'POST',
            success: function(response, status, xhr, $form) {
                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                swal({
                    position: 'center',
                    type: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(function(result){$('#deleteAccountForm').modal('hide');});

                $('.m-section').html(response.view);
                form.clearForm();
                form.validate().resetForm();
            },
            error: function(response, status, xhr, $form) {
                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                swal("", response.responseJSON.message, "error");
                console.log(response);
            }
        });
    });
    
    $('#shareAccountSubmit').click(function(e){
        e.preventDefault();
        var btn = $(this);
        var form = $(this).closest('form');
        
        btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

        form.ajaxSubmit({
            url: 'account/share',
            type: 'POST',
            success: function(response, status, xhr, $form) {
                if (response.sharedkey && response.content) {
                    console.info(response.message);
                    
                    cipherToDecrypt = response.content;
                    decryptFunction(function (result) {
                        messageToEncrypt = result;
                        const sharedkey = response.sharedkey;
                        encryptFunction(sharedkey, function (result){
                            data =  {
                                'id': response.id,
                                'content': result,
                            };
                            $.ajax({
                                url: 'account/share/finalize',
                                type: 'POST',
                                data: data,
                                success: function(response, status, xhr, $form) {
                                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                                    swal({
                                        position: 'center',
                                        type: 'success',
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function(result){$('#shareAccountForm').modal('hide');});

                                    form.clearForm();
                                    form.validate().resetForm();
                                },
                                error: function(response, status, xhr, $form) {
                                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                                    swal("", response.responseJSON.message, "error");
                                    console.log(response);
                                }
                            });
                        }, function (error) {
                            btn.attr('disabled', false);
                            btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                            form.find('input[name=password]').prop('disabled', false);
                        });

                    });                     
                }
                else {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#shareAccountForm').modal('hide');});

                    form.clearForm();
                    form.validate().resetForm();
                }
            },
            error: function(response, status, xhr, $form) {
                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                swal(response.responseJSON.message, response.responseJSON.detail, status);
                console.log(response);
            }
        });
    });
});