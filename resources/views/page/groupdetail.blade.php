@extends('layouts.master')

@section('content')

<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Nhóm
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
                    <a href="{{ $group->id }}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            {{$group->name}}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="groupcontent">    
    <input name="group_id" type="hidden" value="{{ $group->id }}">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#group-account" role="tab">
                            Danh sách tài khoản                            
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#group-user" role="tab">
                            Danh sách thành viên
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="tab-content">
            <div class="tab-pane active" id="group-account">
                <div class="header">
                    <button type="button" class="btn btn-primary" href="#addForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                        Thêm tài khoản
                    </button>
                </div>
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="group-section">
                            Account
                        </div>
                    </div>
                </form>
                
            </div>
            <div class="tab-pane" id="group-user">
                <div class="header">
                    @if($admin)
                    <a onclick="editGroup('{{$group->id}}','{{$group->name}}')" class="btn btn-primary" href="#editGroupForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                        Chỉnh sửa
                    </a>
                    @endif
                </div>
                <div class="g-content">
                    @include('content.content-group-user')
                </div>
                

            </div>
        </div>
    </div>   
</div> 

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
                                <div class="col-md-5">
                                    <label for="username" class="text-info">Tên đăng nhập</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="password" class="text-info">Mật khẩu</label>
                                    <input id="password-field" type="password" name="password" class="form-control" required>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="col-md-2" style="padding-left:8px;">
                                    <label class="text-info">&nbsp</label>
                                    <button onclick="generate();" type="button" class="btn btn-metal">
                                        <i class="fa fa-magic fa-fw fa-lg"></i>
                                    </button>
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
                    <h5 class="text-center modal-title" id="editFormTitle">Chỉnh sửa tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="editform-row" class="row justify-content-center align-items-center">
                        <div id="editform-box" class="col-md-12">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label for="name" class="text-info">Tên trang</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="url" class="text-info">URL</label>
                                <input type="text" name="url" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="username" class="text-info">Tên đăng nhập</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                <label for="password" class="text-info">Mật khẩu</label>
                                    <input id="password-edit" type="password" name="password" placeholder="Nhấn lấy mật khẩu" class="form-control" required>
                                    <span toggle="#password-edit" class="fa fa-fw fa-eye field-icon toggle-edit"></span>
                                </div>
                                <div class="col-md-2" style="padding-left:8px;">
                                    <label class="text-info">&nbsp</label>
                                    <button onclick="generateEdit();" type="button" class="btn btn-metal">
                                        <i class="fa fa-magic fa-fw fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="text-info">Mô tả</label>
                                <textarea type="text" name="description" class="form-control"></textarea>
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

<!-- BEGIN: Edit Group Form -->
<form id="edit-group-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="editGroupForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chỉnh sửa nhóm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id"> 
                                <label for="name" class="text-info">Tên nhóm</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <label for="email" class="text-info">Thêm email người dùng</label>
                                    <input type="text" name="email" id="email" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="text-info">&nbsp</label>
                                    <button id="addUser" type="button" class="btn btn-primary">
                                        Thêm
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="list" class="text-info">Danh sách người dùng</label>
                                <ul id="users" class="col-lg-8">
                                    
                                </ul>
                            </div>
                        
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary pull-right" id="editGroupSubmit">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Edit Group Form -->

<!--BEGIN: Add user form -->
<form id="add-user-form" class="form-horizontal" action="" enctype="multipart/form-data" method="get">
    {{ csrf_field() }}
    <div class="modal fade" id="addUserForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="idAdd" id="idAdd">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chia sẻ tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user" class="text-info">Chia sẻ với người dùng hoặc nhóm</label><br>
                        <input type="text" name="email" placeholder="Nhập tên hoặc email" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="shareSubmit" class="btn btn-primary" >Chia sẻ</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Add user form -->

