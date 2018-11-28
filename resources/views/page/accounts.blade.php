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
                    <a href="javascript:void();" class="m-nav__link m-nav__link--icon">
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

        <button id="test1">Test set PGP</button>
        <button id="test2">Test get PGP</button>

        <div class="btn-add-account">
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addForm" data-toggle="modal">
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

@endsection

@section('pageSnippets')
<!-- BEGIN: Page Scripts -->
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
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="col-md-2" style="padding-left:8px;">
                                    <label class="text-info">&nbsp</label>
                                    <button onclick="generate();" type="button" class="btn btn-metal">
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
                                    <input id="password-edit" type="password" name="password" placeholder="Nhấn lấy mật khẩu" class="form-control" required>
                                    <span toggle="#password-edit" class="fa fa-fw fa-eye field-icon toggle-edit"></span>
                                </div>
                                <div class="col-md-2" style="padding-left:8px;">
                                    <label class="text-info">&nbsp</label>
                                    <button onclick="generateEdit();" type="button" class="btn btn-metal">
                                        <i class="fa fa-magic fa-fw fa-lg"></i>
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
<form id="share-form" class="form-horizontal" action="../account/share" enctype="multipart/form-data" method="get">
    {{ csrf_field() }}
    <div class="modal fade" id="shareForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="idShare" id="idShare">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chia sẻ tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user" class="text-info">Chia sẻ với người dùng hoặc nhóm</label><br>
                        <input type="text" name="email" placeholder="Nhập tên hoặc email" class="form-control">
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

<script src="{{ asset('js/validation_vi.js') }}" type="text/javascript"></script>

