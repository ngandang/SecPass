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
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
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
    @include('content.content-notes')
</div>
<!-- END: Content -->

<!-- BEGIN: Add Form -->
<form id="add-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Ghi chú bảo mật mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <form id="add-form" class="form" action="" method="post">                                        
                                <div class="form-group">
                                    <label for="tilte" class="text-info">Tiêu đề:</label><br>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="note_content" class="text-info">Nội dung:</label><br>
                                    <textarea rows="10" type="text" name="note_content" class="form-control m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200"></textarea>
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="addSubmit" class="btn btn-primary pull-right">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Add Form -->

<!-- BEGIN: Edit Form -->
        <form id="edit-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
            <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                {{ csrf_field() }}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="text-center modal-title" id="editFormTitle">
                                <!-- <label for="title" class="text-info">Tiêu đề:</label><br> -->
                                <input type="text" name="title" class="form-control note-title" style="font-size:1em">
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="editform-row" class="row justify-content-center align-items-center">
                                <div id="editform-box" class="col-md-12">
                                    <input type="hidden" name="id" id="idEdit">
                                    <div class="form-group get-content">
                                        <label for="note_content" class="text-info">Nội dung:</label>
                                        <button id="getContent" type="button" class="btn btn-metal" data-toggle="m-tooltip" title="Lấy và giải mã nội dung">
                                                <i class="fa fa-lock fa-fw fa-lg"></i>
                                        </button>
                                        <textarea type="text" name="note_content" class="form-control m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200" placeholder="Đã được bảo mật"></textarea>
                                    </div>
                                    <div class="alert m-alert m-alert--default" role="alert">
                                        <i>Cập nhật cuối: </i><span id="last_updated"></span>												
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                            <button type="submit" id="editSubmit" class="btn btn-primary pull-right">Lưu</button>
                        </div>
                    </div>
                </div>
            </div> 
        </form>
<!-- END: Edit Form -->

<!-- BEGIN: Delete Form -->
<form id="delete-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="deleteForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="id" id="idDelete">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Xóa tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn xóa tài khoản không???
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="delSubmit" class="btn btn-primary" >Xóa</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Delete Form -->

<!--BEGIN: Share form -->
<form id="share-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="shareForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chia sẻ ghi chú bảo mật</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email" class="text-info">Chia sẻ với người dùng hoặc nhóm</label><br>
                        <input type="text" name="email" placeholder="Nhập tên hoặc email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment" class="text-info">Tin nhắn</label><br>
                        <textarea rows="5" name="comment" placeholder="Gửi lời nhắn đến người nhận" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="shareSubmit" class="btn btn-primary" >Chia sẻ</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Share form -->
@endsection

