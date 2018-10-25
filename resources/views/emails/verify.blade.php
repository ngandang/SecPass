<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Chào mừng đến với SecPass</h2>

        <div>
            <p>Cảm ơn bạn đã đăng ký sử dụng hệ thống quản lý thông tin cá nhân SecPass.
            Vui lòng nhấn vào link bên dưới để xác thực tài khoản của bạn:</p>
            <a href="{{ URL::to( 'register/verify/' . $user->verification_code ) }}">Xác thực tài khoản</a>

        </div>

    </body>
</html>