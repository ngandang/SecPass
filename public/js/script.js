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
            redirUrl: '',
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

var ForContent = function () {    
    $('.m-portlet').click(function (e) {
        var showEditForm = $(this).find(".account-edit");
        if(showEditForm[0])
            showEditForm[0].click();
    });
    
    $('.m-portlet__nav-link, .m-nav__item').click(function(e) {
        $(this).closest('.m-portlet').unbind('click');
    });

    // Lose modal focus to show swal
    $('#addForm, #editForm, #shareForm').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
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
    QuickbarToggle();
    ForContent();
    LogoutButton();
});




