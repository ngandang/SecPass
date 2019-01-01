<div class="tab-pane active" id="group-account">
    @if(count($accounts))
    <div class="header">
        <button type="button" class="btn btn-primary move-accounts">
            Chuyển đến kho lưu trữ
        </button>
    </div>
    <form class="m-form m-form--fit m-form--label-align-right">
        <div class="m-portlet__body">
            <div class="group-section">
                <table class="table m-table m-table--head-bg-brand">
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
                            <input name="id" type="hidden" value="{{ $account->share()->first()->id }}">
                            <td> {{ $account->name }} </td>
                            <td> {{ $account->username }}</td>
                            <td> {{ $account->uri }} </td>
                            <td> {{ $account->share()->first()->sharedbyuser()->first()->email }} </td>
                            <td> {{ $account->share()->first()->comment }} </td>
                            <td> {{ $account->created_at }}</td>
                            <td width="150px"> 
                                <ul class="m-nav m-nav--inline">
                                    <li class="m-nav__item" data-toggle="m-tooltip" data-placement="left" title="" data-original-title="Chuyển đến kho lưu trữ">
                                        <a class="m-nav__link" href="javascript:;">
                                            <i class="m-nav__link-icon fa fa-check"></i>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a class="m-nav__link" href="#deleteAccountForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn account-delete">
                                            <i class="m-nav__link-icon fa fa-remove" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Từ chối nhận"></i>
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
        <button type="button" class="btn btn-primary move-notes">
            Chuyển đến kho lưu trữ
        </button>
    </div>
    <form class="m-form m-form--fit m-form--label-align-right">
        <div class="m-portlet__body">
            <div class="group-section">
            <table class="table m-table m-table--head-bg-brand">
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
                            <input name="id" type="hidden" value="{{ $note->share()->first()->id }}">
                            <td> {{ $note->name }} </td>
                            <td> {{ $note->share()->first()->sharedbyuser()->first()->email }} </td>
                            <td> {{ $note->share()->first()->comment }} </td>
                            <td> {{ $note->created_at }}</td>
                            <td width="150px"> 
                                <ul class="m-nav m-nav--inline">
                                    <li class="m-nav__item" data-toggle="m-tooltip" data-placement="left" title="" data-original-title="Chuyển đến kho lưu trữ">
                                        <a class="m-nav__link" href="javascript:;">
                                            <i class="m-nav__link-icon fa fa-check"></i>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a class="m-nav__link" href="#deleteNoteForm" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn note-delete">
                                            <i class="m-nav__link-icon fa fa-remove" data-toggle="m-tooltip" data-placement="right" title="" data-original-title="Từ chối nhận"></i>
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