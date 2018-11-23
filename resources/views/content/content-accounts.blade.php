
@if(count($accounts))
<div class="row">
    @foreach($accounts->sortByDesc('updated_at') as $acc)
    <div class="col-lg-3">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--head-sm">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon" data-container="body" data-toggle="m-popover" data-placement="top" data-content="Mật khẩu chưa được giải mã" data-original-title="" title="">
                            <i class="la la-unlock"></i>
                            <!-- <i class="la la-unlock-alt"></i> -->
                        </span>
                        <h3 class="m-portlet__head-text">
                        </h5>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item" data-container="body" data-toggle="m-popover" data-placement="top" data-content="Mở tab mới đến trang này" data-original-title="" title="">
                            <a href="{{$acc->uri}}" target="_blank" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                <i class="la la-external-link"></i>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                            <a href="javascript:void();" class="m-portlet__nav-link m-portlet__nav-link--icon m-dropdown__toggle">
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
                                                    <a href="javascript:void();" onclick="copyUsername('{{$acc->username}}');" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-user-ok"></i>
                                                        <span class="m-nav__link-text">
                                                            Sao chép tên đăng nhập
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="javascript:void();" onclick="copyPassword('{{$acc->id}}')" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-lock-1"></i>
                                                        <span class="m-nav__link-text">
                                                            Sao chép mật khẩu
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a onclick="edit('{{$acc->id}}','{{$acc->name}}','{{$acc->username}}','{{$acc->uri}}','{{$acc->description}}','{{$acc->updated_at}}')" href="#editForm" data-toggle="modal" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-edit"></i>
                                                        <span class="m-nav__link-text">
                                                            Chỉnh sửa
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a onclick="share('{{$acc->id}}')" href="#shareForm" data-toggle="modal" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                        <span class="m-nav__link-text">
                                                            Chia sẻ
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                <li class="m-nav__item">
                                                    <a onclick="del('{{$acc->id}}')" href = "#deleteForm" data-toggle="modal" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
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
                <div class="text-container">
                    <h5 class="text-overflow">{{$acc->name}}</h5>
                </div>
                <div class="text-container">
                    <a href="javascript:void();" class="m-link text-overflow" onclick="copyUsername('{{$acc->username}}');">{{$acc->username}}</a>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
    @endforeach
</div>
@else
<!-- <div class="row">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr align="center">
                <th>URL</th>
                <th>Username</th>
                <th>Password</th>
                <th>Mô tả</th>
                <th>Cập nhật cuối</th>
                <th style="width:180px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($accounts->sortByDesc('updated_at') as $acc)
            <tr class="{{($loop->iteration % 2 != 0) ? 'odd' : 'even'}} gradeX" align="center">
                
                <td>{{$acc->uri}}</td>
                <td>
                    <a class="copyusername">{{$acc->username}}</a>
                </td>
                <td><a href="javascript:void();" onclick="copyPassword('{{$acc->id}}')">Sao chép</a></td>
                <td>{{$acc->description}}</td>
                <td>
                @if ($acc->updated_at)
                    {{$acc->updated_at}}
                @else
                    {{$acc->created_at}}
                @endif
                </td>
                <td>                            
                    <div onclick="share('{{$acc->id}}')" href = "#shareForm" data-toggle="modal" class="btn btn-sm">
                        <i class="flaticon-share"></i>
                    </div>
                    <div onclick="edit('{{$acc->id}}','{{$acc->name}}','{{$acc->username}}','{{$acc->uri}}','{{$acc->description}}')" href="#editForm" data-toggle="modal" class="btn btn-sm">
                        <i class="flaticon-edit"></i>
                    </div>
                    <div onclick="del('{{$acc->id}}')" href = "#deleteForm" data-toggle="modal" class="btn btn-sm">
                        <i class="flaticon-cancel"></i>
                    </div>
                </td>
            @endforeach
        </tbody>
    </table>
</div> -->
    <p align="center">Background báo empty state màu xám.</p>
@endif
