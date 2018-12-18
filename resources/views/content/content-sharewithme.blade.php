@if(count($assets))
    @if(count($accounts))
    <h4 class="m--font-brand">Tài khoản</h4>
        @include('content.content-accounts')
    @endif
    @if(count($notes))
    <h4 class="m--font-brand">Ghi chú bảo mật</h4>
        @include('content.content-notes')
    @endif
@else
    <div class="text-center">
        <img src="{{ asset('default/media/img/misc/emptystate.png') }}"/>
        <h3><small class="text-muted">Hiện bạn chưa được chia sẻ dữ liệu nào...</small></h3>
    </div>
@endif