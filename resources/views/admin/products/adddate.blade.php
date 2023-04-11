@extends('admin.layouts.app-layout', ['title' => env('APP_NAME'), 'page' => 'Date Create'])
@push('styles')
    <link rel="stylesheet" href="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cp/assets/css/lms/custom.css?v='.time()) }}">
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Courses</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Date</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg"> avilable Date Create</h6>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>

                {{-- <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-title mb-0 mt-2 lh-lg"> </h6>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="javascript:void(0)" class="btn btn-primary add-more"  id="add_item">+</a>
                            <a  style="display:none;" href="javascript:void(0)" class="btn btn-danger remove-more" id="remove_item">-</a>
                        </div>
                    </div>
                </div> --}}
                
                <div class="card-body">
                    <form action="{{ route('admin.products.avilabledatestore') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product_id}}">
                        <table class="table" border="1">
                            <thead>
                              <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Number of seats</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody class="data-repeater">
                              <tr class="kolom">
                                <td><input type="text" class="form-control date-time start_date" name="courses[0][start_date]" id=""></td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control date-time end_date" name="courses[0][end_date]" id="end_date_0" data-id="0" readonly="readonly" disabled>
                                        <input class="form-control-input me-1 enable-end-date" type="checkbox" id="date_valid" data-id="0" name="date_valid"/>
                                    </div>    
                                </td>
                                <td><input type="number" class="form-control no_of_seat" name="courses[0][no_of_seat]" id=""></td>
                                <td class="btn-repeater">
                                  <button class="add-btn-repeat btn btn-primary" onclick="addElement($(this))" type="button">Add</button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                          <br>
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="reset" class="btn btn-secondary">Clear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <h6>Next Courses Avilable Dates</h6>
                <table class="table" border="1">
                    <thead>
                      <tr>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Number of seats</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->start_at }}</td>
                                <td>{{ $product->end_at }}</td>
                                <td>{{ $product->no_of_seat }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    {{-- <div>{{ $product->start_at }} <b>To</b> {{ $product->end_at }} <b>Number of seat : </b> {{ $product->no_of_seat }}</div> --}}
                <div></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('cp/assets/vendors/tinymce/tinymce.min.js?v='.time()) }}"></script>
<script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('cp/assets/js/lms/products.js?v='.time()) }}"></script>
<script src="{{ asset('cp/assets/js/lms/custom.js?v='.time()) }}"></script>

<script>

// var btn_delete = '<button type="button" class="btn btn-danger" onclick="removeKolom($(this))">Delete</button>';
// var btn_add = '<button class="add-btn-repeat btn btn-primary" onclick="addElement($(this))" type="button">Add</button>';
// var count = 1; // Create a count

// flatpickr(".date-time", {
//     defaultDate: "today",
//     enableTime: true,
// });
// function removeKolom(e) {
//     e.parents('.kolom').remove();

//     $('.end_date').each(function(i){
//         $(this).attr('name','courses['+i+'][end_date]');
//         $(this).attr('id','end_date_'+i); 
//         $(this).attr('data-id',i); 
//     });

//     $('.start_date').each(function(i){
//         $(this).attr('name','courses['+i+'][start_date]');
//     });

//     $('.no_of_seat').each(function(i){
//         $(this).attr('name','courses['+i+'][no_of_seat]');
//     });

//     $('input[type="checkbox"]').each(function(i){
//         $(this).attr('data-id',i); 
//     });

// }

// function addElement(e) {
//   var newElement = $(".kolom").first().clone();
//     var num = $('.kolom').length;
//     var newNum = num;
//     var newNums = 0;
//     newElement.find('.end_date').each(function(i){
//         $(this).attr('name','courses['+newNum+'][end_date]');
//         $(this).attr('id','end_date_'+newNum); 
//         $(this).attr('data-id',newNum); 
//     });

//     newElement.find('.start_date').each(function(i){
//         $(this).attr('name','courses['+newNum+'][start_date]');
//     });

//     newElement.find('.no_of_seat').each(function(i){
//         $(this).attr('name','courses['+newNum+'][no_of_seat]');
//     });

//     newElement.find('input[type="checkbox"]').each(function(i){
//         $(this).prop('checked',false); 
//         $(this).attr('data-id',newNum); 
//     });
//     $(".kolom").find('button.add-btn-repeat').replaceWith(btn_delete);
//     newElement.appendTo(".data-repeater").find('button').replaceWith(btn_add);

    
//     flatpickr(".date-time", {
//         defaultDate: "today",
//         enableTime: true,
//     });

//     $(".enable-end-date").on('click', function() {
//         var dataId = $(this).data('id');
//         if($(this).is(":checked")){
//             $('#end_date_'+dataId).prop('disabled', false);
//         }
//         else{
//             $('#end_date_'+dataId).prop('disabled', true);
//         }
//     });

// }


// $(".enable-end-date").on('click', function() {
//     var dataId = $(this).data('id');
//     if($(this).is(":checked")){
//         $('#end_date_'+dataId).prop('disabled', false);
//     }
//     else{
//         $('#end_date_'+dataId).prop('disabled', true);
//     }
// });
</script>
@endpush
