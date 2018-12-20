@extends('layouts.master')
@section('content')
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Quản lý nhóm
            </h3>
            
        </div>
    </div>
</div>
<div class="m-content content-user">
    @include('admin.content-group-manage')
</div>

<!--BEGIN: Delete group form -->
<form id="delete-user-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="deleteGroupForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="idUser">
                <input type="hidden" name="idGroup">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Xóa nhóm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn xóa nhóm này không ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="delUserSubmit" class="btn btn-primary" >Xóa</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Delete group form -->
@endsection

@section('pageSnippets')
<script>
    function delGroup(id)
    {
        $('deleteGroupForm input[name=id]').val(id);
    }
</script>
@endsection