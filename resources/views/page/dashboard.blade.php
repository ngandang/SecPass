@extends('layouts.master')

@section('content')

@include('layouts.includes.subheader')
<!-- BEGIN: Content -->
<div class="m-content">
    <!-- Hiện các password yếu, quá hạn, lịch sử hoạt động -->
    <div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
        <div class="m-alert__icon m-alert__icon--top">
            <i class="flaticon-exclamation m--font-accent"></i>
        </div>
        <div class="m-alert__text">
            <h5>
                Chào mừng bạn đến với SecPASS !!
            </h5>
            <p>
                <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">
                    Thông báo:
                </span>
                <br>
                Hệ thống 
                <b>
                    SecPASS 
                </b>
                vẫn đang được phát triển. Để tìm hiểu thêm vui lòng liên hệ:
                 <ul>
                    <li>Nguyễn Phi Cường - <a href="mailto:14520112@gm.uit.edu.vn" class="m-link">14520112@gm.uit.edu.vn</a></li>
                    <li>Đặng Thị Ngân - <a href="mailto:14520572@gm.uit.edu.vn" class="m-link">14520572@gm.uit.edu.vn</a></li>
                </ul>
                Xin chân thành cảm ơn.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
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
                            <li class="m-portlet__nav-item" data-container="body" data-toggle="m-popover" data-placement="top" data-content="Cập nhật mới" data-original-title="" title="">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="flaticon-refresh"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-section m-section--last">
                        <div class="m-section__content">
                            <div class="m-list-search">
                                <div class="m-list-search__results">
                                    <span class="m-list-search__result-message m--hide">
                                        Hiện chưa có dữ liệu
                                    </span>
                                    <span class="m-list-search__result-category m-list-search__result-category--first">
                                        Tài khoản
                                    </span>
                                    <a href="/accounts" class="m-list-search__result-item">
                                        <span class="m-list-search__result-item-icon">
                                            <i class="flaticon-profile m--font-warning"></i>
                                        </span>
                                        <span class="m-list-search__result-item-text">
                                            Hiện có <span class="m-link">{{ count($accounts) }}</span> tài khoản
                                        </span>
                                    </a>
                                    <a href="#" class="m-list-search__result-item">
                                        <span class="m-list-search__result-item-icon">
                                            <i class="flaticon-graphic-2 m--font-warning"></i>
                                        </span>
                                        <span class="m-list-search__result-item-text">
                                            Những tài khoản được dùng nhiều <span class="text-muted"><br>Đang phát triển...</span>
                                        </span>
                                    </a>
                                    <span class="m-list-search__result-category">
                                        Ghi chú bảo mật
                                    </span>
                                    <a href="#" class="m-list-search__result-item">
                                        <span class="m-list-search__result-item-icon">
                                            <i class="flaticon-interface-1 m--font-warning"></i>
                                        </span>
                                        <span class="m-list-search__result-item-text">
                                            Hiện có <span class="m-link">{{ count($notes) }}</span> ghi chú
                                        </span>
                                    </a>
                                    <a href="#" class="m-list-search__result-item">
                                        <span class="m-list-search__result-item-icon">
                                            <i class="flaticon-graphic-2 m--font-warning"></i>
                                        </span>
                                        <span class="m-list-search__result-item-text">
                                            Những ghi chú bảo mật được xem nhiều <span class="text-muted"><br>Đang phát triển...</span>
                                        </span>
                                    </a>
                                    <span class="m-list-search__result-category">
                                        Tài liệu
                                    </span>
                                    <a href="#" class="m-list-search__result-item">
                                        <span class="m-list-search__result-item-icon">
                                            <i class="flaticon-folder-4 m--font-warning"></i>
                                        </span>
                                        <span class="m-list-search__result-item-text">
                                            Không gian sử dụng của bạn hiện còn trống 10GB <span class="text-muted"><br>Đang phát triển...</span>
                                        </span>
                                    </a>
                                    <span class="m-list-search__result-category">
                                        Nhóm tham gia
                                    </span>
                                    <a href="#" class="m-list-search__result-item">
                                        <span class="m-list-search__result-item-icon">
                                            <i class="flaticon-users m--font-warning"></i>
                                        </span>
                                        <span class="m-list-search__result-item-text">
                                            Hiện bạn tham gia <span class="m-link">{{ count($groups) }}</span> nhóm chia sẻ
                                        </span>
                                    </a>
                                    <a href="#" class="m-list-search__result-item">
                                        <span class="m-list-search__result-item-icon">
                                            <i class="flaticon-lifebuoy m--font-warning"></i>
                                        </span>
                                        <span class="m-list-search__result-item-text">
                                            Những nhóm có tương tác nhiều <span class="text-muted"><br>Đang phát triển...</span>

                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Section-->


                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-4">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Mật khẩu quá hạn khuyên dùng
                                @if(count($expires))
                                <span class="m-badge m-badge--danger">{{ count($expires) }}</span>
                                @endif
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item" data-container="body" data-toggle="m-popover" data-placement="top" data-content="Cập nhật mới" data-original-title="" title="">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="flaticon-refresh"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    @if(count($expires))
                    <table class="m-datatable">
                        <thead>
                            <tr style="text-align:center">
                                <th> Tài khoản </th>
                                <th> URL </th>
                                <th> Quá hạn </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($expires->sortBy('name') as $account)                                    
                            <tr style="text-align:center">
                                <td> {{ $account->name }} <br><i class="text-muted m--regular-font-size-">{{ $account->username }}</i></td>
                                <td> <a href="{{ $account->uri }}" class="m-link">{{ $account->uri }}</a> </td>
                                <td> {{ (new \Carbon\Carbon($account->expiry_date))->diffForHumans(\Carbon\Carbon::now()) }}</td>
                                <td>
                                    <input name="id" type="hidden" value="{{ $account->id }}">
                                </td>
                            </tr>                                    
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-muted">Chưa có dữ liệu</p>
                    @endif
                </div>
            </div>
            <!--end::Portlet-->
        </div>
        <div class="col-lg-4">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--head-sm">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Tài khoản bị xâm nhập
                                <!-- <span class="m-badge m-badge--danger"></span> -->
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item" data-container="body" data-toggle="m-popover" data-placement="top" data-content="Cập nhật mới" data-original-title="" title="">
                                <a href="" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                    <i class="flaticon-refresh"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <p class="text-muted">Đang phát triển...</p>
                </div>
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
<!-- END: Content -->

@endsection

@section('pageSnippets')
<script>
    $(document).ready(function() {
        var expires_datatable_options = {
            data: {
                saveState: {cookie: false},
            },
            columns: [
                {
                field: 'Tài khoản',
                type: 'text',
                textAlign: 'center',
                sortable: 'asc',
                // width: 150,
                },
                {
                field: 'URL',
                type: 'text',
                textAlign: 'center',
                // width: 200,
                },
                {
                field: 'Quá hạn',
                type: 'text',
                textAlign: 'center',
                // width: 150,
                },
                {
                field: '',
                width: 0,
                }
            ],
            pagination: false,
        };

        expires_datatable = $('.m-datatable').mDatatable(expires_datatable_options);
    });
</script>
@endsection
