@extends('user.layouts.app-layout', ['title' => 'LMS - Course'])
@section('content')
    <div class="breadcrumb-area bg-overlay" style="background-image: {{ asset('user/assets/img/banner/2.png') }};">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title mb-0 text-center">
                    <h2 class="page-title title">Single Course</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="about-area pd-top-120">
        <div class="container">
            <div class="about-area-inner">
                <div class="row">
                    <div class="col-lg-6 col-md-10">
                        <div class="thumb">
                            <img src="{{ $products->images()->type('1')->path }}" alt="{{ $products->name }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-inner-wrap">
                            <div class="section-title">
                                <h2 class="title">{{ $products->category->name }}-{{$products->name }}</h2>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul class="single-list-wrap">
                                            <li class="single-list-inner">
                                                <i>{{$products->name}}</i>
                                            </li>
                                            <li class="single-list-inner">
                                                @if ($products->avilabledates->isNotEmpty())
                                                    <i>{{ date('d-m-Y', strtotime($products->avilabledates[0]->start_at))}}&nbsp;&nbsp;&nbsp;{{ $total_day }}Days</i>
                                                @endif
                                            </li>
                                            <li class="single-list-inner">
                                                <i>{{ $products->suburb}}</i>
                                            </li>
                                            <li class="single-list-inner">
                                                <i><span id="pricePrePost">$</span>{{ $products->price}}</i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </br>
                                @if ($products->avilabledates->isNotEmpty())
                                    <a class="btn btn-border-black" href="{{ route('carts.create',$products->id) }}">Add to Cart</a>
                                @else
                                    <span style="color:red"><b>This Course Not Avilable At The Moments.</b></span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
