<div class="userManageContent">
    <div class="m-portlet__body content-body">
        <div class="group-section">
            <div class="m-section__content">
                <table class="table m-table m-table--head-bg-brand">
                    <thead>
                        <tr style="text-align:center">
                            <th> Tên người dùng </th>
                            <th> Địa chỉ email </th>
                            <th> Trạng thái hoạt động </th>
                            <th> Vai trò </th>
                            <th> Chỉnh sửa </th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($users as $user) 
                        <tr style="text-align:center">
                            <td> {{$user->name}} </td>
                            <td> {{$user->email}} </td>
                            <td> 
                                @if($user->active == 1)
                                    Hoạt động
                                @else
                                    Không hoạt động
                                @endif
                            </td>
                            <td> 
                                @if($user->role_id == '5bf9dea0-d75c-11e8-965c-95bc72799a6b') 
                                    Người dùng
                                @elseif ($user->role_id == '5bed2760-d75c-11e8-8098-a930bf45516a')
                                    Quản trị viên
                                @endif
                            </td>
                            <td> 
                                <a onclick = "editUser('{{$user->id}}','{{$user->name}}','{{$user->email}}','{{$user->active}}','{{$user->role_id}}')" href="#editForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">  
                                    <i class="m-nav__link-icon flaticon-edit"></i>
                                </a>
                            </td>

                        </tr>
                        
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>