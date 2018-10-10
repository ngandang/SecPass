@extends('layouts.master')
@include('errors.note')

@section('content')
@if(Session::has('thongbao'))
    <div class="alert alert-success">{{Session::get('thongbao')}}</div>
@endif
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
                            <!-- @if(count($errors)>0)
		  						<div class="alert alert-danger">
		  							@foreach($errors->all() as $err)
									  {{$err}}<br>
									@endforeach
								</div>
							@endif -->
                            <div id="addform-row" class="row justify-content-center align-items-center">
                                <div id="addform-box" class="col-md-12">
                                    <div class="form-group">
                                        <label for="url" class="text-info">URL:</label><br>
                                        <input type="text" name="url" id="url" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="user" class="text-info">User:</label><br>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="text-info">Username:</label><br>
                                        <input type="text" name="username" id="username" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="text-info">Password:</label><br>
                                        <input type="text" name="password" id="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="text-info">Mô tả:</label><br>
                                        <input type="text" name="description" id="description" class="form-control">
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                            <button type="submit" id="addSubmit" class="btn btn-primary pull-right" data-dismiss="modal"  >Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- BEGIN: Content -->
<div  id ="contentt" class = "main-content acc">
    <div class ="container-fluid">
        <div class="row">
       
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>Tên</th>
                        <th>Tên Đăng Nhâp</th>
                        <th>URL</th>
                        <th>Mô tả</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $acc)
                    <tr class="odd gradeX" align="center">
                        <td>{{$acc->name}}</td>
                        <td>{{$acc->username}}</td>
                        <td>{{$acc->uri}}</td>
                        <td>{{$acc->description}}</td>
                        <td>
                            
                            <div onclick="share({{$acc->id}})" href = "#shareForm" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-share-square"></i>
                            </div>
                            <div onclick="edit({{$acc->id}},'{{$acc->name}}','{{$acc->username}}','{{$acc->uri}}','{{$acc->password}}','{{$acc->description}}')" href="#editForm" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-edit"></i>
                            </div>
                            <div onclick="del({{$acc->id}})" href = "#deleteForm" data-toggle="modal" class="btn btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </div>
                        </td>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END: Content -->

<!-- BEGIN: Edit -->
        <form id="edit-form" class="form-horizontal" action="edit" enctype="multipart/form-data" method="post">
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
                                        <label for="url" class="text-info">URL:</label><br>
                                        <input type="text" name="urlEdit" id="urlEdit" class="form-control" required>
                                        <input type="hidden" name="idEdit" id="idEdit">
                                    </div>
                                    <div class="form-group">
                                        <label for="user" class="text-info">User:</label><br>
                                        <input type="text" name="nameEdit" id="nameEdit" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="text-info">Username:</label><br>
                                        <input type="text" name="usernameEdit" id="usernameEdit" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="text-info">Password:</label><br>
                                        <input type="text" name="passwordEdit" id="passwordEdit" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="text-info">Mô tả:</label><br>
                                        <input type="text" name="descriptionEdit" id="descriptionEdit" class="form-control" >
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                            <button type="submit" class="btn btn-primary pull-right" >Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
<!-- END: Edit -->

<!--BEGIN: Delete -->
        <form id="delete-form" class="form-horizontal" action="delete" enctype="multipart/form-data" method="get">
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
                            <button type="submit" class="btn btn-primary" >Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

<!-- END: Delete -->

<!--BEGIN: Share -->
        <form id="share-form" class="form-horizontal" action="share" enctype="multipart/form-data" method="get">
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
                            <button type="submit" class="btn btn-primary" data-dismiss="modal">Chia sẻ</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

<!-- END: Share -->
<script>

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 3000);
</script>
@endsection
@section('pageSnippets')
<script>
   $(document).ready(function(){
        $('#addSubmit').click(function(e){
             e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            form.ajaxSubmit({
                url: 'accounts/add',
                type: 'POST',
                data: form.serialize(),
                success: function(response, status, xhr, $form) {
                    // $('.alert').show();xd
                    // $('.alert').html(result.success);
                    // $('tbody').append(data.accounts); 
                    $('#contentt').html(response.view);
                    console.log(response);
                },
                error: function(response, status, xhr, $form) {
                    // $('.alert').show();xd
                    // $('.alert').html(result.success);
                    console.log(response);
                }
            });
        });
    });
</script>

@endsection


