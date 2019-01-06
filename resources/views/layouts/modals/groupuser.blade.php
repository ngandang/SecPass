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
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label class="text-info">&nbsp;</label>
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
                    <button type="submit" class="btn btn-primary pull-right" id="editGroupSubmit">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Edit Group Form -->

<!--BEGIN: Delete Group form -->
<form id="delete-group-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="deleteGroupForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Xóa nhóm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn xóa nhóm này không???
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="deleteGroupSubmit" class="btn btn-primary" >Xóa</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Delete Group form -->

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
                <input type="hidden" name="user_id">
                <input type="hidden" name="group_id">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Xóa người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn xóa người dùng này không ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="deleteUserSubmit" class="btn btn-primary" >Xóa</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Delete user form -->