@extends('layouts.master')

@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    @include('layouts.includes.subheader')
</div>
<!-- BEGIN: Content -->
<div class="m-content">
    <!-- Hiện các password yếu, quá hạn, lịch sử hoạt động -->
    <div class="row">
        <div class="col-lg-7">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon" data-container="body" data-toggle="m-popover" data-placement="top" data-content="Mật khẩu đã được giải mã" data-original-title="" title="">
                                <!-- <i class="la la-unlock"></i> -->
                                <i class="la la-unlock-alt"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Thống kê tài sản
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-dropdown__toggle">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 16.8px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">
                                                            Tác vụ nhanh
                                                        </span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-user-ok"></i>
                                                            <span class="m-nav__link-text">
                                                                Sao chép tên đăng nhập
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-lock-1"></i>
                                                            <span class="m-nav__link-text">
                                                                Sao chép mật khẩu
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-edit"></i>
                                                            <span class="m-nav__link-text">
                                                                Chỉnh sửa
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">
                                                                Chia sẻ
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                            Xoá tài khoản
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <h5>Tài khoản</h5>
                    <span>20 tài khoản</span>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-5">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon" data-container="body" data-toggle="m-popover" data-placement="top" data-content="Mật khẩu đã được giải mã" data-original-title="" title="">
                                <!-- <i class="la la-unlock"></i> -->
                                <!-- <i class="la la-unlock-alt"></i> -->
                            </span>
                            <h3 class="m-portlet__head-text">
                                Mật khẩu quá hạn khuyên dùng
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-dropdown__toggle">
                                    <i class="la la-ellipsis-h"></i>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 16.8px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">
                                                            Tác vụ nhanh
                                                        </span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-user-ok"></i>
                                                            <span class="m-nav__link-text">
                                                                Sao chép tên đăng nhập
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-lock-1"></i>
                                                            <span class="m-nav__link-text">
                                                                Sao chép mật khẩu
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-edit"></i>
                                                            <span class="m-nav__link-text">
                                                                Chỉnh sửa
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">
                                                                Chia sẻ
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                            Xoá tài khoản
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!-- <h5>Facebook.com</h5>
                    <span>nphicuong</span> -->
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
<!-- END: Content -->

@endsection

@section('pageSnippets')
<script src="{{ asset('app/js/dashboard.js') }}" type="text/javascript"></script>
@endsection
