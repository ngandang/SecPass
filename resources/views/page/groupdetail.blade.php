@extends('layouts.master')

@section('content')

<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Nhóm
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="{{ $group->id }}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            {{$group->name}}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        @if($admin)
		<div class="">
            <a onclick="editGroup('{{$group->id}}','{{$group->name}}')" href="#editGroupForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <button class="btn btn-primary">Chỉnh sửa</button>
            </a>
        </div>
        &nbsp;&nbsp;
		<div class="">
            <a id="deleteGroup" href="#deleteGroupForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <button class="btn btn-danger">Xoá nhóm</button>
            </a>
        </div>              
        @endif
    </div>
</div>

<div class="m-content">    
    <input name="group_id" type="hidden" value="{{ $group->id }}">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#group-account" role="tab">
                            Tài khoản                            
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#group-note" role="tab">
                            Ghi chú bảo mật
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#group-user" role="tab">
                            Danh sách thành viên
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="tab-content">
            <div class="tab-pane active" id="group-account">
                <div class="header">
                    <button type="button" class="btn btn-primary" href="#addAccountForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                        Thêm tài khoản
                    </button>
                </div>
                <form class="m-form  m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="m-section">
                            @include('content.content-accounts')
                        </div>
                    </div>
                </form>                
            </div>
            <div class="tab-pane" id="group-note">
                <div class="header">
                    <a href="#addNoteForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                        <button class="btn btn-primary">Thêm ghi chú</button>
                    </a>
                </div>
                <form class="m-form m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="m-section">
                            @include('content.content-notes')
                        </div>
                    </div>
                </form>                
            </div>
            <div class="tab-pane" id="group-user">
                <div class="header">
                    <!--begin: Search Form -->
                    <div class="row align-items-right">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-12">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="Tìm kiếm nhanh..." id="userSearch">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="la la-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                    <!--end: Search Form -->  
                </div>
                <div class="m-form m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="m-section">
                            @include('content.content-group-user')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</div> 

@include('layouts.modals.account')
@include('layouts.modals.note')
@include('layouts.modals.groupuser')

@endsection

