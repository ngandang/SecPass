<!-- BEGIN: Add note Form -->
<form id="add-note-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    <div class="modal fade" id="addNoteForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        {{ csrf_field() }}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Ghi chú bảo mật mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addform-row" class="row justify-content-center align-items-center">
                        <div id="addform-box" class="col-md-12">
                            <form id="add-form" class="form" action="" method="post">                                        
                                <div class="form-group">
                                    <label for="tilte" class="text-info">Tiêu đề:</label><br>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="note_content" class="text-info">Nội dung:</label><br>
                                    <textarea rows="10" type="text" name="note_content" class="form-control m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200"></textarea>
                                </div>
                            </form>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="addNoteSubmit" class="btn btn-primary pull-right">Lưu</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Add note Form -->

<!-- BEGIN: Edit note Form -->
        <form id="edit-note-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
            <div class="modal fade" id="editNoteForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                {{ csrf_field() }}
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="text-center modal-title" id="editFormTitle">
                                <!-- <label for="title" class="text-info">Tiêu đề:</label><br> -->
                                <input type="text" name="title" class="form-control note-title" style="font-size:1em">
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="editform-row" class="row justify-content-center align-items-center">
                                <div id="editform-box" class="col-md-12">
                                    <input type="hidden" name="id" id="idEdit">
                                    <div class="form-group get-content">
                                        <label for="note_content" class="text-info">Nội dung:</label>
                                        <button id="getContent" type="button" class="btn btn-metal" data-toggle="m-tooltip" title="Lấy và giải mã nội dung">
                                                <i class="fa fa-lock fa-fw fa-lg"></i>
                                        </button>
                                        <textarea type="text" name="note_content" class="form-control m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200" placeholder="Đã được bảo mật"></textarea>
                                    </div>
                                    <div class="alert m-alert m-alert--default" role="alert">
                                        <i>Cập nhật cuối: </i><span class="last_updated"></span>												
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                            <button type="submit" id="editNoteSubmit" class="btn btn-primary pull-right">Lưu</button>
                        </div>
                    </div>
                </div>
            </div> 
        </form>
<!-- END: Edit note Form -->

<!-- BEGIN: Delete note Form -->
<form id="delete-note-form" class="form-horizontal" action="" enctype="multipart/form-data" method="POST">
    {{ csrf_field() }}
    <div class="modal fade" id="deleteNoteForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Xóa ghi chú bảo mật</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn xóa ghi chú này không???
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                    <button type="submit" id="deleteNoteSubmit" class="btn btn-primary" >Xóa</button>
                </div> 
            </div>
        </div>
    </div>
</form>
<!-- END: Delete note Form -->

<!--BEGIN: Share note form -->
<form id="share-note-form" class="form-horizontal" action="" enctype="multipart/form-data" method="post">
    {{ csrf_field() }}
    <div class="modal fade" id="shareNoteForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <input type="hidden" name="id">
                <div class="modal-header">
                    <h5 class="text-center modal-title" id="addFormTitle">Chia sẻ ghi chú bảo mật</h5>
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
                    <button type="submit" id="shareNoteSubmit" class="btn btn-primary" >Chia sẻ</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END: Share note form -->