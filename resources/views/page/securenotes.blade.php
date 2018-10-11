@extends('layouts.master')
@include('errors.note')
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
                            Ghi chú bảo mật
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="btn-add-account">
            <a class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air" href="#addNote" data-toggle="modal">
                <span>
                    <i class="la la-plus"></i>
                    <span>
                        Thêm ghi chú
                    </span>
                </span>
            </a>
        </div>
        <div class="modal fade" id="addNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                                        <label for="username" class="text-info">Tên ghi chú:</label><br>
                                        <input type="text" name="username" id="username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="note" class="text-info">Nội dung:</label><br>
                                        <input type="text" name="note" id="note" class="form-control">
                                    </div>
                                </form>
                            </div>  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Huỷ</button>
                        <button type="button" class="btn btn-primary pull-right">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN: Content -->
<div class="main-content note">
    <div class="container-fluid">
        <div class="row">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>Tên Ghi Chú</th>
                        <th>Cập nhật cuối</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd" align="center">
                        <td>Node 1</td>
                        <td>today</td>
                        <td>
                            <a href="#"><i class="far fa-edit"></i></a>
                            <a href="#"><i class="far fa-trash-alt"></i></a>
                            <a href="#"><i class="far fa-share-square"></i></a>
                        </td>
                    </tr>
                    <tr align="center">
                        <td>Node 2</td>
                        <td>yesterday</td>
                        <td>
                            <a href="#"><i class="far fa-edit"></i></a>
                            <a href="#"><i class="far fa-trash-alt"></i></a>
                            <a href="#"><i class="far fa-share-square"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>   
        </div>
    </div>
</div>
<!-- END: Content -->

@endsection