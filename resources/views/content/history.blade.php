<h3 class="m-menu__heading m-menu__toggle">
	<span class="m-menu__link-text m--font-brand">
		<b>TÀI KHOẢN</b>
	</span>
	<i class="m-menu__ver-arrow la la-angle-right"></i>
</h3>
<ul class="m-menu__inner">
@if(count($accounts))
	@foreach($accounts as $account)
	<li class="m-menu__item quickSearch-account"  data-redirect="true" aria-haspopup="true">
		<a  href="javascript:;" class="m-menu__link ">
			<input type="hidden" name="id" value="{{ $account->id }}">
			<i class="m-menu__link-icon flaticon-profile m--font-brand"></i>
			<span class="m-menu__link-text">
				{{ $account->name }}<br><span class="text-muted"><i>{{ $account->username}}</i></span>
			</span>
			<i class="m-menu__link-bullet m-menu__link-bullet--dot">
				<span></span>
			</i>
			<span class="m-menu__link-text">
				{{ $account->track()->orderBy('id', 'desc')->first()->created_at }}
				<br>
			</span>
		</a>
	</li>
	@endforeach
@else
	<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
		<a  href="javascript:;" class="m-menu__link ">
			<span class="m-menu__link-text text-center">
			Hiện chưa có lịch sử hoạt động.
			</span>
		</a>
	</li>
@endif
</ul>
