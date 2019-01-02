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
            </ul>
        </div>
    </div>

    <div class="tab-content">
        <div class="tab-pane active" id="group-account">
            @if(count($accounts))
            <div class="header">
                <!--begin: Search Form -->
                <div class="row align-items-center">
                    <div class="col-xl-3 order-2 order-xl-1">
                    </div>
                    <div class="col-xl-5 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-12">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input m-input--solid" placeholder="Tìm kiếm nhanh..." id="accountSearch">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary move-accounts">
                                    Chuyển đến kho lưu trữ
                                </button>
                            </div>
                        </div>
                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
                <!--end: Search Form -->        
            </div>
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="m-portlet__body">
                    <div class="m-section">
                        <table class="m-datatable">
                            <thead>
                                <tr style="text-align:center">
                                    <th> Tên </th>
                                    <th> Tên đăng nhập </th>
                                    <th> URL </th>
                                    <th> Người gửi </th>
                                    <th> Tin nhắn</th>
                                    <th> Thời gian gửi </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts->sortBy('name') as $account)                                    
                                <tr style="text-align:center">
                                    <td> {{ $account->name }} </td>
                                    <td> {{ $account->username }}</td>
                                    <td> {{ $account->uri }} </td>
                                    <td> {{ $account->share()->first()->sharedbyuser()->first()->email }} </td>
                                    <td> {{ $account->share()->first()->comment }} </td>
                                    <td> {{ $account->created_at }}</td>
                                    <td>
                                        <input name="id" type="hidden" value="{{ $account->share()->first()->id }}">
                                        <ul class="m-nav m-nav--inline">
                                            <li class="m-nav__item" title="Chuyển đến kho lưu trữ">
                                                <a class="m-nav__link asset-move" href="javascript:;">
                                                    <i class="m-nav__link-icon fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a class="m-nav__link account-delete" href="#deleteAccountForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                    <i class="m-nav__link-icon fa fa-remove" title="Từ chối nhận"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>                                    
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>    
            @else
            <div class="text-center">
                <img src="{{ asset('default/media/img/misc/emptystate.png') }}"/>
                <h3><small class="text-muted">Hiện bạn chưa được chia sẻ tài khoản nào...</small></h3>
            </div>
            @endif           
        </div>
        <div class="tab-pane" id="group-note">
            @if(count($notes))
            <div class="header">
                <!--begin: Search Form -->
                <div class="row align-items-center">
                    <div class="col-xl-3 order-2 order-xl-1">
                    </div>
                    <div class="col-xl-5 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-12">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input m-input--solid" placeholder="Tìm kiếm nhanh..." id="noteSearch">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary move-notes">
                                    Chuyển đến kho lưu trữ
                                </button>
                            </div>
                        </div>
                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
                <!--end: Search Form -->        
            </div>
            <form class="m-form m-form--fit m-form--label-align-right">
                <div class="m-portlet__body">
                    <div class="m-section">
                        <table class="m-datatable">
                            <thead>
                                <tr style="text-align:center">
                                    <th> Tiêu đề </th>
                                    <th> Người gửi </th>
                                    <th> Tin nhắn</th>
                                    <th> Thời gian gửi </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($notes->sortBy('title') as $note)                                    
                                <tr style="text-align:center">
                                    <td> {{ $note->name }} </td>
                                    <td> {{ $note->share()->first()->sharedbyuser()->first()->email }} </td>
                                    <td> {{ $note->share()->first()->comment }} </td>
                                    <td> {{ $note->created_at }}</td>
                                    <td>
                                        <input name="id" type="hidden" value="{{ $note->share()->first()->id }}">
                                        <ul class="m-nav m-nav--inline">
                                            <li class="m-nav__item" title="Chuyển đến kho lưu trữ">
                                                <a class="m-nav__link asset-move" href="javascript:;">
                                                    <i class="m-nav__link-icon fa fa-check"></i>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a class="m-nav__link note-delete" href="#deleteNoteForm" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                    <i class="m-nav__link-icon fa fa-remove" title="Từ chối nhận"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>                                    
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            @else
            <div class="text-center">
                <img src="{{ asset('default/media/img/misc/emptystate.png') }}"/>
                <h3><small class="text-muted">Hiện bạn chưa được chia sẻ ghi chú bảo mật nào...</small></h3>
            </div>
            @endif
        </div>
    </div>
</div>  