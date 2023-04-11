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
                    <div class="col-lg-5 col-md-10">
                        <div class="thumb">
                            <img src="{{ $products->images()->type('1')->path }}" alt="{{ $products->name }}">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="about-inner-wrap">
                            <div class="">
                                <h2 class="title">{{ $products->category->name }}-{{$products->name }}</h2>
                                {{-- <div class="row">
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
                                </div> --}}

                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Upcoming Dates</th>
                                        <th>Length</th>
                                        <th>Availability</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody class="data-repeater">
                                        @foreach ($avilabledates as $row)
                                        @php
                                            $startdate = new DateTime($row->start_at);
                                            $enddate = new DateTime($row->end_at);
                                            $days = $startdate->diff($enddate);
                                            $total_day = $days->days + 1;
                                            if ($total_day == 0) {
                                                $total_day = 1;
                                            }
                                            $availability = $row->no_of_seat;
                                            if(count($row->getAvailable) > 0){
                                                $availability = $availability - count($row->getAvailable);
                                                if($availability < 0){
                                                    $availability = 0;
                                                }
                                            }
                                        @endphp
                                            <tr>
                                                <td>{{ $row->start_at }}</td>
                                                <td>{{ $total_day }} Days</td>
                                                <td>{{ $availability }}</td>
                                                <td>{{ ($products->suburb) ? $products->suburb : '-' }}</td>
                                                <td><a class="btn btn-border-black {{ ($availability > 0) ? '' : 'disabled' }}" href="{{ route('carts.create',[$products->id,$row->id]) }}" >Book Now</a></td>
                                                {{-- @if ($availability > 0)
                                                @else
                                                    <td></td>
                                                @endif --}}
                                                    
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </br>
                                {{-- @if ($products->avilabledates->isNotEmpty())
                                    <a class="btn btn-border-black" href="{{ route('carts.create',$products->id) }}">Add to Cart</a>
                                @else
                                    <span style="color:red"><b>This Course Not Avilable At The Moments.</b></span>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
