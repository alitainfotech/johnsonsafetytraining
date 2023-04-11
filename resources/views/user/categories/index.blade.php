@extends('user.layouts.app-layout', ['title' => 'LMS - Category'])
@section('content')
    <div class="breadcrumb-area bg-overlay" style="background-image: url('user/assets/img/banner/2.png');">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title mb-0 text-center">
                    <h2 class="page-title">Blog</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container-banner">
            <div class="row">
                <div class="col-sm-6 keditColumn">
                    <div class="keditable">
                        <ul class="list-group list-group-flush">
                            @foreach($category as $key=>$categories)
                                <li class="list-group-item">
                                    <a class="title" href="{{ route('products.showCourseByCategory', $categories->slug) }}">{{ $categories->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 keditColumn">
                    <div class="keditable">
                        <b>High Risk Work Licence(s) HRWL</b>
                        <br>
                        <ul>
                            <li>Forklift</li>
                            <li>Elevated Work Platform</li>
                            <li>Dogging</li>
                            <li>Basic Rigging</li>
                            <li>Non Slewing Crane</li>
                        </ul>
                    </div>
                    <div class="keditable">
                        <b>Civil Stream</b>
                        <br>Civil and mining operator nationally recognised training&nbsp;
                        <div>
                            <ul>
                                <li>Excavtor</li>
                                <li>Skid Steer</li>
                                <li>Backhoe</li>
                                <li>Front End Loader</li>
                                <li>Grader</li>
                                <li>Bulldozer Civil and Mining</li>
                                <li>Articulating Haul truck</li>
                                <li>Rigid Haul Truck</li>
                                <li>Water truck</li>
                                <li>Roller / Compactor&nbsp;</li>
                            </ul>
                        </div>
                    </div>
                    <div class="keditable">
                        <b>Shut Down and Mining Entry Level Requiremnts</b>
                        <br>
                            <ul>
                                <li>Confined Space</li>
                                <li>Gas Test</li>
                                <li>Work Safely at Height</li>
                                <li>Yellow Card</li>
                            </ul>
                            Nationally Recognised Training, Training needs analysis
                        <br>
                    </div>
                </div>
            </div>
    </div>
@endsection
