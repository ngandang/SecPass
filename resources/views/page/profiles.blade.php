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
                                <img class="profile-pic" src="{{ url('storage/avatars/' . $user->profiles->avatar) }}" alt=""/>
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
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                    <i class="flaticon-share m--hide"></i>
                                    Cập nhật thông tin
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                    Chữ ký điện tử
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                    Thiết lập
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="m_user_profile_tab_1">
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
                                        <input class="form-control m-input" type="text" value="{{ $user->profiles->first_name }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Họ
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ $user->profiles->last_name }}">
                                    </div>
                                </div>
                                <!-- <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Công ty
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="Keenthemes">
                                        <span class="m-form__help">
                                            If you want your invoices addressed to a company. Leave blank to use your full name.
                                        </span>
                                    </div>
                                </div> -->
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Giới tính
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ @$user->profiles->gender }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Ngày sinh
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ @$user->profiles->date_of_birth }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Số điện thoại
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ @$user->profiles->phone }}">
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label for="example-text-input" class="col-2 col-form-label">
                                        Địa chỉ
                                    </label>
                                    <div class="col-7">
                                        <input class="form-control m-input" type="text" value="{{ @$user->profiles->address }}">
                                    </div>
                                </div>
                                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
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
													</div>
                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-7">
                                            <button id="saveSubmit" type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
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
                    <div class="tab-pane active" id="m_user_profile_tab_2"></div>
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
    $(document).ready(function(){
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

        
    });
</script>

<!-- END: Page Scripts -->
@endsection

