<div class="m-list-search m-list-search--skin-light">
	<div class="m-list-search__results">
		<span class="m-list-search__result-message {{ (count($accounts) || count($notes) || count($groups)) ? 'm--hide': '' }}">
			Không tìm thấy dữ liệu khớp với từ khoá.
		</span>
		@if(count($accounts))
		<span class="m-list-search__result-category m-list-search__result-category--first">
			Tài khoản
		</span>
		@foreach($accounts as $account)
		<a href="#" class="m-list-search__result-item">
			<span class="m-list-search__result-item-icon">
				<i class="flaticon-interface-3 m--font-warning"></i>
			</span>
			<span class="m-list-search__result-item-text">
				{{ $account->name }}
				&nbsp;&nbsp;
				<span class="text-muted">{{ $account->username }}</span>
			</span>
		</a>
		@endforeach
		@endif
		@if(count($notes))
		<span class="m-list-search__result-category">
			Ghi chú bảo mật
		</span>
		@foreach($notes as $note)
		<a href="#" class="m-list-search__result-item">
			<span class="m-list-search__result-item-icon">
				<i class="flaticon-share m--font-success"></i>
			</span>
			<span class="m-list-search__result-item-text">
				{{ $note->title }}
			</span>
		</a>
		@endforeach
		@endif
		@if(count($groups))
		<span class="m-list-search__result-category">
			Nhóm
		</span>
		@foreach($groups as $group)
		<a href="#" class="m-list-search__result-item">
			<span class="m-list-search__result-item-icon">
				<i class="flaticon-lifebuoy m--font-warning"></i>
			</span>
			<span class="m-list-search__result-item-text">
				{{ $group->name }}
			</span>
		</a>
		@endforeach
		@endif
	</div>
</div>