@if(count($notes))
<div class="row">
    @foreach($notes->sortByDesc('updated_at') as $note)
    <div class="col-lg-4">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet-nolight m-portlet--head-solid-bg m-portlet--head-sm">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="la la-angle-double-down"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                        </h5>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
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
                                                <li class="m-nav__item">
                                                    <a href="javascript:;" onclick="copyContent('{{$note->id}}')" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-lock-1"></i>
                                                        <span class="m-nav__link-text">
                                                            Sao chép nội dung
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a onclick="edit('{{$note->id}}','{{$note->title}}','{{$note->updated_at}}')" href="#editForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="m-nav__link note-edit">
                                                        <i class="m-nav__link-icon flaticon-edit"></i>
                                                        <span class="m-nav__link-text">
                                                            Chỉnh sửa
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a onclick="share('{{$note->id}}')" href="#shareForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                        <span class="m-nav__link-text">
                                                            Chia sẻ
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                <li class="m-nav__item">
                                                    <a onclick="del('{{$note->id}}')" href = "#deleteForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                        Xoá ghi chú
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
                    <h5 class="text-overflow">{{$note->title}}</h5>
                </div>
                <div class="text-container">
                    &nbsp;
                </div>
                <div class="text-container">
                    <i>Cập nhật cuối: </i>&nbsp;{{$note->updated_at}}
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
    @endforeach
</div>
@else
    <div class="text-center">
        <img src="{{ asset('default/media/img/misc/emptystate.png') }}">
        <h3><small class="text-muted">Hiện không có ghi chú nào...</small></h3>
    </div>
@endif