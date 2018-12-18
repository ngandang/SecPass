@if(count($users))
<form class="m-form m-form--fit m-form--label-align-right">
    <div class="m-portlet__body">   
        <div class="group-section">
            <div class="m-section__content">
                <table class="table m-table m-table--head-bg-brand">
                    <thead>
                        <tr style="text-align:center">
                            <th> Tên người dùng </th>
                            <th> Địa chỉ email </th>
                            <th> Vai trò </th>
                            <th> Ngày tham gia </th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        
                        <tr style="text-align:center">
                            <td> {{$user->name}} </td>
                            <td> {{$user->email}}</td>
                            @foreach($groups_users as $temp)
                            @if($user->id == $temp->user_id)
                            <td> 
                                <select onchange="selection('{{$user->id}}','{{$group->id}}','{{$temp->is_admin}}')"  class="form-control m-input selection" id="select">
                                    
                                    <option {{ $temp->is_admin == true ? 'selected="selected"' : '' }}>
                                        Quản trị viên
                                    </option>
                                    
                                    <option {{ $temp->is_admin == false ? 'selected="selected"' : '' }}>
                                    Thành viên
                                    </option>
                                    
                                </select>
                            </td>
                            <td> {{$temp->updated_at}}</td>
                            @endif
                            @endforeach
                            <td> 
                                <a onclick="del('{{$user->id}}','{{$group->id}}')" href = "#deleteForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn">
                                    <i class="fa fa-trash-o" ></i>
                                </a>
                            </td>

                        </tr>
                        
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

@else
    <div class="text-center">
        <img src="{{ asset('default/media/img/misc/emptystate.png') }}">
        <h3><small class="text-muted">Hiện không có người dùng nào...</small></h3>
    </div>
@endif