@section('pageSnippets')
<!-- BEGIN: Page Scripts -->
<script src="{{ asset('js/validation_vi.js') }}" type="text/javascript"></script>
<script>

    let privkey = ""
    let pubkey  = ""
    let passphrase = ""
    
    // const encryptFunction = async() => {
    async function encryptFunction(callback) {
        console.log('begin encrypt')

        const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
        if (passphrase) {
            console.log("have passphrase");
            await privKeyObj.decrypt(passphrase);
        }
        else {
            console.log("no passphrase");
            let result = await askForPass();
            await privKeyObj.decrypt(result);
        }
        
        const options = {
            message: openpgp.message.fromText(messageToEncrypt),       // input as Message object
            publicKeys: (await openpgp.key.readArmored(pubkey)).keys, // for encryption
            privateKeys: [privKeyObj]                                 // for signing (optional)
        }
        
        openpgp.encrypt(options).then(ciphertext => {
            encrypted = ciphertext.data // '-----BEGIN PGP MESSAGE ... END PGP MESSAGE-----'
            console.log(encrypted)        
            console.log('end encrypt')
            // return encrypted
            callback(encrypted)
        })
    }

    async function decryptFunction(callback) {
        console.log('begin decrypt')
        const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
        if (passphrase) {
            console.log("have passphrase");
            await privKeyObj.decrypt(passphrase);
        }
        else {
            console.log("no passphrase");
            let result = await askForPass();
            await privKeyObj.decrypt(result);
        }

        const options = {
            message: await openpgp.message.readArmored(cipherToDecrypt),    // parse armored message
            publicKeys: (await openpgp.key.readArmored(pubkey)).keys, // for verification (optional)
            privateKeys: [privKeyObj]                                 // for decryption
        }

        openpgp.decrypt(options).then(plaintext => {
            console.log(plaintext.data)
            decrypted = plaintext.data // 'Hello, World!'
            console.log('end decrypt')
            callback(decrypted)
        })
    }
    
    // const encryptFunction = async() => {
    async function encryptFunction(pubkey, callback) {
        console.log('begin encrypt')

        const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
        if (passphrase) {
            console.log("have passphrase");
            await privKeyObj.decrypt(passphrase);
        }
        else {
            console.log("no passphrase");
            let result = await askForPass();
            await privKeyObj.decrypt(result);
        }
        
        const options = {
            message: openpgp.message.fromText(messageToEncrypt),       // input as Message object
            publicKeys: (await openpgp.key.readArmored(pubkey)).keys, // for encryption
            privateKeys: [privKeyObj]                                 // for signing (optional)
        }
        
        openpgp.encrypt(options).then(ciphertext => {
            encrypted = ciphertext.data // '-----BEGIN PGP MESSAGE ... END PGP MESSAGE-----'
            console.log(encrypted)        
            console.log('end encrypt')
            // return encrypted
            callback(encrypted)
        })
    }
    
    function askForPass(){
        return new Promise(function(resolve, reject) {
            swal({
                title: 'Nhập mật khẩu',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Giải mã',
                showLoaderOnConfirm: true,
                preConfirm: (input) => resolve(input),
                allowOutsideClick: () => !swal.isLoading()
            });
        });        
    }

    // Get user passphrase 
    document.addEventListener('getUserPassphraseEvent', function (event) {
        passphrase= event.detail;
        console.log("got it!");
    });
    // document.dispatchEvent(new CustomEvent('letgetUserPassphraseEvent', {detail: ""})); 

    // Get PGP keys automatically 
    document.addEventListener('getUserPGPEvent', function (event) {
            pgp_key= JSON.parse(event.detail);
            privkey = pgp_key.privateKeyArmored;
            pubkey = pgp_key.publicKeyArmored;
    });
    // document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));

        
    function copyContent(noteId) {
        var data = {
            'id': noteId,
        };
        $.ajax({
            url: 'securenote/getContent',
            type: 'POST',
            data: data,
            success: function(response, status, xhr, $form) {
                cipherToDecrypt = response.content;

                decryptFunction(function (result) {
                    console.log(result);
                    var $temp = $("<textarea id='tempInput'>");
                    $("body").append($temp);        
                    $("body").append('</textarea>');
                    $temp.val(result);   
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });       
                });
            },
            error: function(response, status, xhr, $form) {
                console.log(response);
                swal("", response.message.serialize(), "error");
            }
        });
        setTimeout(() => {
            var $temp = $("#tempInput");
            $temp.focus();
            $temp.select();        
            document.execCommand("copy");
            $temp.remove();
        }, 500);
    }

    function edit(id, title, last_updated){
        $('#editForm input[name=id]').val(id);
        $('#editForm input[name=title]').val(title);
        $('#editForm #last_updated').text(last_updated);
    }
    
    function del(id){
        $('#deleteForm input[name=id]').val(id);
    }
    
    function share(id)
    {
        $('#shareForm input[name=id]').val(id);
    }

    $(document).ready(function(){

        document.dispatchEvent(new CustomEvent('letgetUserPassphraseEvent', {detail: ""}));
        document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));


        $('.m-portlet').click(function (e) {
            var showEditForm = $(this).find(".note-edit");
            showEditForm[0].click();
        });
        $('.m-portlet__nav-link').click(function(e) {
            e.stopPropagation();
        });

        $('#editForm #getContent').click(function () {
            var data = {
                'id': $('#editForm input[name=id]').val(),
            };
            $.ajax({
                url: 'securenote/getContent',
                type: 'POST',
                data: data,
                success: function(response, status, xhr, $form) {
                    cipherToDecrypt = response.content;

                    decryptFunction(function (result) {
                        console.log(result);      
                        $('#editForm textarea[name=note_content]').val(result);
                        $('#editForm textarea[name=note_content]').prop('rows','10');
                    });
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.message.serialize(), "error");
                }
            });
        });

        // Lose modal focus to show swal
        $('#addForm').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });
        $('#editForm').on('shown.bs.modal', function() {
            $(document).off('focusin.modal');
        });

        $('#addSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            btn.addClass('m-loader m-loader--right m-loader--light');
            btn.attr('disabled', true);

            // Encrypt note content with OpenPGPjs
            form.find('textarea[name=note_content]').prop('disabled', true);

            messageToEncrypt = form.find("textarea[name=note_content]").val();
            console.log(messageToEncrypt)

            encryptFunction(function (result) {
                var $temp = $("<textarea name='cipher'>");
                form.append($temp);      
                form.append('</textarea>');
                $temp.val(result);

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
                        }).then(function(result){$('#addForm').modal('hide');});

                        $('.m-content').html(response.view);                        
                        form.clearForm();
                        form.validate().resetForm();
                    },
                    error: function(response, status, xhr, $form) {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                        console.log(response);
                        swal("", response.message.serialize(), "error");
                    }
                });
                $temp.remove();
                form.find('textarea[name=note_content]').prop('disabled', false);
            });
        });

        $('#editSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
             
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            btn.attr('disabled', true);

            // Encrypt note content with OpenPGPjs
            form.find('textarea[name=note_content]').prop('disabled', true);

            messageToEncrypt = form.find("textarea[name=note_content]").val();
            encryptFunction(function (result) {
                var $temp = $("<textarea name='cipher'>");
                form.append($temp);
                form.append('</textarea>');
                $temp.val(result);
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
                        }).then(function(result){$('#editForm').modal('hide');});

                        $('.m-content').html(response.view);
                        form.clearForm();
                        form.validate().resetForm();
                    },
                    error: function(response, status, xhr, $form) {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                        swal("","Có lỗi xảy ra", "error");
                        console.log(response.responseJSON.message);
                    }
                });
                $temp.remove();
                form.find('textarea[name=note_content]').prop('disabled', false);
            });
        });

        $('#delSubmit').click(function(e){
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
                    }).then(function(result){$('#deleteForm').modal('hide');});

                    $('.m-content').html(response.view);
                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    swal("", response.serialize(), "error");
                }
            });
        });

        $('#shareSubmit').click(function(e){
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
                                        }).then(function(result){$('#shareForm').modal('hide');});

                                        form.clearForm();
                                        form.validate().resetForm();
                                    },
                                    error: function(response, status, xhr, $form) {
                                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                                        swal("Có lỗi xảy ra", "", status);
                                        console.log(response);
                                    }
                                });
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
                        }).then(function(result){$('#shareForm').modal('hide');});

                        form.clearForm();
                        form.validate().resetForm();
                    }
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("Có lỗi xảy ra", "", status);
                    console.log(response);
                }
            });
        });
    });
</script>

<!-- END: Page Scripts -->
@endsection
