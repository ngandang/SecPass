@extends('layouts.master')

@section('content')
<div class="m-subheader">
    <div class="d-flex align-items-center"> 
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Kho lưu trữ
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="javascript:;" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Tài khoản
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="btn-add-account">
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addAccountForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <span>
                    <i class="la la-plus"></i>
                    <span>
                        Thêm tài khoản
                    </span>
                </span>
            </a>
        </div>
    </div>
</div>
<!-- BEGIN: Datatable -->
<div class = "m-content">
    @include('content.content-accounts')
</div>
<!-- END: Datatable -->

@include('layouts.modals.account')

@endsection

@section('pageSnippets')
<!-- BEGIN: Page Scripts -->

<script>

    function generate() {
        $('#addAccountForm input[name=password]').val(randomPassword());
    }
    function generateEdit(){
        $('#editAccountForm input[name=password]').val(randomPassword());
    }

    $(document).ready(function(){

        $('.portlet-account').on('click', function (e) {
            // Ignore this event if head-tools has been clicked.
            if($('.m-portlet__head-tools').data('clicked'))
                return;

            var showEditForm = $(this).find(".account-edit");
            if(showEditForm[0])
                showEditForm[0].click();
            else
                showEditForm.click();
           
        });

        $('.toggle-password').click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $('.toggle-edit').click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        $('.account-username').click(function (e) {
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
            
        $('.account-copy-username').click(function (e) {            
            copy($(this).closest('.m-portlet').find('.account-username').text());
            swal({
                position: 'center',
                type: 'success',
                title: 'Đã sao chép tên đăng nhập',
                showConfirmButton: false,
                timer: 1500
            });
        });
        
        $('.account-copy-content').click(function (e) {
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

        $('.account-edit').click(function (){
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
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.responseJSON.message, "error");
                }
            });
        });

        $('.account-share').click(function (e) {
            var id = $(this).closest(".m-portlet").find("input[name=id]").val();
            $('#shareAccountForm input[name=id]').val(id);
        });

        $(".account-delete").click(function(){
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

                        $('.m-content').html(response.view);                        
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

                        $('.m-content').html(response.view);
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

                    $('.m-content').html(response.view);
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
</script>

<!-- END: Page Scripts -->
@endsection
