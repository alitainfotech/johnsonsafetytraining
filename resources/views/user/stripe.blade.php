@extends('user.layouts.app-layout', ['title' => 'LMS - stripe'])
@section('content')
    <div class="breadcrumb-area bg-overlay">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title mb-0 text-center">
                    <h2 class="page-title title">Stripe Payment</h2>
                </div>
            </div>
        </div>
    </div>
    <form role="form" action="{{ route('stripe.payment') }}" method="post" class="require-validation" data-cc-on-file="false"
        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
        @csrf
        <div class="container">
            <div class="row py-5">
                <div class="col-md-6 col-md-offset-3 col-sm-12">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table" >
                                <h3 class="panel-title" >Customer Details</h3>
                        </div>
                        <div class="panel-body">
                            {{--  @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif  --}}
                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-6 form-group'>
                                        <select name="title" id="title" class="form-control">
                                            <option value="">Select Title</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Ms">Ms</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('title') }}</p>
                                    </div>
                                    <div class='col-xs-12 col-md-6 form-group'>
                                        <input class='form-control' size='4' id="firstname" name="firstname" type='text' placeholder="First Name">
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('firstname') }}</p>
                                    </div>
                                    <div class='col-xs-12 col-md-6 form-group'>
                                        <input class='form-control' size='4' id="lastname" name="lastname" type='text' placeholder="Last Name">
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('lastname') }}</p>
                                    </div>

                                    <div class='col-xs-12 col-md-6 form-group'>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('gender') }}</p>
                                    </div>
                               
                                    <div class='col-xs-12 col-md-6 form-group'>
                                        <input class='form-control' size='20' id="phone" name="phone" type='text' placeholder="Contact number">
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('phone') }}</p>
                                    </div>
                                    <div class='col-xs-12 col-md-6 form-group'>
                                        <input class='form-control' size='20' id="email" name="email" type='email' placeholder="Email Address">
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('email') }}</p>
                                    </div>

                                    <div class='col-xs-12 col-md-6 form-group'>
                                        <input class='form-control date-of-birth' size='20' id="date_of_birth" name="date_of_birth" type='text' placeholder="Select date of bith">
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('date_of_birth') }}</p>
                                    </div>
                                    <div class='col-xs-12 col-md-6 form-group'>
                                        <input class='form-control' id="town_of_birth" name="town_of_birth" type='text' placeholder="Town of birth">
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('town_of_birth') }}</p>
                                    </div>

                                    <div class='col-xs-12 col-md-6 form-group'>
                                        <input class='form-control' id="country_of_birth" name="country_of_birth" type='text' placeholder="Country of birth">
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('country_of_birth') }}</p>
                                    </div>
                   
                                    <div class='col-xs-12 col-md-12 form-group'>
                                        <input class='form-control' id="custaddress" name="custaddress" placeholder='Address' size='4' type='text'>
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('custaddress') }}</p>
                                    </div>

                                    <div class='col-xs-12 col-md-4 form-group'>
                                        <input class='form-control' id="custzipcode" name="custzipcode" name="" placeholder='Zip Code' size='2' type='text'>
                                            <p class="mt-1 tx-13 text-danger">{{ $errors->first('custzipcode') }}</p>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group'>
                                        <input class='form-control' id="custcity" name="custcity" placeholder='city' size='4' type='text'>
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('custcity') }}</p>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group'>
                                        <input class='form-control' id="state" name="state" placeholder='State' type='text'>
                                        <p class="mt-1 tx-13 text-danger">{{ $errors->first('state') }}</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-3 col-sm-12">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table" >
                                <h3 class="panel-title" >Payment Details</h3>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif
                            @if (Session::has('error'))
                            <div class="alert alert-danger text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('error') }}</p>
                            </div>
                        @endif
                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-12 form-group required'>
                                        <label class='control-label'>Name on Card</label>
                                        <input class='form-control' id="name" name="name" size='4' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-12 form-group required'>
                                        <label class='control-label'>Card Number</label>
                                        <input autocomplete='off' name="card_number" class='form-control card-number' size='20' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                                        <label class='control-label'>CVC</label>
                                        <input autocomplete='off' name="cvc" class='form-control card-cvc'  placeholder='CVC' size='4' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Month</label>
                                        <input class='form-control card-expiry-month' name="exp_month"  placeholder='MM' size='2' type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Year</label>
                                        <input class='form-control card-expiry-year' name="exp_year"  placeholder='YYYY' size='4' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide'>

                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <input type="checkbox" id="checkbox1"/>
                                    <b>Billing information is the same as delivery address.</b>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row payment-section">
                    <div  class="col-md-12 col-md-offset-3 col-sm-12">
                        <div id="autoUpdate" class="autoUpdate">
                            <h3>Invoice Details</h3>
                            <hr>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <label class='control-label'>Comapny</label>
                                    <input class='form-control' id="companyname" name="companyname" size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <label class='control-label'>Tax Id</label>
                                    <input class='form-control' id="taxid" name="taxid" size='4' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-12 form-group'>
                                    <label class='control-label'>Address</label>
                                    <input class='form-control' id="companyaddress" name="companyaddress" size='4' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <label class='control-label'>Zip Code</label>
                                    <input class='form-control' id="companyzipcode" name="companyzipcode" size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <label class='control-label'>City</label>
                                    <input class='form-control' id="companycity" name="companycity" size='4' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <label class='control-label'>State</label>
                                    <input class='form-control' id="companystate" name="companystate" size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <label class='control-label'>Country</label>
                                    <input class='form-control' id="companycountry" name="companycountry" size='4' type='text'>
                                </div>
                            </div>
                        </div>

                        <div class="checkbox">
                            <label class=""><input name="agreement" type="checkbox" id="agreement" value="1" required="required"> Yes, I agree <a href="index.php?p=1_8&amp;sp=2" target="_blank">Terms &amp; Conditions</a> and <a href="index.php?p=1_8&amp;sp=3" target="_blank">Privacy Policy</a></label>
                        </div>

                        <div class="form-group" style="overflow:auto; background:#eee;">
                            <div style="padding:30px 0;overflow:auto">
                                <a class="pull-left" href="#">← Back</a>
                                <button class="btn btn-primary btn-lg btn-block col-sm-6 pull-right" type="submit">Check out</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('user/assets/js/v2.js?v='.time()) }}"></script>
    <script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/stripe.js?v='.time()) }}"></script>
@endpush
