<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
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
		<link rel="stylesheet" href="{{ asset('cp/assets/vendors/flatpickr/flatpickr.min.css') }}">
		<!-- End plugin css for this page -->
		<!-- inject:css -->
		<link rel="stylesheet" href="{{ asset('cp/assets/fonts/feather-font/css/iconfont.css') }}">
		<link rel="stylesheet" href="{{ asset('cp/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
		<!-- endinject -->
		<!-- Layout styles -->  
		<link rel="stylesheet" href="{{ asset('cp/assets/css/demo1/style.css') }}">
		<!-- Page wise styles -->  
		@stack('styles')
		<!-- End layout styles -->
		<link rel="shortcut icon" href="{{ asset('cp/assets/images/favicon.png') }}" />
		<script type="text/javascript"> var base_url = '{{ url('/') }}'; </script>
	</head>
	<body class="sidebar-dark">
		<div class="main-wrapper">
			<!-- partial:partials/_sidebar.html -->
			@include('admin.layouts.partials.sidebar')
			{{-- @include('admin.layouts.partials.setting-sidebar') --}}
			<!-- partial -->
			<div class="page-wrapper">
				<!-- partial:partials/_navbar.html -->
				@include('admin.layouts.partials.navbar')
				<!-- partial -->
				<div class="page-content">
					@yield('content')
				</div>
				<!-- partial:partials/_footer.html -->
				@include('admin.layouts.partials.footer')
				<!-- partial -->
			</div>
		</div>
		<!-- core:js -->
		<script src="{{ asset('cp/assets/vendors/core/core.js') }}"></script>
		<!-- endinject -->
		<!-- Plugin js for this page -->
		<script src="{{ asset('cp/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
		<script src="{{ asset('cp/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
		<!-- End plugin js for this page -->
		<!-- inject:js -->
		<script src="{{ asset('cp/assets/vendors/feather-icons/feather.min.js') }}"></script>
		<script src="{{ asset('cp/assets/js/template.js') }}"></script>
		<!-- endinject -->
		<!-- Custom js for this page -->
		<script src="{{ asset('cp/assets/js/dashboard-light.js') }}"></script>
		<!-- End custom js for this page -->
		<script>
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>
		<!-- Page wise scripts -->  
		@stack('scripts')
	</body>
</html>