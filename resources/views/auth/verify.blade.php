<!DOCTYPE html>
<html lang="vi" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			SecPASS | Xác thực tài khoản
		</title>
		<meta name="description" content="SecPASS - The password management system for indiviuals and groups">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="{{ asset('vendors/base/webfont.js') }}"></script>
		<script>
          WebFont.load({
            google: {"families":["Helvetica:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->
		<link href="{{ asset('vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="default/media/img/logo/favicon.ico" />
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1" id="m_login" style="background-image: url({{ asset('app/media/img/bg/bg-5.jpg') }});">
				<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img width="300" src="{{ asset('default/media/img/logo/logo_395x50_dark.png') }}"/>
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									@if($status)
                                        Xác thực thành công
                                    @else
                                        Xác thực không thành công
                                    @endif
								</h3>
							</div>
                            @if ($status)
							<form class="m-login__form m-form">
								<div class="form-group m-form__group">
                                    <div class="alert alert-success">
										<h5>Xác thực tài khoản thành công.</h5>
										Bạn sẽ được chuyển đến trang đăng nhập sau 5 giây, hoặc nhấn Đăng nhập ngay bên dưới.
                                    </div>
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_redirect_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
                                        Đăng nhập
                                    </button>
                                </div>
                            </form>
                            @else
                            <form class="m-login__form m-form">
                            @csrf
                                <div class="form-group m-form__group">
                                    <div class="alert alert-danger">
                                        <h5>Lỗi xảy ra!</h5>
                                        Xác thực tài khoản không thành công. Vui lòng kiểm tra hoặc nhập lại email để nhận mã xác thực mới.
                                    </div>
								</div>
								<div class="form-group m-form__group">
                                    <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
								</div>
								<div class="m-login__form-action">
									<button id="m_verify_resend_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
										Gửi yêu cầu
									</button>
								</div>
							</form>
                            @endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end:: Page -->
    	<!--begin::Base Scripts -->
		<script src="{{ asset('vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('default/base/scripts.bundle.js') }}" type="text/javascript"></script>
		<!--end::Base Scripts -->   
		<!--begin::Page Snippets -->
		<script src="{{ asset('js/validation_vi.js') }}" type="text/javascript"></script>
		<script src="{{ asset('snippets/pages/user/verify.js') }}" type="text/javascript"></script>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
