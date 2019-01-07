@if(count($files))
<div class="m-portlet">
    <form class="m-form m-form--label-align-right">
        <div class="m-portlet__body">
            <div class="m-section">
                <table class="m-datatable">
                    <thead>
                        <tr style="text-align:center">
                            <th>Tên</th>
                            <th>Định dạng</th>
                            <th>Kích thước</th>
                            <th>Cập nhật cuối</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                        <tr>
                            <td>{{$file['name']}}</td>
                            <td>{{$file['extension']}}</td>
                            <td>{{$file['size']}} bytes</td>
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
    </form>
</div>
@else
    <div class="text-center">
        <img src="{{ asset('app/media/images/misc/emptystate.png') }}"/>
        <h3><small class="text-muted">Hiện không có tài liệu nào...</small></h3>
    </div>
@endif
