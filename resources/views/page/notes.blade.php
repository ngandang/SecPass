@extends('layouts.master')

@section('content')

<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Kho lưu trữ
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="#" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Ghi chú bảo mật
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="btn-add-note">
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addForm" data-toggle="modal">
                <span>
                    <i class="la la-plus"></i>
                    <span>
                        Thêm ghi chú
                    </span>
                </span>
            </a>
        </div>
    </div>
</div>
 
<!-- BEGIN: Content -->
<div class="m-content">
    @include('content.content-notes')
</div>
<!-- END: Content -->

<!-- BEGIN: Add Form -->
<form id="add-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Ghi chú bảo mật mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <form id="add-form" class="form" action="" method="post">                                        
                                <div class="form-group">
                                    <label for="tilte" class="text-info">Tiêu đề:</label><br>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="note" class="text-info">Nội dung:</label><br>
                                    <textarea type="text" name="note" class="form-control"></textarea>
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="addSubmit" class="btn btn-primary pull-right">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Add Form -->

<!-- BEGIN: Edit Form -->
        <form id="edit-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
            <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                {{ csrf_field() }}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="text-center modal-title" id="addFormTitle">Ghi chú bảo mật mới</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="addform-row" class="row justify-content-center align-items-center">
                                <div id="addform-box" class="col-md-12">
                                    <form id="add-form" class="form" action="" method="post">
                                        <input type="hidden" name="id" id="idEdit">                                     
                                        <div class="form-group">
                                            <label for="title" class="text-info">Tiêu đề:</label><br>
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="note" class="text-info">Nội dung:</label><br>
                                            <input type="text" name="note" id="note" class="form-control">
                                        </div>
                                    </form>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                            <button type="submit" id="editSubmit" class="btn btn-primary pull-right">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!-- END: Edit Form -->

<!-- BEGIN: Delete Form -->
<form id="delete-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="deleteForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="id" id="idDelete">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Xóa tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn xóa tài khoản không???
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="delSubmit" class="btn btn-primary" >Xóa</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Delete Form -->
@endsection

@section('pageSnippets')
<!-- BEGIN: Page Scripts -->

<script>


    function edit(id, title, note){
        $('#editForm input[name=id]').val(id);
        $('#editForm input[name=title]').val(title);
        $('#editForm input[name=note]').val(note);
    }
    
    function del(id){
        $('#deleteForm input[name=id]').val(id);
    }
    
    function share(id)
    {
        $('#shareForm input[name=id]').val(id);
    }

    $(document).ready(function(){

        $('#addSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            form.ajaxSubmit({
                url: 'securenote/add',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#addForm').modal('hide');});

                    $('.m-content').html(response.view);
                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    swal("", response.serialize(), "error");
                }
            });
        });

        $('#editSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            form.ajaxSubmit({
                url: 'securenote/edit',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#editForm').modal('hide');});

                    $('.m-content').html(response.view);
                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    swal("", response.serialize(), "error");
                }
            });
        });

        $('#delSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            form.ajaxSubmit({
                url: 'securenote/delete',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#deleteForm').modal('hide');});

                    $('.m-content').html(response.view);
                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    swal("", response.serialize(), "error");
                }
            });
        });
    });
</script>

<!-- END: Page Scripts -->
@endsection
