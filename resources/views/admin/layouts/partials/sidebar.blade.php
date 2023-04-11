<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
	<div class="sidebar-header">
		<a href="{{ route('admin.dashboard') }}" class="sidebar-brand">LM<span>S</span></a>
		<div class="sidebar-toggler not-active">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<div class="sidebar-body">
		<ul class="nav">
            @if(auth()->user()->types == "0")
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['admin.dashboard']) ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['admin.categories.index', 'admin.categories.create', 'admin.categories.edit']) ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Categories</span>
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['admin.products.index', 'admin.products.create', 'admin.products.edit', 'admin.products.avilabledate']) ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="layers"></i>
                        <span class="link-title">Courses</span>
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['admin.calendars.index']) ? 'active' : '' }}">
                    <a href="{{ route('admin.calendars.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Calendar</span>
                    </a>
                </li>
                <li class="nav-item {{ in_array(request()->route()->getName(), ['admin.payments.index']) ? 'active' : '' }}">
                    <a href="{{ route('admin.payments.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Payment Details</span>
                    </a>
                </li>

                <li class="nav-item {{ in_array(request()->route()->getName(), ['admin.booking.index']) ? 'active' : '' }}">
                    <a href="{{ route('admin.booking.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="book"></i>
                        <span class="link-title">Bookings</span>
                    </a>
                </li>
            @else
                {{--  <li class="nav-item {{ in_array(request()->route()->getName(), ['student.changepassword.index']) ? 'active' : '' }}">
                    <a href="{{ route('student.changepassword.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="lock"></i>
                        <span class="link-title">Changed Password</span>
                    </a>
                </li>  --}}
                <li class="nav-item {{ in_array(request()->route()->getName(), ['user.products.studentcourse','user.products.studentmaterial']) ? 'active' : '' }}">
                    <a href="{{ route('user.products.studentcourse') }}" class="nav-link">
                        <i class="link-icon" data-feather="file-text"></i>
                        <span class="link-title">Courses</span>
                    </a>
                </li>

                <li class="nav-item {{ in_array(request()->route()->getName(), ['user.booking.index']) ? 'active' : '' }}">
                    <a href="{{ route('user.booking.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="book"></i>
                        <span class="link-title">Bookings</span>
                    </a>
                </li>
            @endif
			{{-- <li class="nav-item nav-category">web apps</li>
			<li class="nav-item">
				<a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
				<i class="link-icon" data-feather="mail"></i>
				<span class="link-title">Email</span>
				<i class="link-arrow" data-feather="chevron-down"></i>
				</a>
				<div class="collapse" id="emails">
					<ul class="nav sub-menu">
						<li class="nav-item">
							<a href="pages/email/inbox.html" class="nav-link">Inbox</a>
						</li>
						<li class="nav-item">
							<a href="pages/email/read.html" class="nav-link">Read</a>
						</li>
						<li class="nav-item">
							<a href="pages/email/compose.html" class="nav-link">Compose</a>
						</li>
					</ul>
				</div>
			</li> --}}
		</ul>
	</div>
</nav>

