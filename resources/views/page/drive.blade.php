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
                            Tài liệu lưu trữ
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="btn-add-account">
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                <span>
                    <i class="la la-plus"></i>
                    <span>
                        Thêm tài liệu
                    </span>
                </span>
            </a>
        </div>
    </div>
</div>
<!-- BEGIN: Content -->
<div class="m-content">
    @include('content.content-drive')
</div>
<!-- END: Content -->
@endsection

@section('pageSnippets')
<!-- BEGIN: Add Form -->
<form id="add-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Thêm tài liệu lưu trữ mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <form id="add-form" class="form" action="" method="post">                                        
                                <div class="form-group">
                                    <!-- <label for="name" class="text-info">Tên:</label><br> -->
                                    <input type="hidden" name="name" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="tilte" class="text-info">Tập Tin:</label>
                                    <div id="drop_zone">Kéo thả tập tin</div>
                                    <input class="file-upload" type="file" id="files" name="files[]" multiple />
                                    <span class="custom-file-control" toggle="#files"></span>
                                    <output id="list"></output>
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

<!--BEGIN: Delete form -->
<form id="delete-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="deleteForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="filename">
                    <h5 class="text-center modal-title" id="addFormTitle">Xóa tài liệu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn xóa tài liệu không???
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
<form id="share-form" class="form-horizontal" action="" enctype="multipart/form-data" method="get">
    {{ csrf_field() }}
    <div class="modal fade" id="shareForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="idShare" id="idShare">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chia sẻ tài liệu</h5>
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
<!-- END: Share form -->

<!-- BEGIN: Download form -->
    <form method="POST" action="drive/download" id="downloadForm">
        {{ csrf_field() }}
        <input type="hidden" name="filename">
    </form>
<!-- END: Download form -->
<script>
    // Check for the various File API support.
    if (window.File && window.FileReader && window.FileList && window.Blob) {
    // Great success! All the File APIs are supported.
    } else {
    alert('The File APIs are not fully supported in this browser.');
    }


    function del(filename){
        $('#deleteForm input[name=filename]').val(filename);
    }
    function download(filename)
    {
        $('#downloadForm input[name=filename]').val(filename);
        $('#downloadForm').submit();
    }

    $(document).ready(function(){
        $('#files').on('change', function(e){
            var files = e.target.files; // FileList object

            // files is a FileList of File objects. List some properties.
            var output = [];
            for (var i = 0, f; f = files[i]; i++) {
            output.push('<li><h5>', escape(f.name), '</h5> (', f.type || 'n/a', ') - ',
                        f.size, ' bytes, cập nhật cuối: ',
                        f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a',
                        '</li>');
            }
            $('#list').html('<ul>' + output.join('') + '</ul>');
        });

        $('#addSubmit').click(function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            
            form.ajaxSubmit({
                url: 'drive/add',
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

        $('#delSubmit').click(function(e){
            e.preventDefault();
            var btn = $(this);            
            var form = $(this).closest('form');
            
            form.ajaxSubmit({ 
                url: 'drive/delete',
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

@endsection