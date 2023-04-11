@extends('user.layouts.app-layout', ['title' => 'LMS - Enrolment'])
<style>
    .form-group .error{
        color: #ff00009e;
    }
    label.error{
        color: #ff00009e;
    }
</style>
@section('content')
    <div class="breadcrumb-area bg-overlay">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="section-title mb-0 text-center">
                    <h2 class="page-title title">Enrolment Form</h2>
                </div>
            </div>
        </div>
    </div>

    <form role="form" action="{{ route('user.enrollment.save') }}" method="post" id="enrollment-form">
        @csrf
        <input type="hidden" name="user_id" value="{{ encrypt($user->id) }}">
        <input type="hidden" name="order_id" value="{{ encrypt($orderId) }}">
        <div class="container mt-5">
            @if (session()->has('message'))
                <div class="alert alert-{{ session()->get('type') }} alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="row p-3" style="background: #f3f3f3">
                <div class="col-md-6 col-md-offset-3 col-sm-12">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" >Customer Details</h6>
                        </div>
                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <input class='form-control' size='4' id="firstname" name="firstname" type='text' placeholder="First Name" value="{{ $user->user_name }}" readonly>
                                    <p class="mt-1 tx-13 text-danger">{{ $errors->first('firstname') }}</p>
                                </div>
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <input class='form-control' size='4' id="lastname" name="lastname" type='text' placeholder="Last Name" value="{{ $user->lastname }}" readonly>
                                    <p class="mt-1 tx-13 text-danger">{{ $errors->first('lastname') }}</p>
                                </div>
                                
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <input class='form-control' size='20' id="phone" name="phone" type='text' placeholder="Contact number" value="{{ $user->phone }}" readonly>
                                    <p class="mt-1 tx-13 text-danger">{{ $errors->first('phone') }}</p>
                                </div>
                                <div class='col-xs-12 col-md-6 form-group'>
                                    <input class='form-control' size='20' id="email" name="email" type='email' placeholder="Email Address"  value="{{ $user->email }}" readonly>
                                    <p class="mt-1 tx-13 text-danger">{{ $errors->first('email') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" >Unique Student Identifier (USI) </h6>
                        </div>
                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" >ALL STATES TRAINING is required by law to verify your Unique Student Identifier (USI) before we can issue certification.  </h6>
                        </div>
                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="col-xs-12 col-md-6 form-group">
                                    <label class="form-check-label">Do you have a USI? </label>
                                </div>
                                <div class="col-xs-12 col-md-6 form-group">
                                    <input type="checkbox" id="usi" name="usi" value="1">
                                    <label class="form-check-label" for="usi"> Yes</label>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 usi-no d-none">
                                    <label for="usi_no">Your USI No. </label>
                                    <input type="text" class="form-control" id="usi_no" name="usi_no" placeholder="Your USI No">
                                    <span for="" class="error usi_no_error"></span>
                                </div>

                                <div class="col-xs-12 col-md-6 form-group">
                                    <label class="form-check-label">** Obtaining your USI? </label>
                                </div>
                                <div class="col-xs-12 col-md-6 form-group">
                                    <input type="checkbox" id="obtaining_usi" name="obtaining_usi" value="1">
                                    <label class="form-check-label" for="obtaining_usi"> I will obtain my own USI from <a href="http://www.usi.gov.au/" target="_blank"> http://www.usi.gov.au/. </a> I understand that delay in supplying my USI to ALL STATES TRAINING may result in delay in course participation and certification. </label>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title">Contact Details  </h6>
                        </div>
                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="phone_no">Phone (Home) </label>
                                    <input type="number" class="form-control" id="phone_no" name="phone_no" placeholder="Phone no">
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title">Emergency Contact </h6>
                        </div>
                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergeny_name">Name </label>
                                        <input type="text" class="form-control" id="emergeny_name" name="emergeny_name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergeny_relationship">Relationship </label>
                                        <input type="text" class="form-control" id="emergeny_relationship" name="emergeny_relationship" placeholder="Relationship">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergeny_tel">Contact Tel </label>
                                        <input type="number" class="form-control" id="emergeny_tel" name="emergeny_tel" placeholder="Contact Tel">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergeny_mobile">Mobile No </label>
                                        <input type="number" class="form-control" id="emergeny_mobile" name="emergeny_mobile" placeholder="Mobile No">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" >Employment Status</h6>
                        </div>
                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input employee-status" type="radio" name="employee_status" id="full_time_employee" value="full_time_employee">
                                        <label class="form-check-label" for="full_time_employee">Full-Time Employee</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input employee-status" type="radio" name="employee_status" id="part_time_emplyee" value="employee_status">
                                        <label class="form-check-label" for="part_time_emplyee">Part-Time Employee</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input employee-status" type="radio" name="employee_status" id="self_employee" value="self_employee">
                                        <label class="form-check-label" for="self_employee">Self-Employed (Not Employing Others) </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input employee-status" type="radio" name="employee_status" id="employer" value="employer">
                                        <label class="form-check-label" for="employer">Employer</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input employee-status" type="radio" name="employee_status" id="unpaid_word" value="unpaid_word">
                                        <label class="form-check-label" for="unpaid_word">Employed – Unpaid Worker in Family Business </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input employee-status" type="radio" name="employee_status" id="seeking_full_time" value="seeking_full_time">
                                        <label class="form-check-label" for="seeking_full_time">Unemployed – Seeking Full-Time Work </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input employee-status" type="radio" name="employee_status" id="seeking_part_time" value="seeking_part_time">
                                        <label class="form-check-label" for="seeking_part_time">Unemployed – Seeking Part-Time Work  </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input employee-status" type="radio" name="employee_status" id="not_seeking_employment" value="not_seeking_employment">
                                        <label class="form-check-label" for="not_seeking_employment">Not Employed – Not Seeking Employment </label>
                                    </div>
                                </div>
                                <span for="" class="error employee_status_error"></span>
                            </div>
                        </div>
                  
                        <div class="panel-body employment-detail d-none">
                            <div class="panel-heading display-table" >
                                <h6 class="panel-title" >Employment Details (if applicable) </h6>
                            </div>
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-6">
                                    <label for="employment_company">Company</label>
                                    <input type="text" class="form-control" id="employment_company" name="employment_company" placeholder="Company">
                                    <span for="" class="error employment_company_error"></span>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <label for="employment_email">Email Address</label>
                                    <input type="text" class="form-control" id="employment_email" name="employment_email" placeholder="Email Address">
                                    <span for="" class="error employment_email_error"></span>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <label for="employment_contact_person">Contact Person</label>
                                    <input type="text" class="form-control" id="employment_contact_person" name="employment_contact_person" placeholder="Contact Person">
                                    <span for="" class="error employment_contact_person_error"></span>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <label for="employment_work_on"> Work No</label>
                                    <input type="text" class="form-control" id="employment_work_on" name="employment_work_on" placeholder="Work No">
                                    <span for="" class="error employment_work_on_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" > Personal Information </h6>
                        </div>
                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" > A.Language and Cultural Diversity </h6>
                        </div>
                       
                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-check-label">Are you an Australian Citizen? </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="radio" id="australian_citizen_yes" class="check-australian-citizen" name="australian_citizen" value="1">
                                        <label class="form-check-label" for="australian_citizen_yes"> Yes</label>
                                        <input type="radio" id="australian_citizen_no" class="check-australian-citizen" name="australian_citizen" value="0">
                                        <label class="form-check-label" for="australian_citizen_no"> No</label>
                                    </div>
                                </div>
                                <div class="row australian-citizen d-none">
                                    <div class="form-group col-xs-12 col-md-12">
                                        <label for="country_of_birth">If NO, what is your country of birth? </label>
                                        <input type="text" class="form-control" id="country_of_birth" name="country_of_birth" placeholder="Country of birth">
                                        <span for="country_of_birth" class="error country_of_birth_error"></span>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-12">
                                        <label for="visa_classification">Please State your Visa Classification (if applicable) – e.g., 572, 457 etc </label>
                                        <input type="text" class="form-control" id="visa_classification" name="visa_classification" placeholder="Visa Classification">
                                        <span for="visa_classification" class="error visa_classification_error"></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 form-group">
                                    <label class="form-check-label">Is English your First Language? </label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="radio" id="english_language_yes" class="check-english-language" name="english_language" value="1">
                                        <label class="form-check-label" for="english_language_yes"> Yes</label>
                                        <input type="radio" id="english_language_no" class="check-english-language" name="english_language" value="0">
                                        <label class="form-check-label" for="english_language_no"> No</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group language-usually-speak d-none">
                                        <label for="language_usually_speak">If NO, what language do you usually speak? </label>
                                        <input type="text" class="form-control" id="language_usually_speak" name="language_usually_speak" placeholder="Enter language">
                                        <span for="country_of_birth" class="error language_usually_speak_error"></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 form-group">
                                    <label class="form-check-label">How well do you speak English?  </label>
                                </div>
                                <div class="col-xs-12 col-md-6 form-group">
                                    <div class="col-xs-12 col-md-12 form-group">
                                        <input type="radio" id="very_well" name="speak_english" value="very_well">
                                        <label class="form-check-label" for="very_well"> Very Well </label>
                                        <input type="radio" id="well" name="speak_english" value="well">
                                        <label class="form-check-label" for="well"> Well</label>
                                        <input type="radio" id="minimal" name="speak_english" value="minimal">
                                        <label class="form-check-label" for="minimal">Minimal</label>
                                        <input type="radio" id="not_at_all" name="speak_english" value="not_at_all">
                                        <label class="form-check-label" for="not_at_all"> Not at all</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" > B.Indigenous Status </h6>
                        </div>

                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="indigenous_status" id="aboriginal" value="aboriginal">
                                        <label class="form-check-label" for="aboriginal">Yes, Aboriginal</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="indigenous_status" id="torres_strait" value="torres_strait">
                                        <label class="form-check-label" for="torres_strait">Yes. Torres Strait Islander </label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="indigenous_status" id="aboriginal_torres" value="aboriginal_torres">
                                        <label class="form-check-label" for="aboriginal_torres">Yes, Aboriginal and Torres Strait Islander </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="indigenous_status" id="neither_aboriginal" value="neither_aboriginal">
                                        <label class="form-check-label" for="neither_aboriginal">No, Neither Aboriginal or Torres Strait Islander</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" > C.Disability Status  </h6>
                        </div>

                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-12">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="">Do you consider that you have a disability, impairment / long term condition that may affect your participation in the course?</label>
                                    </div>
                                    <div class="col-xs-12 col-md-6 form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input disability-status" type="radio" name="disability_status" id="disability_status_yes" value="1">
                                            <label class="form-check-label" for="disability_status_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input disability-status" type="radio" name="disability_status" id="disability_status_no" value="0">
                                            <label class="form-check-label" for="disability_status_no">No – Go to D.</label>
                                        </div>                             
                                    </div>
                                </div>
                            </div>
                            <div class='form-row row disability-indicate-data d-none'>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="">If yes, please indicate the area of disability, impairment or long-term condition (you may tick more than one) </label>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[hearing]" id="hearing" value="1">
                                        <label class="form-check-label" for="hearing">Hearing / Deafness</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[vision]" id="vision" value="1">
                                        <label class="form-check-label" for="vision">Vision</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[acquired_brain_impairment]" id="acquired_brain_impairment" value="1">
                                        <label class="form-check-label" for="acquired_brain_impairment">Acquired Brain Impairment</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[physical]" id="physical" value="1">
                                        <label class="form-check-label" for="physical">Physical</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[intellectual]" id="intellectual" value="1">
                                        <label class="form-check-label" for="intellectual">Intellectual</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[learning]" id="learning" value="1">
                                        <label class="form-check-label" for="learning">Learning</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[medical_condition]" id="medical_condition" value="1">
                                        <label class="form-check-label" for="medical_condition">Medical Condition </label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[mental_illness]" id="mental_illness" value="1">
                                        <label class="form-check-label" for="mental_illness">Mental Illness</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[not_specified]" id="not_specified" value="1">
                                        <label class="form-check-label" for="not_specified"> Not Specified </label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input disability-indicate" type="checkbox" name="disability_indicate[other]" id="other" value="1">
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <span class="error disability_indicate_error"></span>
                                </div>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-12">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label" for="full_time_employee">Do you need any additional support? </label>
                                    </div>
                                    <div class="col-xs-12 col-md-6 form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input additional-support" type="radio" name="additional_support" id="additional_support_yes" value="1">
                                            <label class="form-check-label" for="additional_support_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input additional-support" type="radio" name="additional_support" id="additional_support_no" value="0">
                                            <label class="form-check-label" for="additional_support_no">No</label>
                                        </div>     
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-12 specify-support-required d-none">
                                    <label for="specify_support_required">Specify support required : </label>
                                    <input type="text" class="form-control" id="specify_support_required" name="specify_support_required" placeholder="Specify support required ">
                                    <span class="error specify_support_required_error"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-md-offset-3 col-sm-12">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" > D.Language and Literacy  </h6>
                        </div>

                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">Choose the word which best describes the highlighted word in the sentence. </label>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">The caterpillar <b>camouflaged</b> itself on the leaves.  </label>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="highlighted_camouflaged" id="hidden" value="hidden">
                                        <label class="form-check-label" for="hidden">hidden </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="highlighted_camouflaged" id="disguised" value="disguised">
                                        <label class="form-check-label" for="disguised">disguised  </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="highlighted_camouflaged" id="located" value="located">
                                        <label class="form-check-label" for="located">located</label>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">The trainee <b>carried out</b> the tasks to a high standard </label>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="highlighted_carried_out" id="performed" value="performed">
                                        <label class="form-check-label" for="performed">performed</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="highlighted_carried_out" id="assessed" value="assessed">
                                        <label class="form-check-label" for="assessed">assessed </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="highlighted_carried_out" id="set_up" value="set_up">
                                        <label class="form-check-label" for="set_up"> set up</label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">You are eating at a restaurant and the bill is $150.00 You need to split the bill between 6 people. How much does each person have to pay?</label>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="restaurant_bill" id="bill_5_5" value="5.50">
                                        <label class="form-check-label" for="bill_5_5">$5.50</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="restaurant_bill" id="bill_25" value="25.00">
                                        <label class="form-check-label" for="bill_25">$25.00</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="restaurant_bill" id="bill_7_5" value="7.50">
                                        <label class="form-check-label" for="bill_7_5"> $7.50</label>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">You start work at 10am in the morning. Your manager tells you on your arrival that your half hour lunch break will commence in 3 ½ hours. What time will your lunch break start? </label>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="lunch_break" id="lunch_break_2" value="2">
                                        <label class="form-check-label" for="lunch_break_2">2pm </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="lunch_break" id="lunch_break_2_30" value="2.30">
                                        <label class="form-check-label" for="lunch_break_2_30">2:30pm</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="lunch_break" id="lunch_break_1_30" value="1.30">
                                        <label class="form-check-label" for="lunch_break_1_30"> 1:30pm</label>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">If there is currently $139.50 petty cash in the tin, how much do I need to withdraw from the bank to make $200 in the tin? </label>
                                </div>
                                <div class="form-group col-xs-12 col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="withdraw" id="withdraw _60_50" value="60.50">
                                        <label class="form-check-label" for="withdraw _60_50">$60.50  </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="withdraw" id="withdraw_67_50" value="67.50">
                                        <label class="form-check-label" for="withdraw_67_50"> $67.50 </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="withdraw" id="withdraw_63_50" value="63.50">
                                        <label class="form-check-label" for="withdraw_63_50">$63.50</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" > E.Education </h6>
                        </div>

                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">What is your highest level of education COMPLETED? </label>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="education_completed" id="currently_attending" value="currently_attending">
                                        <label class="form-check-label" for="currently_attending">Currently Attending  </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="education_completed" id="year_8_or_elow" value="year_8_or_elow">
                                        <label class="form-check-label" for="year_8_or_elow">Year 8 or Below  </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="education_completed" id="completed_ear_9_or_equivalent" value="completed_ear_9_or_equivalent">
                                        <label class="form-check-label" for="completed_ear_9_or_equivalent">Completed Year 9 or Equivalent</label>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="education_completed" id="completed_ear_10_or_equivalent" value="completed_ear_10_or_equivalent">
                                        <label class="form-check-label" for="completed_ear_10_or_equivalent">Completed Year 10 or Equivalent </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="education_completed" id="completed_ear_11_or_equivalent" value="completed_ear_11_or_equivalent">
                                        <label class="form-check-label" for="completed_ear_11_or_equivalent">Completed Year 11 or Equivalent </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="education_completed" id="completed_ear_12_or_equivalent" value="completed_ear_12_or_equivalent">
                                        <label class="form-check-label" for="completed_ear_12_or_equivalent">Completed Year 12 or Equivalent </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="education_year_completed">Year Completed:  </label>
                                        <input type="number" class="form-control" id="education_year_completed" name="education_year_completed" placeholder="Completed year"  min='1'>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="education_month_completed">Month Completed:  </label>
                                        <input type="number" class="form-control" id="education_month_completed" name="education_month_completed" placeholder="Completed month" min='1' max='12'>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" > F.Training </h6>
                        </div>

                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">Have you completed any other courses / qualifications? (Specify Below) </label>
                                </div>
                                <div class="col-xs-12 col-md-12 form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input highest-level-education" type="radio" name="highest_level_education_completed" id="highest_level_of_education_yes" value="1">
                                        <label class="form-check-label" for="highest_level_of_education_yes">Yes </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input highest-level-education" type="radio" name="highest_level_education_completed" id="highest_level_of_education_no" value="0">
                                        <label class="form-check-label" for="highest_level_of_education_no">No </label>
                                    </div>
                                </div>
                                
                                <div class="row qualification d-none">
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="">Qualification Level</label>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <label for="">Discipline /Subject Area </label>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input checked-qualification" type="checkbox" name="certificate[certificate_1]" id="certificate_1" value="1">
                                            <label class="form-check-label" for="certificate_1">Certificate I</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <input type="text" class="form-control" id="discipline_certificate_1" name="certificate_discipline[certificate_discipline_1]" placeholder="Certificate I subject area">
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input checked-qualification" type="checkbox" name="certificate[certificate_2]" id="certificate_2" value="1">
                                            <label class="form-check-label" for="certificate_2">Certificate II</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <input type="text" class="form-control" id="discipline_certificate_2" name="certificate_discipline[certificate_discipline_2]" placeholder="Certificate II subject area">
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input checked-qualification" type="checkbox" name="certificate[certificate_3]" id="certificate_3" value="1">
                                            <label class="form-check-label" for="certificate_3">Certificate III </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <input type="text" class="form-control" id="discipline_certificate_3" name="certificate_discipline[certificate_discipline_3]" placeholder="Certificate III subject area">
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input checked-qualification" type="checkbox" name="certificate[certificate_4]" id="certificate_4" value="1">
                                            <label class="form-check-label" for="certificate_4">Certificate III </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <input type="text" class="form-control" id="discipline_certificate_4" name="certificate_discipline[certificate_discipline_4]" placeholder="Certificate IV subject area">
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input checked-qualification" type="checkbox" name="certificate[adv_Diploma]" id="adv_Diploma" value="1">
                                            <label class="form-check-label" for="adv_Diploma">Diploma/Adv Diploma  </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <input type="text" class="form-control" id="discipline_adv_Diploma" name="certificate_discipline[certificate_adv_Diploma]" placeholder="Diploma/Adv Diploma">
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input checked-qualification" type="checkbox" name="certificate[bachelor]" id="bachelor" value="1">
                                            <label class="form-check-label" for="bachelor">Bachelor</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <input type="text" class="form-control" id="discipline_bachelor" name="certificate_discipline[certificate_bachelor]" placeholder="Bachelor">
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input checked-qualification" type="checkbox" name="certificate[post_grad]" id="post_grad" value="1">
                                            <label class="form-check-label" for="post_grad">Post Grad </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <input type="text" class="form-control" id="discipline_post_grad" name="certificate_discipline[post_grad]" placeholder="Post Grad">
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input checked-qualification" type="checkbox" name="certificate[masters_doctorate]" id="masters_doctorate" value="1">
                                            <label class="form-check-label" for="masters_doctorate">Masters/Doctorate</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-12 col-md-6">
                                        <input type="text" class="form-control" id="discipline_masters_doctorate" name="certificate_discipline[masters_doctorate]" placeholder="Masters/Doctorate">
                                    </div>
                                  
                                    <div class="form-group col-xs-12 col-md-6">
                                        <span for="" class="error qualification_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" > G.Reason for Study</h6>
                        </div>

                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">Which of the following statements best describes your reason for enrolling in this course? </label>
                                </div>
                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="personal_interest" value="personal_interest">
                                        <label class="form-check-label" for="personal_interest">Personal Interest </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="to_get_a_job" value="to_get_a_job">
                                        <label class="form-check-label" for="to_get_a_job">To get a job </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="better_job_or_promotion" value="better_job_or_promotion">
                                        <label class="form-check-label" for="better_job_or_promotion"> I want extra skills for my job</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="extra_skills" value="extra_skills">
                                        <label class="form-check-label" for="extra_skills">To get a better job or promotion </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="requirement" value="requirement">
                                        <label class="form-check-label" for="requirement"> Requirement of my job</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="other_reason" value="other_reason">
                                        <label class="form-check-label" for="other_reason">  Other: (Please identify)</label>
                                    </div>
                                </div>

                                <div class="form-group col-xs-12 col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="own_business " value="own_business">
                                        <label class="form-check-label" for="own_business "> To start my own business </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="existing_business " value="existing_business">
                                        <label class="form-check-label" for="existing_business "> To develop my existing business </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="another_career" value="another_career">
                                        <label class="form-check-label" for="another_career">To try another career </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="vocational_requirements" value="vocational_requirements">
                                        <label class="form-check-label" for="vocational_requirements"> Meet CPD / license / vocational requirements </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input enrolling-reason" type="radio" name="enrolling_reason" id="gain_qualification" value="gain_qualification">
                                        <label class="form-check-label" for="gain_qualification">To gain a qualification
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-xs-12 col-md-6 enrolling-other-reason d-none">
                                    <input class="form-control" type="text" name="enrolling_other_reason" id="enrolling_other_reason" value="" placeholder="Please enter other reason">
                                    <span for="" class="error enrolling_other_reason_error"></span>
                                |</div>
                            </div>
                        </div>

                        <div class="panel-heading display-table" >
                            <h6 class="panel-title" >Section 6 – Identification </h6>
                        </div>

                        <div class="panel-body">
                            <div class='form-row row'>
                                <div class="form-group col-xs-12 col-md-12">
                                    <label for="">Provide at least ONE form of ID (e.g. Driver’s License) (Admin Staff will need to sight your ID) </label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="identification_id_type">ID Type: </label>
                                        <input type="text" class="form-control" id="identification_id_type" name="identification_id_type" placeholder="ID Type">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="identification_id">ID #: </label>
                                        <input type="text" class="form-control" id="identification_id" name="identification_id" placeholder="ID">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="identification_id_sighted">ID Sighted (Admin to sign):  </label>
                                        <input type="text" class="form-control" id="identification_id_sighted" name="identification_id_sighted" placeholder="ID Sighted (Admin to sign)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary btn-lg btn-block col-sm-3 pull-right" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('user/assets/js/v2.js?v='.time()) }}"></script>
    <script src="{{ asset('cp/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/enrolment.js?v='.time()) }}"></script>
@endpush
