<div class ="container-fluid">
        <div class="row">
       
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>Tên</th>
                        <th>Tên Đăng Nhâp</th>
                        <th>URL</th>
                        <th>Mô tả</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $acc)
                    <tr class="odd gradeX" align="center">
                        <td>{{$acc->name}}</td>
                        <td>{{$acc->username}}</td>
                        <td>{{$acc->uri}}</td>
                        <td>{{$acc->description}}</td>
                        <td>
                            
                            <div onclick="share({{$acc->id}})" href = "#shareForm" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-share-square"></i>
                            </div>
                            <div onclick="edit({{$acc->id}},'{{$acc->name}}','{{$acc->username}}','{{$acc->uri}}','{{$acc->password}}','{{$acc->description}}')" href="#editForm" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-edit"></i>
                            </div>
                            <div onclick="del({{$acc->id}})" href = "#deleteForm" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </div>
                        </td>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>