@section('pageSnippets')
<!-- BEGIN: Account scripts -->
<script>

    function generate() {
        $('#addAccountForm input[name=password]').val(randomPassword());
    }
    function generateEdit(){
        $('#editAccountForm input[name=password]').val(randomPassword());
    }

    $(document).ready(function(){

        $(document).on('click', '.portlet-account', function (e) {
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
</script>
<!-- END: Account scripts -->
 <!-- BEGIN: Note scripts -->
<script>

    $(document).ready(function(){

        $(document).on('click', '.portlet-note', function () {
            // Ignore this event if head-tools has been clicked.
            if($('.m-portlet__head-tools').data('clicked'))
                return;

            var showEditForm = $(this).find(".note-edit");
            if(showEditForm[0])
                showEditForm[0].click();
            else
                showEditForm.click();
        });

        $(document).on('click', '.note-copy-content', function (e) {
            var data = {
                'id': $(this).closest('.m-portlet').find('input[name=id]').val(),
            };
            console.log(data.id);
            $.ajax({
                url: 'securenote/getContent',
                type: 'POST',
                data: data,
                success: function(response, status, xhr, $form) {
                    cipherToDecrypt = response.content;

                    decryptFunction(function (result) {
                        // Không copy nhanh được nên phải dùng như bên dưới
                        swal({
                            title: "Giải mã nội dung thành công",
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

        
        $(document).on('click', '.note-edit', function (){
            var data = {
                'id': $(this).closest(".m-portlet").find("input[name=id]").val(),
            };
            $.ajax({
                url: 'securenote/detail',
                type: 'POST',
                data: data,
                success: function(response, status, xhr, $form) {
                    $('#editNoteForm input[name=id]').val(response.id);
                    $('#editNoteForm input[name=title]').val(response.title);
                    $('#editNoteForm .last_updated').text(response.updated_at);
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.responseJSON.message, "error");
                }
            });
        });

        $(document).on('click', '.note-share', function (e) {
            var id = $(this).closest(".m-portlet").find("input[name=id]").val();
            $('#shareNoteForm input[name=id]').val(id);
        });

        $(document).on('click', ".note-delete", function(){
            var id = $(this).closest(".m-portlet").find("input[name=id]").val();
            $('#deleteNoteForm input[name=id]').val(id);
        })

        $('#getContent').click(function () {
            var data = {
                'id': $('#editNoteForm input[name=id]').val(),
            };
            $.ajax({
                url: 'securenote/getContent',
                type: 'POST',
                data: data,
                success: function(response, status, xhr, $form) {
                    cipherToDecrypt = response.content;

                    decryptFunction(function (result) {
                        $('#editNoteForm textarea[name=note_content]').val(result);
                        $('#editNoteForm textarea[name=note_content]').prop('rows','10');
                    });
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.responseJSON.message, "error");
                }
            });
        });

        $('#addNoteSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            btn.addClass('m-loader m-loader--right m-loader--light');
            btn.attr('disabled', true);

            // Encrypt note content with OpenPGPjs
            form.find('textarea[name=note_content]').prop('disabled', true);

            messageToEncrypt = form.find("textarea[name=note_content]").val();

            encryptFunction(pubkey, function (result) {
                if(result) {
                    var $temp = $("<textarea name='cipher'>");
                    form.append($temp);      
                    form.append('</textarea>');
                    $temp.val(result);
                }
                form.ajaxSubmit({
                    url: 'securenote/add',
                    type: 'POST',
                    success: function(response, status, xhr, $form) {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                        swal({
                            position: 'center',
                            type: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function(result){$('#addNoteForm').modal('hide');});

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
                form.find('textarea[name=note_content]').prop('disabled', false);
            }, function (error) {
                btn.attr('disabled', false);
                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                form.find('textarea[name=note_content]').prop('disabled', false);
            });
        });

        $('#editNoteSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
             
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            btn.attr('disabled', true);

            // Encrypt note content with OpenPGPjs
            form.find('textarea[name=note_content]').prop('disabled', true);

            messageToEncrypt = form.find("textarea[name=note_content]").val();
            encryptFunction(pubkey, function (result) {
                if(result) {
                    var $temp = $("<textarea name='cipher'>");
                    form.append($temp);      
                    form.append('</textarea>');
                    $temp.val(result);
                }
                form.ajaxSubmit({
                    url: 'securenote/edit',
                    type: 'POST',
                    success: function(response, status, xhr, $form) {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                        swal({
                            position: 'center',
                            type: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function(result){$('#editNoteForm').modal('hide');});

                        $('.m-section').html(response.view);
                        form.clearForm();
                        form.validate().resetForm();
                    },
                    error: function(response, status, xhr, $form) {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                        swal("", response.responseJSON.message, "error");
                        console.log(response.responseJSON.message);
                    }
                });
                if($temp)
                    $temp.remove();
                form.find('textarea[name=note_content]').prop('disabled', false);
            }, function (error) {
                btn.attr('disabled', false);
                btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                form.find('textarea[name=note_content]').prop('disabled', false);
            });
        });

        $('#deleteNoteSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            form.ajaxSubmit({
                url: 'securenote/delete',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#deleteNoteForm').modal('hide');});

                    $('.m-section').html(response.view);
                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    swal("", response.responseJSON.message, "error");
                }
            });
        });

        $('#shareNoteSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: 'securenote/share',
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
                                    url: 'securenote/share/finalize',
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
                                        }).then(function(result){$('#shareNoteForm').modal('hide');});

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
                                form.find('textarea[name=note_content]').prop('disabled', false);
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
                        }).then(function(result){$('#shareNoteForm').modal('hide');});

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
<!-- END Note scripts -->

<script>
    
    document.dispatchEvent(new CustomEvent('letgetGroupPGPEvent', { detail: $("input[name=group_id").val() }));

    function editGroup(id, name)
    {
        $('#editGroupForm input[name=id]').val(id);
        $('#editGroupForm input[name=name]').val(name);
    }
    function del(id, idGroup)
    {
        $('#deleteUserForm input[name=user_id]').val(id);
        $('#deleteUserForm input[name=group_id]').val(idGroup);
    }
    

    $(document).ready(function(){

        var users_datatable_options = {
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#userSearch'),
            },
            columns: [
                {
                field: 'Tên người dùng',
                type: 'text',
                textAlign: 'center',
                sortable: 'asc',
                width: 150,
                },
                {
                field: 'Email',
                type: 'text',
                textAlign: 'center',
                width: 200,
                },
                {
                field: 'Vai trò',
                type: 'text',
                textAlign: 'center',
                width: 150,
                },
                {
                field: 'Ngày tham gia',
                textAlign: 'center',
                width: 200,
                },
                {
                field: '',
                textAlign: 'center',
                },
            ],
            pagination: false,
        };

        users_datatable = $('.m-datatable').mDatatable(users_datatable_options);


        var group_id = $("input[name=group_id]").val();
        $("form").append('<input name="group_id" type="hidden" value="'+ group_id +'" />');        

        $('#editGroupForm input[name=email]').keypress(function(e) {            
            if(e.which == 13){
                e.preventDefault();
                $("#addUser").click();
            }
        });

        $('#addUser').click(function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            form.find("input[name=email]").css('border-color','');
            email =  {
                'email' : $('#editGroupForm input[name=email]').val()
            };
            $.ajax({
                url: '/group/checkUser',
                type: 'POST',
                data: email,
                success: function(response, status, xhr, $form) {
                    var email = form.find("input[name=email]").val();
                   
                    var list = $('#users');
                    var entry = $('<li>');
                    var span = $('<span>');
                    span.text(email);
                    var button = $('<a href="javascript:;" class="m-link del-email">&nbsp;&nbsp;Xoá</a>');

                    list.append(entry);
                    entry.append(span);
                    entry.append(button);
                    
                    console.log(response.message);
                    $('#editGroupForm input[name=email]').val("");
                },
                error: function(response, status, xhr, $form) {
                    // btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal(response.responseJSON.message, "", status);
                    console.log(response);
                }
            });
        });

        $(document).on("click",'.del-email', function() {
            $(this).closest('li').remove();
        });

        $('#editGroupSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            if (!form.valid()) {
                return;
            }
            
            myArray = new Array();
            cnt = 0;
            $("#users li span").each(function(){
                myArray[cnt] = $(this).text();
            cnt++;
            });
            var jsonString = JSON.stringify(myArray);

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/group/editGroup',
                type: 'POST',
                data: {li_variable: jsonString},
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#editGroupForm').modal('hide');});

                    $('#group-user .m-section').html(response.view);
                    users_datatable = $('.m-datatable').mDatatable(users_datatable_options);

                    $("#users li").remove();
                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    swal("", response.responseJSON.message, "error");
                    console.log(response.mesage);
                }
            })
        });
        
        $('#deleteGroup').click(function (){
            $("#deleteGroupForm input[name=id]").val($("input[name=group_id]").val());
        });
        
        $('#deleteGroupSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/group/delete',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    // Xoá group PGP trong addon
                    var group_id = $("#deleteGroupForm input[name=id]").val();
                    document.dispatchEvent(new CustomEvent('removeGroupPGPEvent', {detail: group_id}));

                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#deleteGroupForm').modal('hide');});

                    window.location = "/groups";
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("", response.responseJSON.message, "error");
                    console.log(response);
                }
            });
        });
        
        $('#deleteUserSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/group/deleteUser',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#deleteUserForm').modal('hide');});

                    $('#group-user .m-section').html(response.view);
                    users_datatable = $('.m-datatable').mDatatable(users_datatable_options);

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
        
        $(document).on("change", ".select-role", function (e){
            e.preventDefault();
            var tr = $(this).closest('tr');
            tr.addClass('selected');
            $('#roleForm input[name=idUser]').val(tr.find("input[name=user_id]").val());
            $('#roleForm input[name=idGroup]').val($('input[name=group_id]').val());
            var role = $(this).val();
            $('.role-user').html(role);
            $('#roleForm').modal('show');
        })

        $("#roleForm").on("hidden.bs.modal", function (e) {
            e.preventDefault();
            var tr = $("tr.selected");
            var is_admin = tr.find("input[name=is_admin]").val();
            if(is_admin==1){
                tr.find('.select-role').val("Quản trị viên");
            }
            else {
                tr.find('.select-role').val("Thành viên");
            }
            tr.removeClass("selected");

        });

        $('#roleSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            var user_role = form.find(".role-user").text();
            var role = 1;
            if(user_role == "Thành viên")
                role = 0;
            data = {
                'role': role,
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/group/changeRole',
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
                    }).then(function(result){$('#roleForm').modal('hide');});

                    $('#group-user .m-section').html(response.view);
                    users_datatable = $('.m-datatable').mDatatable(users_datatable_options);
                    
                    form.clearForm();
	                // form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("", response.responseJSON.message, "error");
                    console.log(response);
                }
            });
        });
    });
</script>
@endSection