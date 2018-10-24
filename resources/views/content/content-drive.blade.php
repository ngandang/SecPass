@if(true)
<div class ="container-fluid">
    <div class="row">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>Tên</th>
                    <th>Loại</th>
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
                        <div onclick="share('{{ $file['name'] }}')" href = "#shareForm" data-toggle="modal" class="btn btn-sm">
                            <i class="flaticon-share"></i>
                        </div>
                        <div onclick="download('{{ $file['name'] }}')" href="#downloadForm" data-toggle="modal" class="btn btn-sm">
                            <i class="flaticon-download"></i>
                        </div>
                        <div onclick="del('{{ $file['name'] }}')" href = "#deleteForm" data-toggle="modal" class="btn btn-sm">
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
    <p align="center">Background báo empty state màu xám.</p>
@endif