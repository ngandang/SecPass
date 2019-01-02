// Chỗ này viết script chung. 
// Viết account sẽ nằm trong accounts.blade.php. Sau này đưa vào accounts.js nhe

// Tự động đăng xuất
var SessionTimeout = function () {

    var initTimer = function () {
        $.sessionTimeout({
            title: 'Thông báo chuyển hướng',
            message: "Hệ thống nhận thấy bạn không hoạt động trong 5 phút vừa qua. <br>Bạn sẽ được chuyển hướng về Trang chủ để bảo mật thông tin trên màn hình.",
            keepAliveUrl: '/session-timeout/keepalive',
            ajaxType: 'GET',
            keepAliveButton: 'Giữ đăng nhập',
            logoutButton: 'Đăng xuất',
            redirUrl: '/',
            logoutUrl: 'logout', //placeholder thôi
            warnAfter: 300000, //cảnh báo sau 5 phút inactive
            redirAfter: 330000, //redirect sau 15 giây
            countdownMessage: 'Chuyển hướng sau {timer} giây.',
            countdownBar: true
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initTimer();
        }
    };

}();

// Reset lại form với data-dismiss="modal"
var DataDismiss = function () {
    $('[data-dismiss=modal]').on('click', function () {
        var form = $(this).closest('form');
        form.clearForm();
        form.validate().resetForm();
    });
};

var QuickbarToggle = function () {
    $('#messenger_toggle').on('click', function(){
        $('#m_quick_sidebar_toggle').click();
        $('#m_quick_sidebar_tabs li a')[0].click();
    });

    $('#logs_toggle').on('click', function(){
        $('#m_quick_sidebar_toggle').click();
        $('#m_quick_sidebar_tabs li a')[1].click();
    });

    $('#faq_toggle').on('click', function(){
        $('#m_quick_sidebar_toggle').click();
        $('#m_quick_sidebar_tabs li a')[2].click();
    });
}

var LogoutButton = function () {
    $('#logout').click(function(e){
        e.preventDefault();
        document.dispatchEvent(new CustomEvent('removeUserPassphraseEvent', {detail: ""}));
        $.ajax({
            url: "/logout",
            method: "POST",
            success: window.location="/login",
            error: function(response, status, xhr, $form) {
                console.log(response);
                swal("", response.message.serialize(), "error");
            }
        });
    });
}

var ForContent = function () {

    $('.m-portlet__nav-link, .m-nav__item').click(function() {
        $(this).closest('.m-portlet').unbind('click');
    });

    // Lose modal focus to show swal
    $('.modal').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });
}

var AddonChecking = function () { 
    var ok = false;
    document.addEventListener('hi', function (event) {
        if(event.detail === "kfbgobbmmfcdipebhoojjjkpcmcjefpg"){
            ok = true;
            console.log("Addon is installed.");            
        }
    });

    console.log('checking addon');
    document.dispatchEvent(new CustomEvent('hello', {detail: "kfbgobbmmfcdipebhoojjjkpcmcjefpg"})); //TODO: thay id addon
    if (ok === false) {
        console.log('Addon is not installed.');
        var isChrome = /Google Inc/.test(navigator.vendor);
        var isFirefox= /Firefox/.test(navigator.userAgent);
        var url = "https://secpass.terabox.vn/addon/"
        if(isChrome)
            url = "chrome.zip";
        if(isFirefox)
            url = "firefox.zip";
        
        swal({
            type: 'warning',
            title:
                'Không tìm thấy tiện ích SecPASS',
            html:
                'Vui lòng <a class="m-link" href="'+ url +'" target="_blank">cài đặt tiện ích</a> để đăng ký sử dụng.',
            confirmButtonText: 'Kiểm tra lại',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            preConfirm: (retry) => {
                window.location = "";
            },
            confirmButtonClass: "btn btn-danger",
        });
    }
    else delete ok;
}

////////////////////////////////////////////////////////////////////

let privkey = null;
let pubkey  = null;
let passphrase = null;

async function encryptFunction(pubkey, callback, handleError) {
    console.log('begin encrypt');
    
    if(messageToEncrypt === ""){
        callback();
    }

    const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
    if (passphrase) {
        console.log("have passphrase");
        await privKeyObj.decrypt(passphrase);
    }
    else {
        console.log("no passphrase");
        let result = await askForPass();
        await privKeyObj.decrypt(result).catch(function (error){
            swal("Sai mật khẩu, hãy thực hiện lại.","", "warning"); // error.message,
            if(handleError)
                handleError(error);
        });
    }
    
    const options = {
        message: openpgp.message.fromText(messageToEncrypt),       // input as Message object
        publicKeys: (await openpgp.key.readArmored(pubkey)).keys, // for encryption
        privateKeys: [privKeyObj]                                 // for signing (optional)
    }
    
    openpgp.encrypt(options).catch(function (error){                
        swal({
            position: 'center',
            type: 'error',
            title: "Lỗi xảy ra, vui lòng thực hiện lại",
            showConfirmButton: false,
            timer: 1500
        });   
        if(handleError)
            handleError(error);
    })
    .then( ciphertext => {
        encrypted = ciphertext.data; // '-----BEGIN PGP MESSAGE ... END PGP MESSAGE-----'
        console.log('end encrypt')
        // return encrypted
        callback(encrypted)
    })
}

async function decryptFunction( callback, handleError) {
    console.log('begin decrypt')
    const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
    if (passphrase) {
        console.log("have passphrase");
        await privKeyObj.decrypt(passphrase);
    }
    else {
        console.log("no passphrase");
        let result = await askForPass();
        await privKeyObj.decrypt(result).catch(function (error){
            swal("Sai mật khẩu, hãy thực hiện lại.","", "warning"); // error.message,
            if(handleError)
                handleError(error);
        });
    }
    
    const options = {
        message: await openpgp.message.readArmored(cipherToDecrypt),    // parse armored message
        publicKeys: (await openpgp.key.readArmored(pubkey)).keys, // for verification (optional)
        privateKeys: [privKeyObj]                                 // for decryption
    }
    
    openpgp.decrypt(options).catch(function (error){                
        swal({
            position: 'center',
            type: 'error',
            title: "Lỗi xảy ra, vui lòng thực hiện lại",
            showConfirmButton: false,
            timer: 1500
        });   
        if(handleError)
            handleError(error);
    })
    .then( plaintext => {
        if(plaintext)
            decrypted = plaintext.data;
        else
            decrypted = "";
        console.log('end decrypt');
        callback(decrypted);
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
            cancelButtonText: 'Huỷ',
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
    var copyText = data;
    var $temp = $("<textarea>");
    $("body").append($temp);
    $("body").append("</textarea>");
    $temp.val(copyText);
    $temp.focus();
    $temp.select();
    document.execCommand("copy");
    $temp.remove();
    
}

////////////////////////////////////////////////////////////////////

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

////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
$(document).ready(function() {    
    document.dispatchEvent(new CustomEvent('letgetUserPassphraseEvent', {detail: ""}));
    document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));

    SessionTimeout.init();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    AddonChecking();
    DataDismiss();
    // Asidebar toggle
    QuickbarToggle();
    ForContent();
    LogoutButton();
});




