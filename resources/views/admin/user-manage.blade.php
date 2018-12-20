@extends('layouts.master')
@section('content')
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Quản lý người dùng
            </h3>
            
        </div>
    </div>
</div>
<div class="m-content content-user">
    @include('admin.content-user-manage')
</div>

<!-- BEGIN: Edit form -->
<form id="edit-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="editFormTitle">Chỉnh sửa người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="editform-row" class="row justify-content-center align-items-center">
                        <div id="editform-box" class="col-md-12">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label for="name" class="text-info">Tên đăng nhập</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="form-group selection">
                                <label for="status" class="text-info">Trạng thái hoạt động</label>
                                <select id= "status" name="status" class="form-control">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                </select>
                            </div>
                            <div class="form-group selection">
                                <label for="role" class="text-info">Vai trò</label>
                                <select id = "role" name="role" class="form-control">
                                    <option value="5bf9dea0-d75c-11e8-965c-95bc72799a6b">Người dùng</option>
                                    <option value="5bed2760-d75c-11e8-8098-a930bf45516a">Quản trị viên</option>
                                </select>
                            </div>
                            
                           
                            <div class="alert m-alert m-alert--default" role="alert">
                                <i>Cập nhật cuối: </i><span id="last_updated"></span>												
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
@endsection

@section('pageSnippets')
<script>
    function editUser(id, name, email, status, role)
    {
        $('#editForm input[name=id]').val(id);
        $('#editForm input[name=name]').val(name);
        $('#editForm input[name=email]').val(email);
        // var status_active = "Hoạt động"
        // if(status == 0)
            // status_active = "Không hoạt động"='

        $( "#status" ).val(status);
        $( "#role" ).val(role);
        
        // var role_user = "Người dùng"
        // if(role == '5bed2760-d75c-11e8-8098-a930bf45516a')
        //     role_user = "Quản trị viên"
        // $( "#role option:selected" ).text(role_user);
        // // $('#status').val(staus);
        // // $('#role').val(role);

    }
    $(document).ready(function(){
        $('#editSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.ajaxSubmit({
                url: '/admin/editUser',
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
                    swal("Có lỗi xảy ra", "", status);
                    console.log(response.mesage);
                }
            })
        });
    });
</script>
@endsection