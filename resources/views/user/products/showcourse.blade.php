@extends('user.layouts.app-layout', ['title' => 'LMS - Course'])
@section('content')
    <div class="breadcrumb-area bg-overlay" style="background-image: {{ asset('user/assets/img/banner/2.png') }};">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title mb-0 text-center">
                    <h2 class="page-title title">{{ $category->name }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center pd-top-100">
            @foreach($products as $key => $product)
                <div class="col-lg-4 col-md-6">
                    <a href="{{ route('courses.show', $product->slug) }}">
                        <div class="single-course-inner">
                            <div class="thumb">
                                <img src="{{ $product->images()->type('1')->path }}" alt="{{ $product->name }}">
                            </div>
                            <div class="details">
                                <div class="details-inner">
                                    <div class="emt-user">
                                        <span class="align-self-center title">{{ $product->name }}</span>
                                    </div>
                                    <h6>
                                        <span>{!! $product->description !!}</span>
                                    </h6>
                                </div>
                                <div class="emt-course-meta">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="rating">
                                                <i class="fa fa-star"></i> 4.3
                                                <span>(23)</span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="price text-right">
                                                Price: <span>$ {{ number_format($product->price, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="course-course-detaila-inner">
            <div class="details-inner">
                <h3 class="title">{{ $category->name }}</h3>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    <div class="course-details-content">
                        {!! $category->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
