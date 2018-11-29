<head> 
		<meta charset="utf-8" />
		<title>
			SecPASS
		</title>
		<meta name="description" content="SecPASS - The password management system for indiviuals and groups">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<!--BEGIN::Web font -->
		<script src="{{ asset('vendors/base/webfont.js') }}"></script>
		<script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--END::Web font -->
        <!--BEGIN::Base Styles -->
		<link href="{{ asset('vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('vendors/base/fontawesome-all.css') }}" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<link href="{{ asset('vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
		<!--END::Base Styles -->
        <!--BEGIN::Page Vendors -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
		<!--END::Page Vendors -->
		
		
		<link rel="shortcut icon" href="{{ asset('default/media/img/logo/favicon.ico') }}" />
	</head>