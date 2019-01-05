
@if(count($groupUsers))
<!-- <form class="m-form m-form--fit m-form--label-align-right"> -->     
    <div class="m-section__content">
        <!--begin: Search Form -->
        <div class="row align-items-right">
            <div class="col-xl-8 order-2 order-xl-1">
            </div>
            <div class="col-xl-4 order-2 order-xl-1">
                <div class="form-group m-form__group row align-items-center">
                    <div class="col-md-12">
                        <div class="m-input-icon m-input-icon--left">
                            <input type="text" class="form-control m-input m-input--solid" placeholder="Tìm kiếm nhanh..." id="noteSearch">
                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                <span>
                                    <i class="la la-search"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="m-separator m-separator--dashed d-xl-none"></div>
            </div>
        </div>
        <!--end: Search Form -->  
        <!-- <table class="table m-table m-table--head-bg-brand"> -->
        <table class="m-datatable">
            <thead>
                <tr style="text-align:center">
                    <th>#</th>
                    <th> Tên người dùng </th>
                    <th> Địa chỉ email </th>
                    <th> Vai trò </th>
                    <th> Ngày tham gia </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
            @foreach($groupUsers->sortBy('name') as $key=>$user)
                
                <tr style="text-align:center">
                    <td> {{$key}}</td>
                    <td> {{$user->name}} </td>
                    <td> {{$user->email}}</td>
                    <td> 
                    @if($admin)
                        <select class="form-control m-input select-role">
                            <option {{ $user->is_admin == true ? 'selected' : '' }}>
                                Quản trị viên
                            </option>
                            
                            <option {{ $user->is_admin == false ? 'selected' : '' }}>
                                Thành viên
                            </option>                                    
                        </select>
                    @else
                        {{ $user->is_admin == true ? 'Quản trị viên' : 'Thành viên' }}
                    @endif
                    </td>
                    <td> {{$user->created_at}}</td>
                    <td>
                        <input name="user_id" type="hidden" value="{{$user->user_id}}">
                        <input name="is_admin" type="hidden" value="{{$user->is_admin}}">
                        
                        <a onclick="del('{{$user->user_id}}','{{$group->id}}')" href = "#deleteUserForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn">
                            <i class="fa fa-trash-o" ></i>
                        </a>
                    </td>

                </tr>
                
            @endforeach
            </tbody>
        </table>
    </div>
<!-- </form> -->

@else
    <div class="text-center">
        <img src="{{ asset('app/media/images/misc/emptystate.png') }}"/>
        <h3><small class="text-muted">Hiện không có người dùng nào...</small></h3>
    </div>
@endif