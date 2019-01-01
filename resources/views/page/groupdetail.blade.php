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

<div class="group-content">    
    <input name="group_id" type="hidden" value="{{ $group->id }}">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head">
            <div class="m-portlet__head-tools">
                <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--left m-tabs-line--primary" role="tablist">
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#group-account" role="tab">
                            Tài khoản                            
                        </a>
                    </li>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#group-note" role="tab">
                            Ghi chú bảo mật
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
                    <button type="button" class="btn btn-primary" href="#addAccountForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                        Thêm tài khoản
                    </button>
                </div>
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="group-section">
                            @include('content.content-accounts')
                        </div>
                    </div>
                </form>                
            </div>
            <div class="tab-pane" id="group-note">
                <div class="header">
                    <a href="#addNoteForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                        <button class="btn btn-primary">Thêm ghi chú</button>
                    </a>
                </div>
                <form class="m-form m-form--fit m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="group-section">
                            @include('content.content-notes')
                        </div>
                    </div>
                </form>                
            </div>
            <div class="tab-pane" id="group-user">
                <div class="header">
                    @if($admin)
                    <a onclick="editGroup('{{$group->id}}','{{$group->name}}')" href="#editGroupForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                        <button class="btn btn-primary">Chỉnh sửa</button>
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

@include('layouts.modals.account')
@include('layouts.modals.note')
@include('layouts.modals.groupuser')

@endsection

@section('pageSnippets')
<script>
    function generate() {
        $('#addAccountForm input[name=password]').val(randomPassword());
    }
    function generateEdit(){
        $('#editAccountForm input[name=password]').val(randomPassword());
    }
    function editGroup(id, name)
    {
        $('#editGroupForm input[name=id]').val(id);
        $('#editGroupForm input[name=name]').val(name);
    }
    function del(id, idGroup)
    {
        $('#deleteUserForm input[name=user_id]').val(id);
        $('#deleteUserForm input[name=group_id]').val(idGroup);
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
        $('#deleteGroup').click(function (){
            $("#deleteGroupForm input[name=id]").val($("input[name=group_id]").val());
        });
        
        $('#deleteGroupSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/group/delete',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#deleteGroupForm').modal('hide');});

                    window.location = "/groups";
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("Có lỗi xảy ra", "", status);
                    console.log(response);
                }
            });
        });
        
        $('#deleteUserSubmit').click(function(e){
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
                    swal(response.responseJSON.message, "", status);
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