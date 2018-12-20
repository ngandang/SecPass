<div class="groupManageContent">
    <div class="m-portlet__body content-body">
        <div class="group-section">
            <div class="m-section__content">
                <table class="table m-table m-table--head-bg-brand">
                    <thead>
                        <tr style="text-align:center">
                            <th> Tên nhóm </th>
                            <th> Số thành viên </th>
                            <th> Số tài khoản </th>
                            <th> Thời gian tạo nhóm </th>
                            <th> Thời gian cập nhật gần nhất </th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($groups as $group) 
                        <tr style="text-align:center">
                            <td> {{$group->name}} </td>
                            <td> {{ count($group->GroupUser()->get()) }}</td>
                            <td> {{ count($group->secret()->get()) }}</td>
                            <td> {{$group->created_at}} </td>
                            <td> {{$group->updated_at}} </td>
                            <td> 
                                <a onclick = "delGroup('{{$group->id}}')" href = "#deleteGroupForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn">
                                    <i class="fa fa-trash-o"></i>
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