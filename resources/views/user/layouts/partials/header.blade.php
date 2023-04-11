<!-- navbar start -->
<div class="navbar-area">
    <!-- navbar top start -->
    {{--  <div class="navbar-top">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-md-left text-center">
                    <ul>
                        <li>
                            <p><i class="fa fa-map-marker"></i> 2072 Pinnickinick Street, WA 98370</p>
                        </li>
                        <li>
                            <p><i class="fa fa-envelope-o"></i> info@website.com</p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="topbar-right text-md-right text-center">
                        <li class="social-area">
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>  --}}
    <nav class="navbar navbar-area-2 navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <button class="menu toggle-btn d-block d-lg-none" data-target="#edumint_main_menu"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-left"></span>
                <span class="icon-right"></span>
                </button>
            </div>
            <div class="logo">
                <a href="{{ route('home') }}"><h3 style="color: #cceaf1;">Johnson Safety and Training</h3></a>
            </div>
            <div class="nav-right-part nav-right-part-mobile">
                <a class="signin-btn" href="signin.html">Sign In</a>
                <a class="btn btn-base" href="signup.html">Sign Up</a>
                <a class="search-bar" href="#"><i class="fa fa-search"></i></a>
            </div>
            <div class="collapse navbar-collapse" id="edumint_main_menu">
                <ul class="navbar-nav menu-open">
                    <li class="menu-item">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('categories.index') }}">Courses</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('carts.index') }}">Cart</a>
                        <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                    </li>
                    {{--  <li class="menu-item-has-children">
                        <a href="#">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="event.html">Event</a></li>
                            <li><a href="event-details.html">Event Details</a></li>
                            <li><a href="team.html">Instructor</a></li>
                            <li><a href="team-details.html">Instructor Details</a></li>
                            <li><a href="pricing.html">Pricing</a></li>
                            <li><a href="gallery.html">Gallery</a></li>
                            <li><a href="signin.html">Sign In</a></li>
                            <li><a href="signup.html">Sign Up</a></li>
                        </ul>
                    </li>  --}}
                    {{--  <li class="menu-item-has-children">
                        <a href="#">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog-grid.html">Blog Grid</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                        </ul>
                    </li>  --}}
                    {{--  <li><a href="contact.html">Contact Us</a></li>  --}}
                </ul>
            </div>
            {{--  <div class="nav-right-part nav-right-part-desktop style-black">
                <a class="signin-btn" href="signin.html">Sign In</a>
                <a class="btn btn-base" href="blog.html">Sign Up</a>
                <a class="search-bar" href="#"><i class="fa fa-search"></i></a>
            </div>  --}}
        </div>
    </nav>
</div>
<!-- navbar end -->
