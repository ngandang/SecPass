
@if(count($accounts))
<div class ="container-fluid">
    <div class="row">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>URL</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Mô tả</th>
                    <th>Cập nhật cuối</th>
                    <th style="width:180px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts->sortByDesc('updated_at') as $acc)
                <tr class="{{($loop->iteration % 2 != 0) ? 'odd' : 'even'}} gradeX" align="center">
                    <td>{{$acc->uri}}</td>
                    <td>{{$acc->username}}</td>
                    <td><a href="">Copy</a></td>
                    <td>{{$acc->description}}</td>
                    <td>
                    @if ($acc->updated_at)
                        {{$acc->updated_at}}
                    @else
                        {{$acc->created_at}}
                    @endif
                    </td>
                    <td>                            
                        <div onclick="share('{{$acc->id}}')" href = "#shareForm" data-toggle="modal" class="btn btn-sm">
                            <i class="flaticon-share"></i>
                        </div>
                        <div onclick="edit('{{$acc->id}}','{{$acc->name}}','{{$acc->username}}','{{$acc->uri}}','{{$acc->description}}')" href="#editForm" data-toggle="modal" class="btn btn-sm">
                            <i class="flaticon-edit"></i>
                        </div>
                        <div onclick="del('{{$acc->id}}')" href = "#deleteForm" data-toggle="modal" class="btn btn-sm">
                            <i class="flaticon-cancel"></i>
                        </div>
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
    <p align="center">Background báo empty state màu xám.</p>
@endif
