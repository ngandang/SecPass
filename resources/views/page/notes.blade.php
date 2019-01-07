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
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Ghi chú bảo mật
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="btn-add-note">
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addNoteForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <span>
                    <i class="la la-plus"></i>
                    <span>
                        Thêm ghi chú
                    </span>
                </span>
            </a>
        </div>
    </div>
</div>
 
<!-- BEGIN: Content -->
<div class="m-content">
    <div class="m-section">
    @include('content.content-notes')
    </div>
</div>
<!-- END: Content -->

@include('layouts.modals.note')

@endsection

@section('pageSnippets')
<!-- BEGIN: Page Scripts -->

<script>

    $(document).ready(function(){

        $(document).on('click', '.portlet-note', function () {
            // Ignore this event if head-tools has been clicked.
            if($(this).find('.m-portlet__head-tools').data('clicked'))
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

<!-- END: Page Scripts -->
@endsection
