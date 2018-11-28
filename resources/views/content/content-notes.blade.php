@if(count($notes))
<div class="row">
	<div class="col-xl-12">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Cập nhật cuối</th>
                    <th style="width:180px;"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($notes->sortByDesc('updated_at') as $note)
                <tr class="odd" align="center">
                    <td>{{$note->title}}</td>
                    <td style="word-wrap: break-word;">
                        <a onclick="edit('{{$note->id}}','{{$note->title}}')" href="#editForm" data-toggle="modal">
                            Xem
                        </a>
                    </td>
                    <td align="center">
                    @if ($note->updated_at)
                        {{$note->updated_at}}
                    @else
                        {{$note->created_at}}
                    @endif
                    </td>
                    <td>
                        <!-- <div style="width=500px;"> -->
                            <span onclick="share('{{$note->id}}')" href="#shareForm" data-toggle="modal" class="btn btn-sm">
                                <i class="flaticon-share"></i>
                            </span>
                            <span onclick="edit('{{$note->id}}','{{$note->title}}')" href="#editForm" data-toggle="modal" class="btn btn-sm">
                                <i class="flaticon-edit"></i>
                            </span>
                            <span onclick="del('{{$note->id}}')" href="#deleteForm" data-toggle="modal" class="btn btn-sm">
                                <i class="flaticon-cancel"></i>
                            </span>
                        <!-- </div> -->
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@else
    <div align="center">
        <img src="{{ asset('default/media/img/misc/emptystate.png') }}">
        <h3><small class="text-muted">Hiện không có ghi chú nào...</small></h3>
    </div>
@endif