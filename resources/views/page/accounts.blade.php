@extends('layouts.master')
@include('errors.note')

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
                            Tài khoản
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="btn-add-account">
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addForm" data-toggle="modal">
                <span>
                    <i class="la la-plus"></i>
                    <span>
                        Thêm tài khoản
                    </span>
                </span>
            </a>
        </div>
    </div>
</div>
<!-- BEGIN: Datatable -->
<div class = "m-content"> 
    @include('accounts.index')
</div>
<!-- END: Datatable -->

@endsection

@section('pageSnippets')
<!-- BEGIN: Page Scripts -->
<!-- BEGIN: Add form -->
<form id="add-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Thêm tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none;"></div>

                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="text-info">Tên trang</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="url" class="text-info">URL</label>
                                <input type="text" name="url" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="username" class="text-info">Tên đăng nhập</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="text-info">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="text-info">Mô tả</label>
                                <textarea type="text" name="description" class="form-control"></textarea>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary pull-right" id="addSubmit">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Add form -->

<!-- BEGIN: Edit form -->
<form id="edit-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chỉnh sửa tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="text-info">Tên trang</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <input type="hidden" name="id" id="id" >
                            </div>
                            <div class="form-group">
                                <label for="url" class="text-info">URL</label>
                                <input type="text" name="url" id="url" class="form-control">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="username" class="text-info">Tên đăng nhập</label>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="text-info">Mật khẩu</label>
                                    <input type="password" name="password" id="password" value="nothinghere" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="text-info">Mô tả</label>
                                <textarea type="text" name="description" id="description" class="form-control"></textarea>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="editSubmit" class="btn btn-primary pull-right" >Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Edit form -->

<!--BEGIN: Delete form -->
<form id="delete-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="deleteForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="idDelete" id="idDelete">
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
<!-- END: Delete form -->

<!--BEGIN: Share form -->
<form id="share-form" class="form-horizontal" action="../account/share" enctype="multipart/form-data" method="get">
    {{ csrf_field() }}
    <div class="modal fade" id="shareForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="idShare" id="idShare">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chia sẻ tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user" class="text-info">Chia sẻ với người dùng hoặc nhóm</label><br>
                        <input type="text" name="email" id="email" placeholder="Nhập tên hoặc email" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary" >Chia sẻ</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Share form -->

<script> 
    $(document).ready(function(){
        $('#addSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            form.ajaxSubmit({
                url: 'account/add',
                type: 'POST',
                data: form.serialize(),
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
                url: 'account/edit',
                type: 'POST',
                data: form.serialize(),
                success: function(response, status, xhr, $form) {
                    swal("", response.message, "success");
                    $('#editForm').modal('hide');
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
                url: 'account/delete',
                type: 'POST',
                data: form.serialize(),
                success: function(response, status, xhr, $form) {
                    swal("", response.message, "success");
                    $('#deleteForm').modal('hide');
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
