@extends('layouts.master')

@section('content')
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Kho lưu trữ
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
                            Thông tin cá nhân
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="icon">
			<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
				<a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
					<i class="la la-plus m--hide"></i>
					<i class="la la-ellipsis-h"></i>
				</a>
				<div class="m-dropdown__wrapper">
					<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;"></span>
					<div class="m-dropdown__inner">
						<div class="m-dropdown__body">
							<div class="m-dropdown__content">
								<ul class="m-nav">
									<li class="m-nav__section m-nav__section--first m--hide">
										<span class="m-nav__section-text">
											Tác vụ nhanh
										</span>
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-share"></i>
											<span class="m-nav__link-text">
												Hoạt động
											</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-chat-1"></i>
											<span class="m-nav__link-text">
												Thông báo
											</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-lifebuoy"></i>
											<span class="m-nav__link-text">
												Hỗ trợ
											</span>
										</a>
									</li>
									<li class="m-nav__separator m-nav__separator--fit"></li>
									<li class="m-nav__item">
										<a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
											Gửi đi
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
 
 <!-- BEGIN: Content -->
<div class="m-content">
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="m-portlet m-portlet--full-height  ">
                <div class="m-portlet__body">
                    <div class="m-card-profile">
                        <div class="m-card-profile__title m--hide">
                            Thông tin cá nhân
                        </div>
                        <div class="m-card-profile__pic p-picture">
                            <div class="m-card-profile__pic-wrapper">
                                <img class="profile-pic" src="{{ url('storage/avatars/' . $user->profile->avatar) }}" alt=""/>
                            </div>
                            <div class="p-image">
                                <i class="fa fa-camera upload-button"></i>
                                <input class="file-upload" type="file" accept="image/*"/>
                            </div>
                        </div>

                        <!-- <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						    <div class="modal-dialog">
						        <div class="modal-content">
							        <div class="modal-header">
							            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							            <h4 class="modal-title" id="myModalLabel">
							  	        Edit Photo
                                        </h4>
							        </div>
                                    <div class="modal-body">
                                        <div id="upload-demo" class="center-block"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
                                    </div>
						        </div>
						    </div>
						</div> -->
                        


                        <div class="m-card-profile__details">
                            <span class="m-card-profile__name">
                                {{ Auth::user()->name }}
                            </span>
                            <a href="" class="m-card-profile__email m-link">
                                {{ Auth::user()->email }}
                            </a>
                        </div>
                    </div>
                    <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                        <li class="m-nav__separator m-nav__separator--fit"></li>
                        <li class="m-nav__section m--hide">
                            <span class="m-nav__section-text">
                                Section
                            </span>
                        </li>
                        <li class="m-nav__item">
                            <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-time-3"></i>
                                <span class="m-nav__link-text">
                                    Hoạt động
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                <span class="m-nav__link-text">
                                    Thông báo
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                <span class="m-nav__link-text">
                                    Hỗ trợ
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="m-portlet__body-separator"></div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8">
            <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link {{ (Request::segment(1) == 'profile') ? 'active' : '' }}" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                    <i class="flaticon-share m--hide"></i>
                                    Cập nhật thông tin
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link {{ (Request::segment(1) == 'credential') ? 'active' : '' }}" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                    Chữ ký cá nhân
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link {{ (Request::segment(1) == 'settings') ? 'active' : '' }}" data-toggle="tab" href="#m_user_settings_tab_3" role="tab">
                                    Thiết lập
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <div class="tab-content">
                    <div class="tab-pane {{ (Request::segment(1) == 'profile') ? 'active' : '' }}" id="m_user_profile_tab_1">
                        <form class="m-form m-form--fit m-form--label-align-right">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10 m--hide">
                                    <div class="alert m-alert m-alert--default" role="alert">
                                        <!-- TODO: Hiện alert nếu user cần thêm thông tin nào đó, ví dụ như số điện thoại, báo chưa xác thực -->
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__section">
                                            Thông tin cá nhân
                                        </h3>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Tên hiển thị
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Tên
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ $user->profile->first_name }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Họ
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ $user->profile->last_name }}">
                                    </div>
                                </div>
                                <!-- <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Công ty
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="Keenthemes">
                                        <span class="m-form__help">
                                            Trợ giúp ghi ở đây.
                                        </span>
                                    </div>
                                </div> -->
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Giới tính
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ @$user->profile->gender }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Ngày sinh
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ @$user->profile->date_of_birth }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Số điện thoại
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ @$user->profile->phone }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Địa chỉ
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ @$user->profile->address }}">
                                    </div>
                                </div>
                                <!-- <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__section">
                                            Liên kết mạng xã hội
                                        </h3>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Linkedin
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="www.linkedin.com/Mark.Andre">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Facebook
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="www.facebook.com/Mark.Andre">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Twitter
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="www.twitter.com/Mark.Andre">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Instagram
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="www.instagram.com/Mark.Andre">
                                    </div>
                                </div> -->
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-7">
                                            <button id="saveProfileSubmit" type="submit" class="btn btn-primary m-btn m-btn--air m-btn--custom">
                                                Lưu thay đổi
                                            </button>
                                            &nbsp;&nbsp;
                                            <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                Huỷ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane {{ (Request::segment(1) == 'credential') ? 'active' : '' }}" id="m_user_profile_tab_2">
                        <form class="m-form m-form--fit m-form--label-align-left">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10">
                                    <div class="alert m-alert m-alert--outline alert-danger" role="alert">
                                        Chúng tôi chỉ lưu trữ khoá công khai của bạn tại máy chủ. <br>Khoá riêng tư được lưu trong Tiện ích SecPASS trên thiết bị của bạn. Bạn cần sao lưu và bảo đảm an toàn thông tin cho cặp khoá này.
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__section">
                                            Thông tin chữ ký điện tử
                                        </h3>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-1"></div>
                                    <label for="example-text-input" class="col-11">
                                        Khoá riêng tư
                                    </label>
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        <textarea name="privKey" rows="10" class="form-control" placeholder="Đang đọc dữ liệu..."></textarea>
                                        <span class="m-form__help">
                                            Khoá riêng tư hiện đang được bảo vệ với mật khẩu của bạn.
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        <div class="alert m-alert m-alert--outline alert-brand" role="alert">
                                            Trong trường hợp bạn mong muốn sao lưu an toàn khoá riêng tư này ngay trên máy chủ SecPASS, vui lòng nhấn nút <b>Sao lưu - Đồng bộ</b> bên dưới.
                                        </div>
                                        <button id="syncBtn" class="btn btn-brand m-btn m-btn--air">Sao lưu lên máy chủ</button>
                                        &nbsp;&nbsp;
                                        <button id="unsyncBtn" class="btn btn-metal" data-toggle="m-popover" data-placement="right" data-content="Xoá khoá riêng tư khỏi dữ liệu máy chủ SecPASS" {{ (( $user->PGPkey->where('type','5')->count() == 0 ) ? 'disabled' : '' ) }}>Huỷ khoá</button>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-1"></div>
                                    <label for="example-text-input" class="col-11">
                                        Khoá công khai
                                    </label>
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        <textarea rows="10" class="form-control">{{ $user->PGPkey->where('type','6')->first()->armored_key }}</textarea>
                                    </div>
                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-3x"></div>
                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__section">
                                            Chữ ký điện tử được cấp
                                            <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">
                                                Đang phát triển
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        <label class="custom-file">
                                            <input type="file" id="key_upload" class="custom-file-input">
                                            <span class="custom-file-control form-control"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-1"></div>
                                    <div class="col">
                                        <button type="reset" class="btn btn-metal m-btn m-btn--air">
                                            Đồng bộ lên máy chủ
                                        </button>
                                        <span class="m-form__help">
                                            Nếu bạn sử dụng chữ ký điện tử được cấp từ chính phủ, bạn cũng có thể sử dụng nó cho SecPASS.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-7">
                                            <button id="saveCredentialSubmit" type="submit" class="btn btn-primary m-btn m-btn--air m-btn--custom">
                                                Lưu thay đổi
                                            </button>
                                            &nbsp;&nbsp;
                                            <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                Huỷ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane {{ (Request::segment(1) == 'settings') ? 'active' : '' }}" id="m_user_settings_tab_3">
                        <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="m-portlet__body">
                                <div class="form-group m-form__group m--margin-top-10 m--hide">
                                    <div class="alert m-alert m-alert--default" role="alert">
                                        <!-- TODO: Hiện alert nếu user cần thêm thông tin nào đó, ví dụ như số điện thoại, báo chưa xác thực -->
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-10 ml-auto">
                                        <h3 class="m-form__section">
                                            
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-form__group form-group row">
                                    <label class="col-3 col-form-label">
                                        Success
                                    </label>
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon m-switch--success">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    <label class="col-3 col-form-label">
                                        Warning
                                    </label>
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon m-switch--warning">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="m-form__group form-group row">
                                    <label class="col-3 col-form-label">
                                        Info
                                    </label>
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon m-switch--info">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    <label class="col-3 col-form-label">
                                        Danger
                                    </label>
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon m-switch--danger">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="m-form__group form-group row">
                                    <label class="col-3 col-form-label">
                                        Primary
                                    </label>
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon m-switch--primary">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    <label class="col-3 col-form-label">
                                        Accent
                                    </label>
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon m-switch--accent">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                                <div class="m-form__group form-group row">
                                    <label class="col-3 col-form-label">
                                        Brand
                                    </label>
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon m-switch--brand">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                    <label class="col-3 col-form-label">
                                        Metal
                                    </label>
                                    <div class="col-3">
                                        <span class="m-switch m-switch--icon m-switch--metal">
                                            <label>
                                                <input type="checkbox" checked="checked" name="">
                                                <span></span>
                                            </label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: Content -->

