@if(count($files))
<div class ="container-fluid">
    <div class="row">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>Tên</th>
                    <th>Định Dạng</th>
                    <th>Kích Thước</th>
                    <th>Cập nhật cuối</th>
                    <th style="width:180px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($files as $file)
                <tr class="{{($loop->iteration % 2 != 0) ? 'odd' : 'even'}} gradeX" align="center">
                    <td>{{$file['name']}}</td>
                    <td>{{$file['extension']}}</td>
                    <td>{{$file['size']}}Byte</td>
                    <td>{{$file['lastModified']}} </td>
                    <td>                            
                        <div onclick="share('{{ $file['name'].'.'.$file['extension'] }}')" href = "#shareForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-sm">
                            <i class="flaticon-share"></i>
                        </div>
                        <div onclick="download('{{ $file['name'].'.'.$file['extension'] }}')" href="#downloadForm" class="btn btn-download">
                            <i class="flaticon-download"></i>
                        </div>
                        
                        <div onclick="del('{{ $file['name'].'.'.$file['extension'] }}')" href = "#deleteForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-sm">
                            <i class="flaticon-cancel"></i>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
    <div class="text-center">
        <img src="{{ asset('default/media/img/misc/emptystate.png') }}">
        <h3><small class="text-muted">Hiện không có tài liệu nào...</small></h3>
    </div>
@endif