<script> 
    // OpenPGPjs
    const privkey1 = '-----BEGIN PGP PRIVATE KEY BLOCK-----\r\nVersion: OpenPGP.js v4.2.1\r\nComment: https://openpgpjs.org\r\n\r\n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\r\nYXkb\r\n=K9rW\r\n-----END PGP PRIVATE KEY BLOCK-----\r\n' //encrypted private key
    const pubkey1 = '-----BEGIN PGP PUBLIC KEY BLOCK-----\r\nVersion: OpenPGP.js v4.2.1\r\nComment: https://openpgpjs.org\r\n\r\nxsBNBFvuUfgBCADgUdMAhzClHIHPfxxao0DBtauwukaSXwqNmY1YJgewBdlQ\r\nq61rbar29ER/eUWt51MIkv5LFAYluxqH0rNy2UD8x6zGm3Nfj1y04OwKPRC2\r\nZkT33CKc10ayaFxGjx11vJcC9iptrCftWCLkfOGBpTIdHoTTHwAGeVQevkGj\r\nh/u6tvYt/usXZfydJBKzrneYaaOMqz15Q2Yitdsvv9qAKFpVpsWvmWUnY2p2\r\nnLI5Bwp8+/alb/eomMBLwYgmuvycahUyH8SSH5MNCCok2Hg9fCD5GFPtAzNM\r\nxRprBByqGp1bSaLP9Bf2f7SYp6fbWUQ9PESutmuIalnesgJaHo97Ujl5ABEB\r\nAAHNGkN1b25nIDxjdW9uZ25wQHRlcmFib3gudm4+wsB1BBABCAAfBQJb7lH4\r\nBgsJBwgDAgQVCAoCAxYCAQIZAQIbAwIeAQAKCRDXodHgyo+aNvq8B/9cPVIf\r\n0Y7qgt1UnIK5XU1ebeVv/NRAXv6hu6xtEcEBsCyTmS51P2PeO0CRPBRnYlFT\r\neyUjrb2XZwpd39yIwOU9kK+bg16lp23QI+Ul8tkUYEagXYU8y+2EQqs/8gZN\r\nvxIK9axs/ddjxhfFUA4HX/c4TYNnz+0KS5anxm5AoNqn9im9lEulIY+E7pY9\r\nJIFsJZpRVNZOA1jsbCwQLwkK6/AT463YIhACImaFU3iXha1bLAU4wDmhqee3\r\nunq7EUc+yDYf8QDQF1TSMcHSNrZY2fyWohU/5J8UCs6BSo324I0C0RT+XPMj\r\n/K4dKMk73weY8bOkTub6MTKLw/8mQsvLnYYmzsBNBFvuUfgBCAC++0axJbnf\r\nM6rm9N0QM+sWtcuuKk2Z+20/nB8cgIEcB3/Hcro7D3k0IAxIupahQAyArcoP\r\nma4+9wqnxJJcZY9jhxVRuxxBCK4cVJuz30J47qiaJdd/qA90W3h606PyCMFX\r\n3il8IPq58Ec91DKcj/56uymfiutOqUSEwpw93rUZgfkVe3D0KogEEgoqQBug\r\n8Tb+E5lUNJe8XNqUhLeMsDjizj0JrbbT4tx52dn0tezUJ2kwyQkUscxn03dx\r\nu1X+Egs5BpGhG9t2ufc3UwJ6zNR0P3X3shJc0o2ThKunfeSxQSt1dZiVzp24\r\n6d1O+8AU7NQDBQqil6k/SROQN2+ZPwpJABEBAAHCwF8EGAEIAAkFAlvuUfgC\r\nGwwACgkQ16HR4MqPmjZavQf/ZELvlh0IwSzxtjUtDyoA7wpI2GK/gyTuc4CH\r\nPYH3sxWmgR8ZBiGxxeHdSbaQAmYNWS2Mj3J3graP5WgDVrRr+YnLMOr8d8FZ\r\nicAwpx9Q/uXRhqE3ice6FIShG7JF7KnHPYWrCo94j4PCbtHoVmE1oHIvJvyK\r\nCCvzt7/uvLZ5q69SJ2fQimNiZSEFILWEc4CVbd0o8M1Po/oHIuoDJS+TzmQd\r\nysYnrYugG5xqA8g17rKADlscPV59ffUweQxlG1MqD+5zAIJ/qy5jr4gwMlTx\r\n1Y8+ThfO4mOIRJWl4KAu9c/crQh4Bphh1jaWfvvGs8nfZVCUCCIavzT7Bsjg\r\nf2F5Gw==\r\n=ujeF\r\n-----END PGP PUBLIC KEY BLOCK-----\r\n'
    const revocationCertificate1 = "-----BEGIN PGP PUBLIC KEY BLOCK-----\r\nVersion: OpenPGP.js v4.2.1\r\nComment: https://openpgpjs.org\r\nComment: This is a revocation certificate\r\n\r\nwsBfBCABCAAJBQJb7lH4Ah0AAAoJENeh0eDKj5o2FWkH/iFGn8xeqOw1govM\r\nGqYtRBlUUhGmXNvd0YBs8T3TeJuFLKb+qj6/lWUf3wFCQZcMoKF/sdFuZY21\r\nZF7zJ3WeX7zF5PVHpD9M86n6g2bFsOU5UuZtCuI9fm14idoLYpAS+0pOigVm\r\nrzAqZ1osin30/a8v6ZwiSDEFiTKMTUtUsUEwfvdc62t37UPQgmXyQf8IDmrB\r\nd2nJP0JNN+wC4AQqUkKOtqxTgQ8juLSbjvwC92X5Dw52ayMxVFDWELua3lwf\r\nCHMZasIsBMQC0qRdzwf5+nPZ1fVSuzqoKL/7upmTpcEH9YKyPD5WkXhJmYj5\r\nfxzKZchZTghZ6PDoPpn94KM8F1w=\r\n=9a4j\r\n-----END PGP PUBLIC KEY BLOCK-----\r\n"
    const passphrase = "npc.Imahacker#135" //what the privKey is encrypted with
    
    let privkey = ""
    let pubkey = null
    // const passphrase = addon.passphrase
    
    // const encryptFunction = async() => {
    async function encryptFunction(callback) {
        console.log('begin encrypt')

        const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
        await privKeyObj.decrypt(passphrase);
        
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
        await privKeyObj.decrypt(passphrase);

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

    function copy(data) {
        console.log(data);
        var copyText = data;
        var $temp = $("<input>");
        $("body").append($temp);        
        $temp.val(copyText);
        // setTimeout(() => {
            $temp.select();
            document.execCommand("copy");
            $temp.remove();
        // }, 500);
        
    }

    function copyUsername(data) {
        copy(data)
        // .then(function() {
            swal({
                position: 'center',
                type: 'success',
                title: 'Đã sao chép tên đăng nhập',
                showConfirmButton: false,
                timer: 1500
            });
        // });
    }

    function copyPassword(accId) {
        var data = {
            "_token": "{{ csrf_token() }}",
            'id': accId,
        };
        $.ajax({
            url: 'account/copyPassword',
            type: 'POST',
            data: data,
            success: function(response, status, xhr, $form) {
                cipherToDecrypt = response.password;
            
                // send data through a DOM event
                // var user_pgp = document.dispatchEvent(new CustomEvent('getUserPGPEvent', {data: ""}));  
                
                decryptFunction(function (result) {
                    console.log(result);
                    var $temp = $("<input id='tempInput'>");
                    $("body").append($temp);        
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
            $temp.select();        
            document.execCommand("copy");
            $temp.remove();
        }, 500);
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
        $('#test1').click(function(){
            var data = {
                'privateKeyArmored': privkey1,
                'publicKeyArmored' : pubkey1,
                'revocationCertificate': revocationCertificate1
            }
            document.dispatchEvent(new CustomEvent('setUserPGPEvent', {detail: data}));
        });
        // Get PGP keys automatically 
        document.addEventListener('getUserPGPEvent', function (event) {
                pgp_key= event.detail;
                
                privkey = pgp_key.privateKeyArmored;
                pubkey = pgp_key.publicKeyArmored;
            });
        document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));


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
            form.find('input[name="password"]').prop('disabled', true);

            messageToEncrypt = form.find("input[name=password]").val();
            
            // send data through a DOM event
            document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));

            encryptFunction(function (result) {
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
                form.find('input[name="password"]').prop('disabled', false);
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
            
            // Encrypt password with OpenPGPjs
            form.find('input[name="password"]').prop('disabled', true);

            messageToEncrypt = form.find("input[name=password]").val();
            encryptFunction(function (result) {
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
                form.find('input[name="password"]').prop('disabled', false);
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
        
    });
</script>

<!-- END: Page Scripts -->
@endsection
