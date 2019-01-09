@extends('layouts.master')

@section('content')

<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Chia sẻ
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
                            Các nhóm chia sẻ
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="btn-add-group">
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addGroupForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <span>
                    <i class="la la-plus"></i>
                    <span>
                        Tạo nhóm mới
                    </span>
                </span>
            </a>
        </div>
    </div>
</div>

<!-- BEGIN: Content -->
<div class="m-content">
    @include('content.content-group')
</div>
<!-- END: Content -->
<!-- BEGIN: Add group form -->
<form id="add-group-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="addGroupForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Tạo nhóm mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="text-info">Tên nhóm</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <label for="email" class="text-info">Thêm email người dùng</label>
                                    <input type="text" name="email" class="form-control">
                                    <span class="m-form__help text-muted">
                                        Bạn được mặc định là quản trị viên của nhóm.
                                    </span>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-info">&nbsp;</label>
                                    <button id="addUser" type="button" class="btn btn-primary">
                                        Thêm
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="list" class="text-info">Danh sách người dùng</label>
                                <ul id="users" class="col-lg-8"></ul>
                            </div>                        
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary pull-right" id="addGroupSubmit">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Add group form -->

@endsection

@section('pageSnippets')
<!-- BEGIN: Page Scripts -->
<script>

    function del(id){
        $('#deleteGroupForm input[name=id]').val(id);
    }
    
    document.addEventListener('sendGroupPGPEvent', async function (event) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "0",
            "extendedTimeOut": "0",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        let emails = event.detail.emails;
        let pgpData = event.detail.pgpData;
        let group_id = pgpData.group_id;
        let group_pgp_text = JSON.stringify(pgpData.group_pgp);        
    
        emails.forEach(function (email, idx){
            toastr.clear();
            toastr.warning("Đang gửi dữ liệu nhóm cho các thành viên","Đang xử lý");
            // lấy pubkey user
            $.ajax({
                url: "/pgp/get",
                type: "POST",
                data: {
                    'email': email
                },
                success: function(response, status, xhr, $form) {
                    var sendPGP = async function () {
                        let user_id = response.owner_id;
                        let user_pubkey = response.armored_key;
                        // encryption for each user_id public-key
                        const options = {
                            message: openpgp.message.fromText(group_pgp_text),       // input as Message object
                            publicKeys: (await openpgp.key.readArmored(user_pubkey)).keys, // for encryption
                            // privateKeys: [privKeyObj]                                 // for signing (optional)
                        }
                        openpgp.encrypt(options).catch(function (error){                
                            toastr.error("Mã hoá dữ liệu nhóm không thành công");
                        })
                        .then( ciphertext => {
                            cipher = ciphertext.data; // '-----BEGIN PGP MESSAGE ... END PGP MESSAGE-----'
                            data = {
                                'sender_id': group_id,
                                'receiver_id': user_id,
                                'data': cipher
                            };
                            $.ajax({
                                url: "/group/sendPGP",
                                type: "POST",
                                data: data,
                                success: function(response, status, xhr, $form) {
                                    console.log(response);
                                    toastr.success(response.message);
                                },
                                error: function(response, status, xhr, $form) {
                                    console.log(response);
                                    toastr.error(response.responseJSON.message);
                                }
                            });
                        });                              
                    };

                    sendPGP();
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    toastr.error(response.responseJSON.message);
                }
            });
        });
        
        //send group private-key to addon
        const privKeyObj = (await openpgp.key.readArmored(pgpData.group_pgp.privateKeyArmored)).keys[0];
        
        if (passphrase) {
            console.log("have passphrase");
            await privKeyObj.encrypt(passphrase);
        }
        else {
            swal({
                title: 'Lưu dữ liệu nhóm vào tiện ích',
                text: "Bạn cần nhập mật khẩu để mã hoá khoá riêng tư của nhóm",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đã hiểu'
            }).then(async function (result){
                if (result.value) {
                    console.log("no passphrase");
                    let result = await askForPass();
                    // Check if passphrase correct
                    const userPrivKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
                    await userPrivKeyObj.decrypt(result).catch(function (error){
                        swal("Sai mật khẩu, hãy thực hiện lại.","", "warning"); // error.message,
                        if(handleError)
                            handleError(error);
                    });
                    await privKeyObj.encrypt(result);
                }
            });
        }

        // Send group_pgp to extension
        pgpData.group_pgp.privateKeyArmored = privKeyObj.armor();
        document.dispatchEvent(new CustomEvent('setGroupPGPEvent', {detail: pgpData}));
    });
    
    $(document).ready(function(){

        $(document).on('click','.m-portlet', function (e) {
            var showGroup = $(this).find(".open-group");
            if(showGroup[0])
                showGroup[0].click();
            else
                showGroup.click();
        });

        $('#addGroupForm input[name=email]').keypress(function(e) {            
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
                'email' : $('#addGroupForm input[name=email]').val()
            };
            $.ajax({
                url: 'group/checkUser',
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
                    $('#addGroupForm input[name=email]').val("");
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

        $('#addGroupSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            if (!form.valid()) {
                return;
            }

            emailArray = new Array();
            cnt = 0;
            $("#users li span").each(function(){
                emailArray[cnt] = $(this).text();
            cnt++;
            });
            if (!emailArray[0]){
                form.find("input[name=email]").css('border-color','#dc3545');
                return;
            }
            var jsonString = JSON.stringify(emailArray);

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                    url: '/group/addGroup',
                    type: 'POST',
                    data: {li_variable: jsonString},
                    success: function(response, status, xhr, $form) {
                        $("#addGroupForm .modal-footer").prepend('<span class="text-muted">'+response.message+'</span>');

                        // Get user passphrase
                        document.dispatchEvent(new CustomEvent('letgetUserPassphraseEvent', {detail: ""}));
                        
                        // Generate PGP key
                        var options = {
                            userIds: [{ name: response.id , 
                                        email: response.id + "@secpass.terabox.vn" }], // multiple user IDs
                            numBits: 2048,                                            // RSA key size
                        };
                        console.log(options);

                        openpgp.generateKey(options).then(async function(key) {
                            console.log(key);
                            
                            const pubKeyObj = (await openpgp.key.readArmored(key.publicKeyArmored)).keys[0];

                            let pgp_key = {
                                'owner_id': response.id,
                                'armored_key': key.publicKeyArmored,
                                'uid': pubKeyObj.users[0].userId.userid,
                                'key_id': pubKeyObj.keyPacket.keyid.bytes,
                                'fingerprint': pubKeyObj.keyPacket.fingerprint,
                                'type': pubKeyObj.keyPacket.tag,
                                'expires': pubKeyObj.keyPacket.expirationTimeV3,
                                'key_created': pubKeyObj.keyPacket.created
                            };

                            $.ajax({
                                url: 'group/addPGP',
                                type: 'POST',
                                data: pgp_key,
                                success: function(response, status, xhr, $form){
                                    // Declare for set PGP to addon
                                    let group_pgp = {
                                        'privateKeyArmored': key.privateKeyArmored,
                                        'publicKeyArmored': key.publicKeyArmored
                                    };

                                    let pgpData = {
                                        'group_id': response.id,
                                        'group_pgp': group_pgp
                                    };

                                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                    swal({
                                        position: 'center',
                                        type: 'success',
                                        title: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function(result){
                                        $('#addGroupForm').modal('hide');
                                    }).then(function(){
                                        // Async send pgp to members
                                        let sendGroupPGP = {
                                            'emails': emailArray,
                                            'pgpData': pgpData
                                        }
                                        document.dispatchEvent(new CustomEvent('sendGroupPGPEvent', {detail: sendGroupPGP}));
                                    });

                                    $('.m-content').html(response.view);
                                    $("#users li").remove();
                                    $("#addGroupForm .modal-footer .text-muted").remove();

                                    form.clearForm();
                                    form.validate().resetForm();
                                },
                                error: function(response, status, xhr, $form) {
                                    // similate 1s delay
                                    setTimeout(function() {
                                        console.log(response);
                                        $("#addGroupForm .modal-footer .text-muted").remove();
                                        btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                                        swal("", response.responseJSON.message, "error");
                                    }, 1000);
                                }
                            });
                        });
                    },
                    error: function(response, status, xhr, $form) {
                        swal("", response.responseJSON.message, "error");
                        console.log(response.mesage);
                    }
                });
           
            
        });
    });
</script>


@endsection