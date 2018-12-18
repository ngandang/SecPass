@extends('layouts.master')

@section('content')

<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Chia sẻ
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
                            Các nhóm chia sẻ
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="btn-add-group">
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <span>
                    <i class="la la-plus"></i>
                    <span>
                        Tạo nhóm mới
                    </span>
                </span>
            </a>
        </div>

    </div>
</div>

<!-- BEGIN: Content -->
<div class="m-content">
    @include('content.content-group')
</div>
<!-- END: Content -->
<!-- BEGIN: Add form -->
<form id="add-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Tạo nhóm mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="text-info">Tên nhóm</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <label for="email" class="text-info">Thêm email người dùng</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                    <span class="m-form__help text-muted">
                                        Bạn được mặc định là trưởng nhóm.
                                    </span>
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
                                <ul id="users" class="col-lg-8"></ul>
                            </div>
                        
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary pull-right" id="addSubmit">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!--BEGIN: Delete form -->
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
                    Bạn có chắc chắn xóa tài khoản này không???
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
@endsection

@section('pageSnippets')
<!-- BEGIN: Page Scripts -->
<script src="{{ asset('js/validation_vi.js') }}" type="text/javascript"></script>
<script>

    function del(id){
        $('#deleteForm input[name=id]').val(id);
    }
    // function delUser()
    // {
    //     // $(this).closest('li').remove();
    //     $(this).remove(li);
    // }
    
    $(document).ready(function(){
        $('#addUser').click(function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            form.find("input[name=email]").css('border-color','');
            email =  {
                'email' : $('#addForm input[name=email]').val()
            };
            $.ajax({
                url: 'group/checkUser',
                type: 'POST',
                data: email,
                success: function(response, status, xhr, $form) {
                    var email = document.getElementById('email').value;
                   
                    var list = $('#users');
                    var entry = $('<li>');
                    var span = $('<span>');
                    span.text(email);
                    var button = $('<button id="delUser">');
                    button.text('Xóa');
                    button.addClass(" btn btn-del-email");
                    // button.addId("delUser")

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
        $('#delUser').click(function()
        {
            $('#users').removeAttr('li');
            // $(this).prev('li').remove();
            // $(this).remove();    
            // var btn = $(this);
            // $(this).parent().remove(li);
        });

        $('#addSubmit').click(function(e){
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
            if (!myArray[0]){
                form.find("input[name=email]").css('border-color','#dc3545');
                return;
            }
            var jsonString = JSON.stringify(myArray);
            
            form.ajaxSubmit({
                url: 'group/addGroup',
                type: 'POST',
                data: {li_variable: jsonString},
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
                    swal("Có lỗi xảy ra", "", status);
                    console.log(response.mesage);
                }
            })
        })
        $('#delSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            
            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: 'group/delete',
                type: 'POST',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
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
                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
                    swal("Có lỗi xảy ra", "", status);
                    console.log(response);
                }
            });
        });
    });
</script>


@endsection