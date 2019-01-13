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
        @if($admin)
		<div class="">
            <a onclick="editGroup('{{$group->id}}','{{$group->name}}')" href="#editGroupForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <button class="btn btn-primary">Chỉnh sửa</button>
            </a>
        </div>
        &nbsp;&nbsp;
		<div class="">
            <a id="deleteGroup" href="#deleteGroupForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <button class="btn btn-danger">Xoá nhóm</button>
            </a>
        </div>              
        @endif
    </div>
</div>

<div class="m-content">    
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
                <form class="m-form  m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="m-section">
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
                <form class="m-form m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="m-section">
                            @include('content.content-notes')
                        </div>
                    </div>
                </form>                
            </div>
            <div class="tab-pane" id="group-user">
                <div class="header">
                    <!--begin: Search Form -->
                    <div class="row align-items-right">
                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-12">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="Tìm kiếm nhanh..." id="userSearch">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="la la-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                        </div>
                    </div>
                    <!--end: Search Form -->  
                </div>
                <div class="m-form m-form--label-align-right">
                    <div class="m-portlet__body">
                        <div class="m-section">
                            @include('content.content-group-user')
                        </div>
                    </div>
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
<!-- BEGIN: Account scripts -->
<script src="{{ asset('app/js/accounts.js') }}"></script>
<!-- END: Account scripts -->
 <!-- BEGIN: Note scripts -->
 <script src="{{ asset('app/js/notes.js') }}"></script>
<!-- END Note scripts -->

<script>

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
        document.dispatchEvent(new CustomEvent('letgetGroupPGPEvent', { detail: $("input[name=group_id").val() }));

        var users_datatable_options = {
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#userSearch'),
            },
            columns: [
                {
                field: 'Tên người dùng',
                type: 'text',
                textAlign: 'center',
                sortable: 'asc',
                width: 150,
                },
                {
                field: 'Email',
                type: 'text',
                textAlign: 'center',
                width: 200,
                },
                {
                field: 'Vai trò',
                type: 'text',
                textAlign: 'center',
                width: 150,
                },
                {
                field: 'Ngày tham gia',
                textAlign: 'center',
                width: 200,
                },
                {
                field: '',
                textAlign: 'center',
                },
            ],
            pagination: false,
        };

        users_datatable = $('.m-datatable').mDatatable(users_datatable_options);


        var group_id = $("input[name=group_id]").val();
        $("form").append('<input name="group_id" type="hidden" value="'+ group_id +'" />');        

        $('#editGroupForm input[name=email]').keypress(function(e) {            
            if(e.which == 13){
                e.preventDefault();
                $("#addUser").click();
            }
        });

        $('#addUser').click(function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            form.find("input[name=email]").css('border-color','');
            email =  {
                'email' : $('#editGroupForm input[name=email]').val()
            };
            $.ajax({
                url: '/group/checkUser',
                type: 'POST',
                data: email,
                success: function(response, status, xhr, $form) {
                    var email = form.find("input[name=email]").val();
                   
                    var list = $('#users');
                    var entry = $('<li>');
                    var span = $('<span>');
                    span.text(email);
                    var button = $('<a href="javascript:;" class="m-link del-email">&nbsp;&nbsp;Xoá</a>');

                    list.append(entry);
                    entry.append(span);
                    entry.append(button);
                    
                    console.log(response.message);
                    $('#editGroupForm input[name=email]').val("");
                },
                error: function(response, status, xhr, $form) {
                    // btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal(response.responseJSON.message, "", status);
                    console.log(response);
                }
            });
        });

        $(document).on("click",'.del-email', function() {
            $(this).closest('li').remove();
        });

        $('#editGroupSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            if (!form.valid()) {
                return;
            }
            
            myArray = new Array();
            cnt = 0;
            $("#users li span").each(function(){
                myArray[cnt] = $(this).text();
            cnt++;
            });
            var jsonString = JSON.stringify(myArray);

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: '/group/editGroup',
                type: 'POST',
                data: {li_variable: jsonString},
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    swal({
                        position: 'center',
                        type: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(result){$('#editGroupForm').modal('hide');});

                    $('#group-user .m-section').html(response.view);
                    users_datatable = $('.m-datatable').mDatatable(users_datatable_options);

                    $("#users li").remove();
                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    swal("", response.responseJSON.message, "error");
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
                    // Xoá group PGP trong addon
                    var group_id = $("#deleteGroupForm input[name=id]").val();
                    document.dispatchEvent(new CustomEvent('removeGroupPGPEvent', {detail: group_id}));

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
                    swal("", response.responseJSON.message, "error");
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

                    $('#group-user .m-section').html(response.view);
                    users_datatable = $('.m-datatable').mDatatable(users_datatable_options);

                    form.clearForm();
	                form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("", response.responseJSON.message, "error");
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

                    $('#group-user .m-section').html(response.view);
                    users_datatable = $('.m-datatable').mDatatable(users_datatable_options);
                    
                    form.clearForm();
	                // form.validate().resetForm();
                },
                error: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("", response.responseJSON.message, "error");
                    console.log(response);
                }
            });
        });
    });
</script>
@endSection