// Chỗ này viết script chung. 
// Viết account sẽ nằm trong accounts.blade.php. Sau này đưa vào accounts.js nhe

// Tự động đăng xuất
var SessionTimeout = function () {

    var initTimer = function () {
        $.sessionTimeout({
            title: 'Thông báo chuyển hướng',
            message: "Hệ thống nhận thấy bạn không hoạt động trong 5 phút vừa qua. <br>Bạn sẽ được chuyển hướng về Trang chủ để bảo mật thông tin trên màn hình.",
            keepAliveUrl: 'session-timeout/keepalive',
            ajaxType: 'GET',
            keepAliveButton: 'Giữ đăng nhập',
            logoutButton: 'Đăng xuất',
            redirUrl: '#',
            logoutUrl: 'logout', //placeholder thôi
            warnAfter: 300000, //cảnh báo sau 2 phút inactive
            redirAfter: 315000, //redirect sau 15 giây
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

var MessengerToggle = function () {
    $('#messenger_toggle').on('click', function(){
        $('#m_quick_sidebar_toggle').click();
        $('#m_quick_sidebar_tabs li a')[0].click();
    });
}
var LogsToggle = function () {
    $('#logs_toggle').on('click', function(){
        $('#m_quick_sidebar_toggle').click();
        $('#m_quick_sidebar_tabs li a')[1].click();
    });
}
var FAQToggle = function () {
    $('#faq_toggle').on('click', function(){
        $('#m_quick_sidebar_toggle').click();
        $('#m_quick_sidebar_tabs li a')[2].click();
    });
}

var LogoutButton = function () {
    $('#logout').on('click', function(e){
        e.preventDefault();
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

$(document).ready(function() {    
    SessionTimeout.init();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    DataDismiss();
    // Asidebar toggle
    MessengerToggle();
    LogsToggle();
    FAQToggle();
    LogoutButton();
});




