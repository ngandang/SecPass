<!DOCTYPE html>
<html lang="vi" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			SecPASS | Đăng nhập
		</title>
		<meta name="description" content="SecPASS - The password management system for indiviuals and groups">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
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
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<a href="#">
								<img width="300" src="{{ asset('default/media/img/logo/logo_395x50_dark.png') }}"/>
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<!-- <h3 class="m-login__title">
									Bớt ngây thơ đi bạn
								</h3> -->
							</div>
							<form class="m-login__form m-form" action="" >
								@csrf
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Mật khẩu" name="password">
								</div>
								<div class="row m-login__form-sub">
									<div id="m_login_remember_me" class="col m--align-left m-login__form-left" data-container="body" data-toggle="m-popover" data-placement="left" data-content="Tuỳ chọn này giúp bạn không cần nhập mật khẩu thường xuyên trong quá trình sử dụng." data-original-title="" title="">
										<label class="m-checkbox  m-checkbox--light">
											<input type="checkbox" name="remember">
												Xử lý mật khẩu tự động
											<span></span>
										</label>
									</div>
									<div class="col m--align-right m-login__form-right">
										<a href="javascript:;" id="m_login_forget_password" class="m-link">
											Quên mật khẩu ?
										</a>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-brand m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
										Đăng nhập
									</button>
								</div>
							</form>
						</div>
						<div class="m-login__signup">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Đăng ký tài khoản
								</h3>
								<div class="m-login__desc">
									Điền thông tin chi tiết cho các trường bên dưới.
								</div>
							</div>
							<form class="m-login__form m-form" action="">
		  						@csrf
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Tên đăng nhập" name="name" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
								</div>
								
								<div class="form-group m-form__group last password-strength" data-container="body" data-toggle="m-popover" data-html="true" data-placement="left" data-content="Mật khẩu phải chứa ít nhất 8 ký tự bao gồm ít nhất:<br><ul><li>một ký tự hoa,</li><li>một ký tự thường,</li><li>một ký tự số,</li><li>một ký tự đăc biệt.</li></ul>" data-original-title="" title="">
									<input class="form-control m-input" type="password" placeholder="Mật khẩu" name="password" id="register_password">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Nhập lại mật khẩu" name="password_confirmation">
								</div>
								<div class="row form-group m-form__group m-login__form-sub">
									<div class="col m--align-left">
										<label class="m-checkbox m-checkbox--light">
											<input type="checkbox" name="agree">
											Tôi đồng ý với <a id="getTerms" href="#" class="m-link m-link--focus">các thoả thuận và điều khoản</a>.
											<span></span>
										</label>
										<span class="m-form__help"></span>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn">
										Đăng ký
									</button>
									&nbsp;&nbsp;
									<button id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn">
										Huỷ
									</button>
								</div>
							</form>
						</div>
						<div class="m-login__forget-password">
							<div class="m-login__head">
								<h3 class="m-login__title">
									Quên mật khẩu ?
								</h3>
								<div class="m-login__desc">
									Vui lòng nhập email mà bạn đang sử dụng dịch vụ.
								</div>
							</div>
							<form class="m-login__form m-form" action="">
		  						@csrf
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="{{ old('email') }}" name="email" id="m_email" autocomplete="off">
								</div>
								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
										Gửi yêu cầu
									</button>
									&nbsp;&nbsp;
									<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn">
										Huỷ
									</button>
								</div>
							</form>
						</div>
						<div class="m-login__account">
							<span class="m-login__account-msg">
								Chưa có tài khoản ?
							</span>
							&nbsp;&nbsp;
							<a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
								Đăng ký
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalTerms" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="text-center modal-title" id="modalTermsTitle">Thoả thuận và Điều khoản</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="terms" class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="350">
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Đóng</button>
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
		<script src="{{ asset('js/openpgp.js') }}" type="text/javascript"></script>
		<script src="{{ asset('vendors/base/pwstrength-bootstrap.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/validation_vi.js') }}" type="text/javascript"></script>
		<script src="{{ asset('snippets/pages/user/login.js') }}" type="text/javascript"></script>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
