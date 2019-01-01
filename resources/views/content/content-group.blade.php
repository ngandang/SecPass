@if(count($groups))
<div class="row">
    @foreach($groups->sortBy('name') as $group)
    <div class="col-lg-3">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--head-sm m-portlet--bordered">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="la la-group"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                        </h5>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item" data-container="body" data-toggle="m-popover" data-placement="top" data-content="Vào nhóm này" data-original-title="" title="">
                            <a href="group/{{$group->id}}" class="m-portlet__nav-link m-portlet__nav-link--icon open-group">
                                <i class="la la-external-link"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="text-container">
                    <h5 class="text-overflow">{{$group->name}}</h5>
                </div>
                <div class="text-container">
                    <p class="text-overflow text-muted">{{ count(App\GroupUser::where('group_id', $group->id)->get()) }} thành viên</p>
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
        <h3><small class="text-muted">Hiện bạn không tham gia nhóm nào...</small></h3>
    </div>
@endif
