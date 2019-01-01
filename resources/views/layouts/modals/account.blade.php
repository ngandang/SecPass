<!-- BEGIN: Add account form -->
<form id="add-account-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="addAccountForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                    <button type="button" class="btn btn-primary pull-right" id="addAccountSubmit">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Add account form -->

<!-- BEGIN: Edit account form -->
<form id="edit-account-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="editAccountForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                    <input id="password-edit" type="password" name="password" placeholder="Nhấn lấy mật khẩu" class="form-control">
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
                                <i>Cập nhật cuối: </i><span class="last_updated"></span>												
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="editAccountSubmit" class="btn btn-primary pull-right" >Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Edit account form -->

<!--BEGIN: Delete account form -->
<form id="delete-account-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="deleteAccountForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="id">
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
                    <button type="button" id="deleteAccountSubmit" class="btn btn-primary" >Xóa</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Delete account form -->


<!--BEGIN: Share account form -->
<form id="share-account-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="shareAccountForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chia sẻ tài khoản</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email" class="text-info">Chia sẻ với người dùng hoặc nhóm</label><br>
                        <input type="text" name="email" placeholder="Nhập tên hoặc email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment" class="text-info">Tin nhắn</label><br>
                        <textarea rows="5" name="comment" placeholder="Gửi lời nhắn đến người nhận" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="button" id="shareAccountSubmit" class="btn btn-primary" >Chia sẻ</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Share account form -->