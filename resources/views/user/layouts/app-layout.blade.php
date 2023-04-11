<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>{{ $title }}</title>
		<link rel="stylesheet" href="{{ asset('user/assets/css/vendor.css') }}">
		<link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('user/assets/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('user/assets/css/custom.css') }}">
		<link rel="stylesheet" href="{{ asset('cp/assets/vendors/flatpickr/flatpickr.min.css') }}">
		<link rel=icon href="{{ asset('user/assets/img/favicon.png') }}" sizes="20x20" type="image/png">
		<!-- Stylesheet -->
		<script type="text/javascript"> var base_url = '{{ url('/') }}'; </script>
		@stack('styles')
	</head>
	<body>
		<!-- preloader area start -->
		<div class="preloader" id="preloader">
			<div class="preloader-inner">
				<div class="spinner">
					<div class="dot1"></div>
					<div class="dot2"></div>
				</div>
			</div>
		</div>
		<!-- preloader area end -->
		<!-- search popup start-->
		<div class="td-search-popup" id="td-search-popup">
			<form action="index.html" class="search-form">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search.....">
				</div>
				<button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<!-- search popup end-->
		<div class="body-overlay" id="body-overlay"></div>

		@include('user.layouts.partials.header')

        @yield('content')

		@include('user.layouts.partials.footer')

		<!-- back to top area start -->
		<div class="back-to-top">
			<span class="back-top"><i class="fa fa-angle-up"></i></span>
		</div>
		<!-- back to top area end -->
		<!-- all plugins here -->
		<script src="{{ asset('user/assets/js/vendor.js') }}"></script>
		<!-- main js  -->
		<script src="{{ asset('user/assets/js/main.js') }}"></script>
		<script src="{{ asset('cp/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
		<script src="{{ asset('user/assets/js/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('user/assets/js/validate.additional-methods.js') }}"></script>
		{{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> --}}
		{{-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script> --}}
		<script>
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>
		@stack('scripts')
	</body>
</html>
