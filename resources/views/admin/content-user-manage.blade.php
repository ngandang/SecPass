<div class="userManageContent">
    <div class="m-portlet__body content-body">
        <div class="group-section">
            <div class="m-section__content">
                <table class="table table-striped m-table" >
                    <thead class="table-title thead-default">
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
                                @if($user->role()->first()['name'] === 'user') 
                                    Người dùng
                                @elseif($user->role()->first()['name'] === 'admin')
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


