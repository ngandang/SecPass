<header class="m-grid__item m-header " data-minimize-offset="200" data-minimize-mobile-offset="200" >
	<div class="m-container m-container--fluid m-container--full-height">
		<div class="m-stack m-stack--ver m-stack--desktop">
			<!-- BEGIN: Brand -->
			<div class="m-stack__item m-brand  m-brand--skin-dark ">
				<div class="m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-stack__item--middle m-brand__logo">
						<a href="#" class="m-brand__logo-wrapper">
							<img alt="" src="{{ asset('app/media/images/logo/logo_default_dark.png') }}"/>
						</a>
					</div>
					<div class="m-stack__item m-stack__item--middle m-brand__tools">
						<!-- BEGIN: Left Aside Minimize Toggle -->
						<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block ">
							<span></span>
						</a>
						<!-- END: Left Aside Minimize Toggle -->
						<!-- BEGIN: Responsive Aside Left Menu Toggler -->
						<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>
						<!-- END: Responsive Aside Left Menu Toggler -->
						<!-- BEGIN: Responsive Header Menu Toggler -->
						<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
							<span></span>
						</a>
						<!-- END: Responsive Header Menu Toggler -->
						<!-- BEGIN: Topbar Toggler -->
						<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
							<i class="flaticon-more"></i>
						</a>
						<!-- END: Topbar Toggler -->
					</div>
				</div>
			</div>
			<!-- END: Brand -->
			<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
				<!-- BEGIN: Horizontal Menu -->
				<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
					<i class="la la-close"></i>
				</button>
				<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
					<ul class="m-menu__nav m-menu__nav--submenu-arrow ">
						<li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
							<a  href="#" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon flaticon-notes"></i>
								<span class="m-menu__link-text">
									Lịch sử
								</span>
							</a>
							<!-- TODO: Đưa nó vào section -->
							<!-- <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:600px">
								<span class="m-menu__arrow m-menu__arrow--adjust"></span>
								<div class="m-menu__subnav">
									<ul class="m-menu__content">
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Tài khoản
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-profile"></i>
														<span class="m-menu__link-text">
															Facebook
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-profile"></i>
														<span class="m-menu__link-text">
															daa.uit.edu.vn
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-profile"></i>
														<span class="m-menu__link-text">
															trello.com
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-profile"></i>
														<span class="m-menu__link-text">
															Youtube
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-icon flaticon-profile"></i>
														<span class="m-menu__link-text">
															mail.google.com
														</span>
													</a>
												</li>
											</ul>
										</li>
										<li class="m-menu__item">
											<h3 class="m-menu__heading m-menu__toggle">
												<span class="m-menu__link-text">
													Sử dụng cuối
												</span>
												<i class="m-menu__ver-arrow la la-angle-right"></i>
											</h3>
											<ul class="m-menu__inner">
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
														10:02:07 AM - 12/25/2018
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
														10:01:29 AM - 12/25/2018
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
														10:01:23 AM - 12/25/2018
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
														10:00:15 AM - 12/25/2018
														</span>
													</a>
												</li>
												<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
													<a  href="header/actions.html" class="m-menu__link ">
														<i class="m-menu__link-bullet m-menu__link-bullet--line">
															<span></span>
														</i>
														<span class="m-menu__link-text">
															10:00:10 AM - 12/25/2018
														</span>
													</a>
												</li>
											</ul>
										</li>
									</ul>
								</div>
							</div> -->
						</li>
						<!--begin::Search-->
						<li class="m-menu__item m-menu__item--large m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-" id="m_quicksearch" data-search-type="default">
							<!--begin::Search Form -->
							
							<form class="m-header-search__form">
								<div class="m-header-search__wrapper">
									<span class="m-header-search__icon-search" id="m_quicksearch_search">
										<i class="la la-search"></i>
									</span>
									<span class="m-header-search__input-wrapper">
										<input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="Tìm kiếm..." id="m_quicksearch_input">
									</span>
									<span class="m-header-search__icon-close" id="m_quicksearch_close">
										<i class="la la-remove"></i>
									</span>
									<span class="m-header-search__icon-cancel" id="m_quicksearch_cancel">
										<i class="la la-times"></i>
									</span>
								</div>
							</form>
							<!--end::Search Form -->
							<!--begin::Search Results -->
							<div class="m-dropdown__wrapper ">
								<div class="m-dropdown__arrow m-dropdown__arrow--adjust"></div>
								<div class="m-dropdown__inner">
									<div class="m-dropdown__body">
										<div class="m-dropdown__content m-dropdown__scrollable m-scrollable" data-scrollable="true" data-max-height="300" data-mobile-max-height="200">
										</div>
									</div>
								</div>
							</div>
							<!--end::Search Results -->
						</li>
						<!--end::Search-->
					</ul>
				</div>
				<!-- END: Horizontal Menu -->
				<!-- BEGIN: Topbar -->
				<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-topbar__nav-wrapper">
						<ul class="m-topbar__nav m-nav m-nav--inline">
							<li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true">
								<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
									<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
									<span class="m-nav__link-icon">
										<i class="flaticon-music-2"></i>
									</span>
								</a>
								<!-- TODO: notifcation -->
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center" style="background: url({{ asset('app/media/images/misc/notification_bg.jpg') }}); background-size: cover;">
											<span class="m-dropdown__header-title">
												9 thông báo mới
											</span>
											<span class="m-dropdown__header-subtitle">
												Thông báo người dùng
											</span>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
													<div class="m-list-timeline m-list-timeline--skin-light">
														<div class="m-list-timeline__items">
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
																<span class="m-list-timeline__text">
																	12 tài khoản được thêm mới
																</span>
																<span class="m-list-timeline__time">
																	Mới đây
																</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge"></span>
																<span class="m-list-timeline__text">
																	Mật khẩu đã cũ
																	<span class="m-badge m-badge--success m-badge--wide">
																		đang chờ đổi
																	</span>
																</span>
																<span class="m-list-timeline__time">
																	14 phút trước
																</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge"></span>
																<span class="m-list-timeline__text">
																	Bạn có tin nhắn mới
																</span>
																<span class="m-list-timeline__time">
																	20 phút trước
																</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge"></span>
																<span class="m-list-timeline__text">
																	Kho lưu trữ đã được sử dụng 20% 
																	<!-- <span class="m-badge m-badge--info m-badge--wide">
																		settle
																	</span> -->
																</span>
																<span class="m-list-timeline__time">
																	1 giờ trước
																</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge"></span>
																<span class="m-list-timeline__text">
																	ABC đã chia sẻ mật khẩu với bạn
																	<!-- <a href="#" class="m-link">
																		Check
																	</a> -->
																</span>
																<span class="m-list-timeline__time">
																	2 giờ trước
																</span>
															</div>
															<div class="m-list-timeline__item m-list-timeline__item--read">
																<span class="m-list-timeline__badge"></span>
																<span href="" class="m-list-timeline__text">
																	Nhóm X - Một tài khoản đã được thêm mới
																	<span class="m-badge m-badge--danger m-badge--wide">
																		Quan trọng
																	</span>
																</span>
																<span class="m-list-timeline__time">
																	7 giờ trước
																</span>
															</div>
															<div class="m-list-timeline__item m-list-timeline__item--read">
																<span class="m-list-timeline__badge"></span>
																<span class="m-list-timeline__text">
																	ABC đã nhận được tài liệu chia sẻ
																</span>
																<span class="m-list-timeline__time">
																	1 ngày trước
																</span>
															</div>
															<div class="m-list-timeline__item">
																<span class="m-list-timeline__badge"></span>
																<span class="m-list-timeline__text">
																	ABC đã nhận được tài liệu chia sẻ
																</span>
																<span class="m-list-timeline__time">
																	5 ngày trước
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-topbar__userpic">
										<img src="{{ url('storage/avatars/' . Auth::user()->profile->avatar) }}" class="m--img-rounded m--marginless" alt=""/>
									</span>
									<span class="m-topbar__username m--hide">
										{{ Auth::user()->name }}
									</span>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__header m--align-center" style="background: url({{ asset('app/media/images/misc/user_profile_bg.jpg') }}); background-size: cover;">
											<div class="m-card-user m-card-user--skin-dark">
												<div class="m-card-user__pic">
													<img src="{{ url('storage/avatars/' . Auth::user()->profile->avatar) }}" class="m--img-rounded m--marginless" alt=""/>
												</div>
												<div class="m-card-user__details">
													<span class="m-card-user__name m--font-weight-500">
														{{ Auth::user()->name }}
													</span>
													<a href="" class="m-card-user__email m--font-weight-300 m-link">
														{{ Auth::user()->email }}
													</a>
												</div>
											</div>
										</div>
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav m-nav--skin-light">
													<li class="m-nav__section m--hide">
														<span class="m-nav__section-text">
															Section
														</span>
													</li>
													<li class="m-nav__item">
														<a href="profile" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-profile-1"></i>
															<span class="m-nav__link-title">
																<span class="m-nav__link-wrap">
																	<span class="m-nav__link-text">
																		Thông tin cá nhân
																	</span>
																	<span class="m-nav__link-badge">
																		<span class="m-badge m-badge--success">
																			2 <!-- thiếu 2 thông tin -->
																		</span>
																	</span>
																</span>
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="javascript:void()" id="logs_toggle" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-route"></i>
															<span class="m-nav__link-text">
																Lịch sử hoạt động
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="javascript:void()" id="messenger_toggle" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-chat-1"></i>
															<span class="m-nav__link-text">
																Tin nhắn
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
													<li class="m-nav__item">
														<a href="javascript:void()" id="faq_toggle" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-info"></i>
															<span class="m-nav__link-text">
																FAQ
															</span>
														</a>
													</li>
													<li class="m-nav__item">
														<a href="support" class="m-nav__link">
															<i class="m-nav__link-icon flaticon-lifebuoy"></i>
															<span class="m-nav__link-text">
																Hỗ trợ
															</span>
														</a>
													</li>
													<li class="m-nav__separator m-nav__separator--fit"></li>
													<li class="m-nav__item">
														<a id="logout" href="javascript:;" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
															Đăng xuất
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</li>
							<li id="m_quick_sidebar_toggle" class="m-nav__item">
								<a href="#" class="m-nav__link m-dropdown__toggle">
									<span class="m-nav__link-icon">
										<i class="flaticon-grid-menu"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- END: Topbar -->
			</div>
		</div>
	</div>
</header>