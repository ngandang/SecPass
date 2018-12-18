<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
	<i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item m-aside-left m-aside-left--skin-dark">
	<!-- BEGIN: Aside Menu -->
	<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark" data-menu-vertical="1" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
		<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
			<li class="m-menu__item {{ (Request::segment(1) == 'dashboard') ? 'm-menu__item--active' : '' }} " aria-haspopup="true" >
				<a  href="/dashboard" class="m-menu__link ">
					<i class="m-menu__link-icon flaticon-dashboard"></i>
					<span class="m-menu__link-title">
						<span class="m-menu__link-wrap">
							<span class="m-menu__link-text">
								Bảng điều khiển
							</span>
							<span class="m-menu__link-badge">
								<span class="m-badge m-badge--danger">
									3
								</span>
							</span>
						</span>
					</span>
				</a>
			</li>
			<li class="m-menu__section">
				<h4 class="m-menu__section-text">
					Kho lưu trữ
				</h4>
				<i class="m-menu__section-icon flaticon-more-v3"></i>
			</li>
			<li class="m-menu__item  m-menu__item--submenu {{ (Request::segment(1) == 'accounts') ? 'm-menu__item--active' : '' }}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="/accounts" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-profile"></i>
					<span class="m-menu__link-text">
						Tài khoản
					</span>
				</a>
			</li>
			<li class="m-menu__item  m-menu__item--submenu {{ (Request::segment(1) == 'securenotes') ? 'm-menu__item--active' : '' }}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="/securenotes" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-interface-1"></i>
					<span class="m-menu__link-text">
						Ghi chú bảo mật
					</span>
				</a>
			</li>
			<li class="m-menu__item  m-menu__item--submenu {{ (Request::segment(1) == 'drive') ? 'm-menu__item--active' : '' }}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="/drive" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-folder-4 "></i>
					<span class="m-menu__link-text">
						Tài liệu lưu trữ
					</span>
				</a>
			</li>
			<li class="m-menu__section">
				<h4 class="m-menu__section-text">
					Chia sẻ
				</h4>
				<i class="m-menu__section-icon flaticon-more-v3"></i>
			</li>
			<li class="m-menu__item  m-menu__item--submenu {{ (Request::segment(1) == 'sharewith') ? 'm-menu__item--active' : '' }}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="/sharewithme" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-share"></i>
					<span class="m-menu__link-text">
						Chia sẻ với tôi
					</span>
				</a>
			</li>
			<li class="m-menu__item  m-menu__item--submenu {{ (Request::segment(1) == 'groups') ? 'm-menu__item--active' : '' }}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="/groups" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-users"></i>
					<span class="m-menu__link-text">
						Các nhóm chia sẻ
					</span>
				</a>
			</li>
			<li class="m-menu__section">
				<h4 class="m-menu__section-text">
					Cài đặt
				</h4>
				<i class="m-menu__section-icon flaticon-more-v3"></i>
			</li>
			<li class="m-menu__item  m-menu__item--submenu {{ (Request::segment(1) == 'credential') ? 'm-menu__item--active' : '' }}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="/credential" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-profile"></i>
					<span class="m-menu__link-text">
						Chữ ký cá nhân
					</span>
				</a>
			</li>
			<li class="m-menu__item  m-menu__item--submenu {{ (Request::segment(1) == 'settings') ? 'm-menu__item--active' : '' }}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
				<a  href="/settings" class="m-menu__link m-menu__toggle">
					<i class="m-menu__link-icon flaticon-interface-3"></i>
					<span class="m-menu__link-text">
						Thiết lập người dùng
					</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- END: Aside Menu -->
</div>