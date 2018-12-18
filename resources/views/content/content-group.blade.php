@if(count($groups))
<div class="row">
    @foreach($groups->sortByDesc('updated_at') as $group)
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
                <!-- "detail, ,['id'=>$group->id]"  -->
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item" data-container="body" data-toggle="m-popover" data-placement="top" data-content="Mở tab mới đến trang này" data-original-title="" title="">
                            <a href="group/{{$group->id}}" class="m-portlet__nav-link m-portlet__nav-link--icon">
                                <i class="la la-external-link"></i>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                            <a href="javascript:;" class="m-portlet__nav-link m-portlet__nav-link--icon m-dropdown__toggle">
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
                                                
                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                <li class="m-nav__item">
                                                    
                                                </li>
                                                <li class="m-nav__item">
                                                    <a onclick="del('{{$group->id}}')" href = "#deleteForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                        Xoá nhóm
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
                    <h5 class="text-overflow">{{$group->name}}</h5>
                </div>
                
            </div>
        </div>
        <!--end::Portlet-->
    </div>
    @endforeach
</div>
@else
    <div class="text-center">
        <img src="{{ asset('default/media/img/misc/emptystate.png') }}"/>
        <h3><small class="text-muted">Hiện không có tài khoản nào...</small></h3>
    </div>
@endif
