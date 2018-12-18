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
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
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

<!-- BEGIN: Add form -->
<form id="add-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Thêm tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="text-info">Tên trang</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="url" class="text-info">URL</label>
                                <input type="text" name="url" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="username" class="text-info">Tên đăng nhập</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="password" class="text-info">Mật khẩu</label>
                                    <input id="password-field" type="password" name="password" class="form-control" required>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" data-toggle="m-tooltip" title="Hiện/ẩn mật khẩu"></span>
                                </div>
                                <div class="col-md-2" style="padding-left:8px;">
                                    <label class="text-info">&nbsp</label>
                                    <button onclick="generate();" type="button" class="btn btn-metal" data-toggle="m-tooltip" title="Tạo mật khẩu ngẫu nhiên">
                                        <i class="fa fa-magic fa-fw fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="text-info">Mô tả</label>
                                <textarea type="text" name="description" class="form-control"></textarea>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary pull-right" id="addSubmit">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Add form -->

<!-- BEGIN: Edit form -->
<form id="edit-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="editFormTitle">Chỉnh sửa tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="editform-row" class="row justify-content-center align-items-center">
                        <div id="editform-box" class="col-md-12">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label for="name" class="text-info">Tên trang</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="url" class="text-info">URL</label>
                                <input type="text" name="url" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="username" class="text-info">Tên đăng nhập</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                <label for="password" class="text-info">Mật khẩu</label>
                                    <input id="password-edit" type="password" name="password" placeholder="Đã được bảo mật" class="form-control">
                                    <span toggle="#password-edit" class="fa fa-fw fa-eye field-icon toggle-edit" data-toggle="m-tooltip" title="Hiện/ẩn mật khẩu"></span>
                                </div>
                                <div class="col-md-2" style="padding-left:8px;">
                                    <label class="text-info">&nbsp</label>
                                    <button id="getPassword" type="button" class="btn btn-metal" data-toggle="m-tooltip" title="Lấy và giải mã mật khẩu">
                                        <i class="fa fa-lock fa-fw fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="text-info">Mô tả</label>
                                <textarea type="text" name="description" class="form-control"></textarea>
                            </div>
                            <div class="alert m-alert m-alert--default" role="alert">
                                <i>Cập nhật cuối: </i><span id="last_updated"></span>												
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="editSubmit" class="btn btn-primary pull-right" >Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Edit form -->

<!--BEGIN: Delete form -->
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
                    Bạn có chắc chắn xóa tài khoản này không???
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="delSubmit" class="btn btn-primary" >Xóa</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Delete form -->

<!--BEGIN: Share form -->
<form id="share-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="shareForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chia sẻ tài khoản</h5>
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

    let privkey = null;
    let pubkey  = null;
    let passphrase = null;
    
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
        
        try{
            openpgp.decrypt(options).then(plaintext => {
                console.log(plaintext.data)
                decrypted = plaintext.data // 'Hello, World!'
                console.log('end decrypt')
                callback(decrypted)
            })
        }
        catch(e) {
            console.log(e);
            swal({
                position: 'center',
                type: 'danger',
                title: "Lỗi ",
                showConfirmButton: false,
                timer: 1500
            });   
        }
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
        console.log("got it !");
    });
    // document.dispatchEvent(new CustomEvent('letgetUserPassphraseEvent', {detail: ""})); 

    // Get PGP keys automatically 
    document.addEventListener('getUserPGPEvent', function (event) {
            var pgp_key = JSON.parse(event.detail); // bypass firefox permission error
            privkey = pgp_key.privateKeyArmored;
            pubkey =  pgp_key.publicKeyArmored;

            // var newInstance = JSON.parse(JSON.stringify(firstInstance));

            // For a shallow copy:
            // b = $.extend( {}, a );

            // Or a deep copy:
            // b = $.extend( true, {}, a );
    });
    // document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));

    function copy(data) {
        console.log(data);
        var copyText = data;
        var $temp = $("<input>");
        $("body").append($temp);        
        $temp.val(copyText);
        // setTimeout(() => {
            $temp.focus();
            $temp.select();
            document.execCommand("copy");
            $temp.remove();
        // }, 500);
        
    }

    function edit(id, name, username, url, description, last_updated){
        $('#editForm input[name=id]').val(id);
        $('#editForm input[name=name]').val(name);
        $('#editForm input[name=username]').val(username);
        $('#editForm input[name=url]').val(url);
        $('#editForm textarea[name=description]').val(description);
        $('#editForm #last_updated').text(last_updated);
    }
    
    function del(id){
        $('#deleteForm input[name=id]').val(id);
    }
    
    function share(id)
    {
        $('#shareForm input[name=id]').val(id);
    }

    function randomPassword() {
        var length = 12;
        var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        return pass;
        
    }

    function generate() {
        $('#addForm input[name=password]').val(randomPassword());
    }
    function generateEdit(){
        $('#editForm input[name=password]').val(randomPassword());
    }

    $(document).ready(function(){

        // setTimeout(() => {
            document.dispatchEvent(new CustomEvent('letgetUserPassphraseEvent', {detail: ""}));
            document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));
        // }, 500);

        $("#editForm input[name=password]").on("click", function (){
            $(this).prop("placeholder","Đổi mật khẩu? Hãy tiếp tục");
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
            // $(this).closest('.m-portlet').unbind('click');
        });

        $('.account-copy-content').click(function (e) {
            var data = {
                'id': $(this).closest('.m-portlet').find('.account-id').text(),
            };
            console.log(data.id);
            $.ajax({
                url: 'account/getContent',
                type: 'POST',
                data: data,
                success: function(response, status, xhr, $form) {
                    cipherToDecrypt = response.content;

                    decryptFunction(function (result) {
                        console.log(result);
                        var $temp = $("<input id='tempInput'>");
                        $("body").append($temp);        
                        $temp.val(result);
                        $temp.select();        
                        document.execCommand("copy");
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
                $temp.select();        
                document.execCommand("copy");
                $temp.remove();
            }, 500);
            e.stopPropagation();
        });

        $('#getPassword').click(function () {
            var data = {
                'id': $('#editForm input[name=id]').val(),
            };
            $.ajax({
                url: 'account/getContent',
                type: 'POST',
                data: data,
                success: function(response, status, xhr, $form) {
                    cipherToDecrypt = response.content;

                    decryptFunction(function (result) {
                        console.log(result);      
                        $('#editForm input[name=password]').val(result);
                        $('#getPassword i').removeClass('fa-lock');
                        $('#getPassword i').addClass('fa-unlock');
                    });
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.message.serialize(), "error");
                }
            });
        });

        

        $('#addSubmit').click(function(e){
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
                var $temp = $("<textarea name='cipher'>");
                form.append($temp);      
                form.append('</textarea>');
                $temp.val(result);

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
                form.find('input[name=password]').prop('disabled', false);
            });            
        });

        $('#editSubmit').click(function(e){
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
                var $temp = $("<input name='cipher'>");
                form.append($temp);        
                $temp.val(result);
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
                        }).then(function(result){$('#editForm').modal('hide');});

                        $('.m-content').html(response.view);
                        form.clearForm();
                        form.validate().resetForm();
                    },
                    error: function(response, status, xhr, $form) {
                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                        swal("Có lỗi xảy ra", "error");
                        console.log(response.responseJSON.message);
                    }
                });
                $temp.remove();
                form.find('input[name=password]').prop('disabled', false);
            });
        });

        $('#delSubmit').click(function(e){
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
                    }).then(function(result){$('#deleteForm').modal('hide');});

                    $('.m-content').html(response.view);
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
        
        $('#shareSubmit').click(function(e){
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
