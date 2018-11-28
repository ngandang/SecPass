<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Chào mừng đến với SecPASS</h2>

        <div>
            <p>Cảm ơn bạn đã đăng ký sử dụng hệ thống quản lý thông tin cá nhân SecPASS.
            Vui lòng nhấn vào link bên dưới để xác thực tài khoản của bạn:</p>
            <a href="{{ URL::to( 'register/verify/' . $user->verification_code ) }}">Xác thực tài khoản</a>
            
            <h3>Lưu ý</h3>
            <p>Chúng tôi chỉ lưu trữ khoá công khai của bạn tại máy chủ. <br>Khoá riêng tư được lưu trong Tiện ích SecPASS trên thiết bị của bạn. Bạn cần sao lưu và bảo đảm an toàn thông tin cho cặp khoá này.</p>

        </div>

    </body>
</html>