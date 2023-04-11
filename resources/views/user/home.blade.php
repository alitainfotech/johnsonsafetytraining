@extends('user.layouts.app-layout', ['title' => 'LMS - Home'])
@section('content')
    <!-- banner start -->
    <div class="banner-area banner-area-2" style="background-image: url('user/assets/img/banner/2.png');">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 align-self-center">
                    <div class="banner-inner style-white text-center text-lg-left">
                        {{--  <h6 class="b-animate-1 sub-title">PLACE TO GROW</h6>  --}}
                        <h1 class="b-animate-2 title">Professional Industry Specific Training</h1>
                        {{--  <a class="btn btn-base b-animate-3 mr-sm-3 mr-2" href="blog.html">Get A Quote</a>
                        <a class="btn btn-border-white b-animate-3" href="blog.html">Read More</a>  --}}
                    </div>
                </div>
            </div>
        </div>0
    </div>
    <!-- banner end -->
    <!-- intro start -->
    <div class="intro-area intro-area--top">
        <div class="container">
            <div class="intro-area-inner-2">
                {{--  <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section-title text-center">
                            <h6 class="sub-title double-line">FEATURES</h6>
                            <h2 class="title">An exemplary <br> learning community</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-intro-inner style-thumb text-center">
                            <div class="thumb">
                                <img src="{{ asset('user/assets/img/intro/4.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <h5>Postgraduate</h5>
                                <p>Lorem ipsum dolor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-intro-inner style-thumb text-center">
                            <div class="thumb">
                                <img src="{{ asset('user/assets/img/intro/5.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <h5>Postgraduate</h5>
                                <p>Lorem ipsum dolor</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-intro-inner style-thumb text-center">
                            <div class="thumb">
                                <img src="{{ asset('user/assets/img/intro/6.png') }}" alt="img">
                            </div>
                            <div class="details">
                                <h5>Postgraduate</h5>
                                <p>Lorem ipsum dolor</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="intro-footer bg-base">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-list-inner">
                                <div class="media">

                                    <div class="media-body align-self-center">
                                        <div class="media-left">
                                            <img src="{{ asset('user/assets/img/license.png') }}" alt="img">
                                        </div>
                                        <a href="#" target="_blank" class="btn btn-info btn-xl">High Risk Work Licencing</a>
                                        <p>High Risk Work Licencing - The national licencing system for specific classes of High Risk Work- Forklift - Elevated Work Platform - Cranes -Doggign - Rigging - Scoffolding</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-list-inner">
                                <div class="media">
                                    <div class="media-body align-self-center">
                                        <div class="media-left">
                                            <img src="{{ asset('user/assets/img/linechart.png') }}" alt="img">
                                        </div>
                                        <a href="#" target="_blank" class="btn btn-info btn-xl">Civil and Mining</a>
                                        <p>Civil and Mining Nationally Accredited Training. Civil: Skidsteer - Excavator - Grader - Dozer - Backhoe - Haul Truck - Water Truck - Front End Loader - </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-list-inner">
                                <div class="media">

                                    <div class="media-body align-self-center">
                                        <div class="media-left">
                                            <img src="{{ asset('user/assets/img/calender.png') }}" alt="img">
                                        </div>
                                        <a href="#" class="btn btn-info btn-xl" target="_blank">School Leaver Training Packages</a>
                                        <p>Entry Level Training and Advice to get you started in a new carreer or upskill into a new role.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- intro end -->
    <!-- about area start -->
    {{--  <div class="about-area pd-top-120">
        <div class="container">
            <div class="about-area-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-10">
                        <div class="about-thumb-wrap after-shape"
                            style="background-image: url('user/assets/img/about/2.png');">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-inner-wrap">
                            <div class="section-title mb-0">
                                <h6 class="sub-title right-line">ABOUT US</h6>
                                <h2 class="title">Education in continuing a proud tradition.</h2>
                                <p class="content">The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax
                                    quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs.
                                    Waltz, bad nymph,
                                </p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="single-list-wrap">
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Metus interdum metus
                                            </li>
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Ligula cur maecenas
                                            </li>
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Fringilla nulla
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="single-list-wrap">
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Metus interdum metus
                                            </li>
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Ligula cur maecenas
                                            </li>
                                            <li class="single-list-inner style-check-box">
                                                <i class="fa fa-check"></i> Fringilla nulla
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <a class="btn btn-border-black" href="about.html">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- about area end -->
    <!-- course area start -->
    {{--  <div class="course-area pd-top-110 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h6 class="sub-title double-line">OUR COURSES</h6>
                        <h2 class="title">Top Featured Courses</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-course-inner style-two">
                        <div class="emt-thumb-icon">
                            <img src="{{ asset('user/assets/img/icon/6.png') }}" alt="img">
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('user/assets/img/course/1.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Creative resilience</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">
                                            <img src="{{ asset('user/assets/img/icon/5.png') }}" alt="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-course-inner style-two">
                        <div class="emt-thumb-icon">
                            <img src="{{ asset('user/assets/img/icon/7.png') }}" alt="img">
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('user/assets/img/course/2.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Adaptability</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">
                                            <img src="{{ asset('user/assets/img/icon/5.png') }}" alt="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-course-inner style-two">
                        <div class="emt-thumb-icon">
                            <img src="{{ asset('user/assets/img/icon/8.png') }}" alt="img">
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('user/assets/img/course/3.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Project management</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">
                                            <img src="{{ asset('user/assets/img/icon/5.png') }}" alt="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-course-inner style-two">
                        <div class="emt-thumb-icon">
                            <img src="{{ asset('user/assets/img/icon/9.png') }}" alt="img">
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('user/assets/img/course/4.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">User Interface</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">
                                            <img src="{{ asset('user/assets/img/icon/5.png') }}" alt="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-course-inner style-two">
                        <div class="emt-thumb-icon">
                            <img src="{{ asset('user/assets/img/icon/10.png') }}" alt="img">
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('user/assets/img/course/5.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Data Tracking</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">
                                            <img src="{{ asset('user/assets/img/icon/5.png') }}" alt="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-course-inner style-two">
                        <div class="emt-thumb-icon">
                            <img src="{{ asset('user/assets/img/icon/11.png') }}" alt="img">
                        </div>
                        <div class="thumb">
                            <img src="{{ asset('user/assets/img/course/6.png') }}" alt="img">
                        </div>
                        <div class="details">
                            <div class="emt-course-meta border-0">
                                <div class="row">
                                    <div class="col-10">
                                        <h6><a href="course-details.html">Creative resilience</a></h6>
                                    </div>
                                    <div class="col-2 text-right">
                                        <a class="arrow-right" href="course-details.html">
                                            <img src="{{ asset('user/assets/img/icon/5.png') }}" alt="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- course area end -->
    <!-- speciality area start -->
    {{--  <div class="spaciality-area mg-top--170">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="testimonial-area-inner bg-cover h-100"
                        style="background-image: url('{{ asset('user/assets/img/other/2.png') }}');">
                        <img class="testimonial-right-img" src="{{ asset('user/assets/img/other/4.png') }}" alt="img">
                        <div class="single-testimonial-inner style-white">
                            <h4 class="text-white">A Journey to Excellence.</h4>
                            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at est id leo
                                luctus gravida a in ipsum.
                            </p>
                            <ul class="single-list-wrap">
                                <li class="single-list-inner style-check-box">
                                    <i class="fa fa-check"></i> Metus interdum metus
                                </li>
                                <li class="single-list-inner style-check-box">
                                    <i class="fa fa-check"></i> Ligula cur maecenas
                                </li>
                                <li class="single-list-inner style-check-box">
                                    <i class="fa fa-check"></i> Fringilla nulla
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="subscribe-inner-area h-100" style="background-color: var(--main-color);">
                        <h3>Committed to educating and nurturing all students</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis at est id leo luctus gravida a
                            in ipsum.
                        </p>
                        <div class="single-input-inner">
                            <input type="text" placeholder="Email Address">
                            <button class="btn btn-black"><i class="fa fa-envelope"></i> Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- speciality area end -->
    <!-- pricing-area start -->
    {{--  <div class="pricing-area pd-top-280 pd-bottom-90 text-center"
        style="background-image: url({{ asset('user/assets/img/bg/pricing-bg.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-11">
                    <div class="section-title">
                        <h6 class="sub-title double-line">LET’S WORK</h6>
                        <h2 class="title">Pricing Plans</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single-pricing-inner-wrap">
                        <div class="single-pricing-inner">
                            <h6 class="title">BASIC</h6>
                            <div class="price-area">
                                <span>$59 </span> / month
                            </div>
                            <ul class="pricing-list">
                                <li><i class="fa fa-check"></i>Branding graphics design</li>
                                <li><i class="fa fa-check"></i>Lifetime free support</li>
                                <li><i class="fa fa-check"></i>Web devolopment course</li>
                                <li><i class="fa fa-check"></i>Unlimited free revision </li>
                                <li class="unable"><i class="fa fa-times"></i>Lifetime devolopment</li>
                                <li class="unable"><i class="fa fa-times"></i>Unlimited free revision </li>
                            </ul>
                            <a class="btn btn-base btn-radius w-100" href="#">GET STARTED</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-pricing-inner-wrap">
                        <div class="single-pricing-inner">
                            <h6 class="title">STANDARD</h6>
                            <div class="price-area">
                                <span>$99 </span> / month
                            </div>
                            <ul class="pricing-list">
                                <li><i class="fa fa-check"></i>Branding graphics design</li>
                                <li><i class="fa fa-check"></i>Lifetime free support</li>
                                <li><i class="fa fa-check"></i>Web devolopment course</li>
                                <li><i class="fa fa-check"></i>Unlimited free revision </li>
                                <li class="unable"><i class="fa fa-times"></i>Lifetime devolopment</li>
                                <li class="unable"><i class="fa fa-times"></i>Unlimited free revision </li>
                            </ul>
                            <a class="btn btn-base btn-radius w-100" href="#">GET STARTED</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-pricing-inner-wrap">
                        <div class="single-pricing-inner">
                            <h6 class="title">PLATINUM</h6>
                            <div class="price-area">
                                <span>$211</span> / month
                            </div>
                            <ul class="pricing-list">
                                <li><i class="fa fa-check"></i>Branding graphics design</li>
                                <li><i class="fa fa-check"></i>Lifetime free support</li>
                                <li><i class="fa fa-check"></i>Web devolopment course</li>
                                <li><i class="fa fa-check"></i>Unlimited free revision </li>
                                <li class="unable"><i class="fa fa-times"></i>Lifetime devolopment</li>
                                <li class="unable"><i class="fa fa-times"></i>Unlimited free revision </li>
                            </ul>
                            <a class="btn btn-base btn-radius w-100" href="#">GET STARTED</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!--pricing-area end-->
    <!--client-area start-->
    {{--  <div class="client-area bg-base pd-top-100 pd-bottom-100"
        style="background-image: url({{ asset('user/assets/img/institute/bg.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="institute-slider owl-carousel">
                        <div class="item">
                            <img src="{{ asset('user/assets/img/institute/1.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('user/assets/img/institute/2.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('user/assets/img/institute/3.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('user/assets/img/institute/4.png') }}" alt="img">
                        </div>
                        <div class="item">
                            <img src="{{ asset('user/assets/img/institute/5.png') }}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- client-area end -->
    <!-- events-area start -->
    {{--  <div class="events-area pd-top-110 pd-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-11">
                    <div class="section-title text-center">
                        <h6 class="sub-title double-line">EVENTS</h6>
                        <h2 class="title">Upcoming Events</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <ul class="single-blog-list-wrap style-white" style="background-color: var(--heading-color);">
                        <li>
                            <div class="media single-blog-list-inner style-white">
                                <div class="media-left date">
                                    <span>JAN</span>
                                    20
                                </div>
                                <div class="media-body details">
                                    <ul class="blog-meta">
                                        <li><i class="fa fa-user"></i> BY ADMIN</li>
                                        <li><i class="fa fa-folder-open-o"></i> Air transport</li>
                                    </ul>
                                    <h5><a href="blog-details.html">Clone sit amet, consec tetur elit</a></h5>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="media single-blog-list-inner">
                                <div class="media-left date">
                                    <span>FEB</span>
                                    26
                                </div>
                                <div class="media-body details">
                                    <ul class="blog-meta">
                                        <li><i class="fa fa-user"></i> BY ADMIN</li>
                                        <li><i class="fa fa-folder-open-o"></i> Air transport</li>
                                    </ul>
                                    <h5><a href="blog-details.html">Maecenas interdum lorem eleifend</a></h5>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="media single-blog-list-inner">
                                <div class="media-left date">
                                    <span>JAN</span>
                                    28
                                </div>
                                <div class="media-body details">
                                    <ul class="blog-meta">
                                        <li><i class="fa fa-user"></i> BY ADMIN</li>
                                        <li><i class="fa fa-folder-open-o"></i> Air transport</li>
                                    </ul>
                                    <h5><a href="blog-details.html">Nunc scelerisque tincidunt elit. </a></h5>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 align-self-center">
                    <div class="event-thumb">
                        <img src="{{ asset('user/assets/img/other/events.png') }}" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- events-area end -->
    <!-- testimonial area start -->
    {{--  <div class="testimonial-area pd-top-110 pd-bottom-120"
        style="background-image: url({{ asset('user/assets/img/testimonial/bg.png') }}); background-size: cover; background-position: center;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7 col-md-11">
                    <div class="section-title text-center">
                        <h6 class="sub-title double-line">Client Testimonials</h6>
                        <h2 class="title">What our clients say </h2>
                    </div>
                </div>
            </div>
            <div class="testimonial-slider-2 owl-carousel">
                <div class="item">
                    <div class="single-testimonial-inner">
                        <span class="testimonial-quote"><i class="fa fa-quote-right"></i></span>
                        <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit. Duis at est id leo luctus gravida a
                            in ipsum.
                        </p>
                        <div class="media testimonial-author">
                            <div class="media-left">
                                <img src="{{ asset('user/assets/img/testimonial/1.png') }}" alt="img">
                            </div>
                            <div class="media-body align-self-center">
                                <h6>Eugene Freeman</h6>
                                <p>Tincidunt</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="single-testimonial-inner">
                        <span class="testimonial-quote"><i class="fa fa-quote-right"></i></span>
                        <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit. Duis at est id leo luctus gravida a
                            in ipsum.
                        </p>
                        <div class="media testimonial-author">
                            <div class="media-left">
                                <img src="{{ asset('user/assets/img/testimonial/2.png') }}" alt="img">
                            </div>
                            <div class="media-body align-self-center">
                                <h6>Kelly Coleman</h6>
                                <p>Nulla nec</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- testimonial area end -->
    <!-- blog-area start -->
    {{--  <div class="blog-area pd-top-110 pd-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-7">
                    <div class="section-title text-center">
                        <h6 class="sub-title double-line">Latest News</h6>
                        <h2 class="title">Our Insights & Articles</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog-inner">
                        <div class="thumb">
                            <img src="{{ asset('user/assets/img/blog/1.png') }}" alt="img">
                            <span class="date">28 JANUARY, 2020</span>
                        </div>
                        <div class="details">
                            <ul class="blog-meta">
                                <li><i class="fa fa-user"></i> BY ADMIN</li>
                                <li><i class="fa fa-folder-open-o"></i> Air transport</li>
                            </ul>
                            <h5><a href="blog-details.html">Quisque suscipit ipsum est, eu venenatis leo</a></h5>
                            <a class="read-more-text" href="blog-details.html">READ MORE <i
                                class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog-inner">
                        <div class="thumb">
                            <img src="{{ asset('user/assets/img/blog/2.png') }}" alt="img">
                            <span class="date">28 JANUARY, 2020</span>
                        </div>
                        <div class="details">
                            <ul class="blog-meta">
                                <li><i class="fa fa-user"></i> BY ADMIN</li>
                                <li><i class="fa fa-folder-open-o"></i> Air transport</li>
                            </ul>
                            <h5><a href="blog-details.html">Maecenas interdum lorem eleifend orci aliquam</a></h5>
                            <a class="read-more-text" href="blog-details.html">READ MORE <i
                                class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog-inner">
                        <div class="thumb">
                            <img src="{{ asset('user/assets/img/blog/2.png') }}" alt="img">
                            <span class="date">28 JANUARY, 2020</span>
                        </div>
                        <div class="details">
                            <ul class="blog-meta">
                                <li><i class="fa fa-user"></i> BY ADMIN</li>
                                <li><i class="fa fa-folder-open-o"></i> Air transport</li>
                            </ul>
                            <h5><a href="blog-details.html">Maecenas interdum lorem eleifend orci aliquam</a></h5>
                            <a class="read-more-text" href="blog-details.html">READ MORE <i
                                class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  --}}
    <!-- blog-area end -->
@endsection
