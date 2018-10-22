<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Chào mừng đến với SecPass</h2>

        <div>
            Cảm ơn bạn đã đăng ký sử dụng hệ thống quản lý thông tin cá nhân SecPass.
            Vui lòng nhấn vào link bên dưới để xác nhận tài khoản của bạn:
            {{ URL::to('register/verify/' . $user->verification_code) }}.<br/>

        </div>

    </body>
</html>