@endsection


<!-- BEGIN: Page Scripts -->
@section('pageSnippets')
<script>
    let privkey = ""
    let pubkey  = ""
    let passphrase = ""

    // Get PGP keys automatically 
    document.addEventListener('getUserPGPEvent', function (event) {
        var pgp_key = JSON.parse(event.detail); // bypass firefox permission error
            privkey = pgp_key.privateKeyArmored;
            pubkey =  pgp_key.publicKeyArmored;
    });
    // document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));

    function askForPass(){
        return new Promise(function(resolve, reject) {
            swal({
                title: 'Nhập mật khẩu',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Giải mã',
                showLoaderOnConfirm: true,
                preConfirm: (input) => resolve(input),
                allowOutsideClick: () => !swal.isLoading()
            });
        });
    }

    $(document).ready(function(){
        document.dispatchEvent(new CustomEvent('letgetUserPGPEvent', {detail: ""}));
        setTimeout(() => {
            $('textarea[name=privKey]').val(privkey);
        }, 500);

        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profile-pic').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('.file-upload').on('change', function()
        {
            readURL(this);
        });
        $('.upload-button').on('click', function() 
        {
            $('.file-upload').click();
        });
        
        $('#syncBtn').click(async function (e){
            e.preventDefault();
            const privKeyObj = (await openpgp.key.readArmored(privkey)).keys[0];
            if (passphrase) {
                console.log("have passphrase");
                await privKeyObj.decrypt(passphrase);
            }
            else {
                console.log("no passphrase");
                let result = await askForPass();
                await privKeyObj.decrypt(result).catch(function (error){
                    swal("Sai mật khẩu, hãy thực hiện lại.","", "error"); // error.message,
                    throw error;
                });
            }

            let pgp_key = {
                'armored_key': privKeyObj.armor(),
                'uid': privKeyObj.users[0].userId.userid,
                'key_id': privKeyObj.keyPacket.keyid.bytes,
                'fingerprint': privKeyObj.keyPacket.fingerprint,
                'type': privKeyObj.keyPacket.tag,
                'expires': privKeyObj.keyPacket.expirationTimeV3,
                'key_created': privKeyObj.keyPacket.created
            };

            $.ajax({
                url: 'credential/sync',
                type: 'POST',
                data: pgp_key,
                success: function(response, status, xhr, $form) {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $("#unsyncBtn").prop('disabled', false);
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.message.serialize(), "error");
                }
            });
        });

        $('#unsyncBtn').click(function (e){
            e.preventDefault();
            $.ajax({
                url: 'credential/unsync',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $(this).prop('disabled', true);
                },
                error: function(response, status, xhr, $form) {
                    console.log(response);
                    swal("", response.message.serialize(), "error");
                }
            });
        });

    });
</script>

<!-- END: Page Scripts -->
@endsection

