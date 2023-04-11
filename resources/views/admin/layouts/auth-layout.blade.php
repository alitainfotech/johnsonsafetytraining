<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{ $title ?? '' }} - {{ $page ?? '' }}">
	<meta name="author" content="{{ $title ?? '' }}">
	<meta name="keywords" content="{{ $title ?? '' }} - {{ $page ?? '' }}">
	<title>{{ $title ?? '' }} - {{ $page ?? '' }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->
	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('cp/assets/vendors/core/core.css') }}">
	<!-- endinject -->
	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('cp/assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('cp/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->
    <!-- Layout styles -->  
    <link rel="stylesheet" href="{{ asset('cp/assets/css/demo1/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('cp/assets/images/favicon.png') }}" />
</head>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">
				<div class="row w-100 mx-0 auth-page">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
	<!-- core:js -->
	<script src="{{ asset('cp/assets/vendors/core/core.js') }}"></script>
	<!-- endinject -->
	<!-- Plugin js for this page -->
	<!-- End plugin js for this page -->
	<!-- inject:js -->
	<script src="{{ asset('cp/assets/vendors/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('cp/assets/js/template.js') }}"></script>
	<!-- endinject -->
	<!-- Custom js for this page -->
	<!-- End custom js for this page -->
</body>
</html>