<!--BEGIN: Role form -->
<form id="role-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="roleForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="idUser">
                <input type="hidden" name="idGroup">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Thay đổi vai trò</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn thay đổi vai trò người dùng thành
                    <a href="javascript:;" class="role-user m-link"></a> ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="roleSubmit" class="btn btn-primary" >Thay đổi</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Role form -->


<!--BEGIN: Delete user form -->
<form id="delete-user-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="deleteUserForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="idDelete">
                <input type="hidden" name="idGroup">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Xóa tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn xóa tài khoản này không ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="delUserSubmit" class="btn btn-primary" >Xóa</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Delete user form -->




@endsection

@section('pageSnippets')
<script>
    function editGroup(id, name)
    {
        $('#editGroupForm input[name=id]').val(id);
        $('#editGroupForm input[name=name]').val(name);
    }
    function del(id, idGroup)
    {
        $('#deleteUserForm input[name=idDelete]').val(id);
        $('#deleteUserForm input[name=idGroup]').val(idGroup);
    }
    

    $(document).ready(function(){

        $('#addUser').click(function(e){
            e.preventDefault();

            email =  {
                'email' : $('#editGroupForm input[name=email]').val()
            };
            $.ajax({
                url: '/group/checkUser',
                type: 'POST',
                data: email,
                success: function(response, status, xhr, $form) {
                    var email = document.getElementById('email').value;
                   
                    var list = $('#users');
                    var entry = $('<li>');
                    var span = $('<span>');
                    span.text(email);
                    var button = $('<button onclick="delUser()">');
                    button.text('Xóa');
                    button.addClass("btn-del-email");

                    list.append(entry);
                    entry.append(span);
                    entry.append(button);
                    
                    console.log(response.message);
                },
                error: function(response, status, xhr, $form) {
                    // btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("Không tìm thấy người dùng", "", status);
                    console.log(response);
                }
            });
        });
        

        $('#editGroupSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            myArray = new Array();
            cnt = 0;
            $("#users li span").each(function(){
                myArray[cnt] = $(this).text();
            cnt++;
            });
            var jsonString = JSON.stringify(myArray);

            form.ajaxSubmit({
                url: '/group/editGroup',
                type: 'POST',
                data: {li_variable: jsonString},
                success: function(response, status, xhr, $form) {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#editGroupForm').modal('hide');});

                    $('.m-content').html(response.view);
                    $("#users li").remove();
                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    swal("Có lỗi xảy ra", "", status);
                    console.log(response.mesage);
                }
            })
        });
        
        
        
        $('#delUserSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/group/deleteUser',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#deleteUserForm').modal('hide');});

                    $('.g-content').html(response.view);
                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("Có lỗi xảy ra", "", status);
                    console.log(response);
                }
            });
        });
        
        $(document).on("change", ".select-role", function (e){
            e.preventDefault();
            var tr = $(this).closest('tr');
            tr.addClass('selected');
            $('#roleForm input[name=idUser]').val(tr.find("input[name=user_id]").val());
            $('#roleForm input[name=idGroup]').val($('input[name=group_id]').val());
            var role = $(this).val();
            $('.role-user').html(role);
            $('#roleForm').modal('show');
        })

        $("#roleForm").on("hidden.bs.modal", function (e) {
            e.preventDefault();
            var tr = $("tr.selected");
            var is_admin = tr.find("input[name=is_admin]").val();
            if(is_admin==1){
                tr.find('.select-role').val("Quản trị viên");
            }
            else {
                tr.find('.select-role').val("Thành viên");
            }
            tr.removeClass("selected");

        });

        $('#roleSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            var user_role = form.find(".role-user").text();
            var role = 1;
            if(user_role == "Thành viên")
                role = 0;
            data = {
                'role': role,
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/group/changeRole',
                type: 'POST',
                data: data,
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#roleForm').modal('hide');});

                    $('.g-content').html(response.view);
                    form.clearForm();
	                // form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal(response.responseJSON.message,"", status);
                    console.log(response);
                }
            });
        });
    });
</script>
@endSection