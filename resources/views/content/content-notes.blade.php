@if(count($notes))
<div class="row">
	<div class="col-xl-12">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr align="center">
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Cập nhật cuối</th>
                    <th style="width:100px;"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($notes->sortByDesc('updated_at') as $note)
                <tr class="odd">
                    <td>{{$note->title}}</td>
                    <td style="word-wrap: break-word;">{{$note->content}}</td>
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
                                <i class="far fa-share-square"></i>
                            </span>
                            <span onclick="edit('{{$note->id}}','{{$note->title}}','{{$note->content}}')" href="#editForm" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-edit"></i>
                            </span>
                            <span onclick="del('{{$note->id}}')" href="#deleteForm" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-trash-alt"></i>
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
    <p align="center">Background báo empty state màu xám.</p>
@endif