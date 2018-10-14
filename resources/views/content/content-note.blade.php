<div class="container-fluid">
        <div class="row">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>Tên Ghi Chú</th>
                        <th>Cập nhật cuối</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($notes->sortByDesc('updated_at') as $note)
                    <tr class="odd" align="center">
                        <td>{{$note->name}}</td>
                        <td>
                        @if ($note->updated_at)
                            {{$note->updated_at}}
                        @else
                            {{$note->created_at}}
                        @endif
                        </td>
                        <td>
                            <div onclick="share('{{$note->id}}')" href = "#shareForm" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-share-square"></i>
                            </div>
                            <div onclick="editNote('{{$note->id}}','{{$note->name}}','{{$note->content}}')" href="#editNote" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-edit"></i>
                            </div>
                            <div onclick="del('{{$note->id}}')" href = "#deleteNote" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
                @endforeach
            </table>   
        </div>
    </div>