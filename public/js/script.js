// Chỗ này viết script chung. 
// Viết account sẽ nằm trong accounts.blade.php. Sau này đưa vào accounts.js nhe

// Tự động đăng xuất
var SessionTimeout = function () {

    var initTimer = function () {
        $.sessionTimeout({
            title: 'Thông báo chuyển hướng',
            message: "Hệ thống nhận thấy bạn không hoạt động trong 5 phút vừa qua. <br>Bạn sẽ được đăng xuất và chuyển hướng để bảo mật thông tin.",
            keepAliveUrl: 'session-timeout/keepalive',
            keepAliveButton: 'Giữ đăng nhập',
            logoutButton: 'Đăng xuất',
            redirUrl: '/',
            logoutUrl: 'logout', //placeholder thôi
            warnAfter: 300000, //cảnh báo sau 2 phút inactive
            redirAfter: 15000, //redirect sau 15 giây
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

jQuery(document).ready(function() {    
    SessionTimeout.init();
});