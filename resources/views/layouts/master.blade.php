<!DOCTYPE html>
<html lang="vi" >
	<!-- BEGIN::Head -->
	@include('layouts.includes.meta')
	<!-- END::Head -->
    <!-- BEGIN::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-footer--fixed m-aside--offcanvas-default"  >
		<!-- BEGIN: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- BEGIN: Header -->
			@include('layouts.includes.header')
			<!-- END: Header -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<!-- BEGIN: Left Aside -->
				@include('layouts.includes.leftaside')
				<!-- END: Left Aside -->
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Child page -->
					@yield('content')
					<!-- END: Child page -->
				</div>
			</div>
			<!-- BEGIN: Footer -->
			@include('layouts.includes.footer')
			<!-- END: Footer -->
		</div>
		<!-- END: Page -->

		<!-- BEGIN: Quick Sidebar -->
		@include('layouts.includes.quicksidebar')
		<!-- END: Quick Sidebar -->

		<!-- BEGIN: Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- END: Scroll Top -->

		<!-- BEGIN: Quick Nav -->
		<!-- END: Quick Nav -->

		<!--BEGIN: Base Scripts -->

		<script src="{{ asset('vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('default/base/scripts.bundle.js') }}" type="text/javascript"></script>
		<!--END: Base Scripts -->   
		<!--BEGIN: Page Vendors -->
		<script src="{{ asset('js/openpgp.js') }}"></script>
		<script src="{{ asset('js/script.js') }}"></script>
		
		<script src="{{ asset('js/nayuki-password-generator.js') }}"></script>
		<script src="{{ asset('vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript"></script>
		<!--END: Page Vendors -->  
		<!--BEGIN: Page Snippets -->
		@yield('pageSnippets')
		<!--END: Page Snippets -->
	</body>
	<!-- END::Body -->

</html>
