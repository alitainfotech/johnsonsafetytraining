$(document).ready(function () {
  var validForm = false;

  SubmittingForm = function () 
{    
     //Validate Statements...
     validForm = true;
     $("#enrollment-form'").submit();
}

  $('#enrollment-form').validate({ // initialize the plugin
    rules: {
          phone_no: {
              required: true,
              minlength: 10
          },
          emergeny_name: {
            required: true,
          },
          emergeny_relationship: {
            required: true,
          },
          emergeny_tel: {
            required: true,
            minlength: 10
          },
          emergeny_mobile: {
            required: true,
            minlength: 10
          },
          employee_status: {
            required: true,
          },
          // employment_company: {
          //   required: true,
          // },
          employment_email: {
            // required: true,
            email: true
          },
          // employment_contact_person: {
          //   required: true,
          // },
          // employment_work_on: {
          //   required: true,
          // },
          australian_citizen: {
            required: true,
          },
          english_language: {
            required: true,
          },
          speak_english: {
            required: true,
          },
          indigenous_status:{
            required: true,
          },
          disability_status: {
            required: true,
          },
          highlighted_camouflaged: {
            required: true,
          },
          highlighted_carried_out: {
            required: true,
          },
          restaurant_bill: {
            required: true,
          },
          lunch_break: {
            required: true,
          },
          withdraw: {
            required: true,
          },
          education_completed: {
            required: true,
          },
          education_year_completed: {
            required: true,
            maxlength: 4,
            minlength: 4,
          },
          education_month_completed: {
            required: true,
            maxlength: 2,
            range:[1,12]
          },
          highest_level_education_completed : {
            required: true,
          },
          enrolling_reason : {
            required: true,
          },
          identification_id_type : {
            required: true,
          },
          identification_id : {
            required: true,
          },
          identification_id_sighted : {
            required: true,
          }
      },

      errorPlacement: function (error, element) {
        // if(element.attr("name") == 'employee_status') {
        //     error.insertAfter(".employee_status_error");
        // }
        error.addClass('errorMsq');
        element.parent().parent().append(error);
      },
  });
  $("#enrollment-form").submit(function(event) {
    var usi = $('input[name="usi"]:checked').val();
    $('.usi_no_error').text('')
    if(usi == 1){
      var usi_no = $('#usi_no').val();
      if(usi_no ==''){
        $('.usi_no_error').text('This field is required.');
        return false
      }
    }

    var employee_status = $('input[name="employee_status"]:checked').val();
    if(employee_status == 'seeking_full_time' || employee_status == 'seeking_part_time' || employee_status == 'not_seeking_employment'){
        var employment_company = $('#employment_company').val();
        var employment_email = $('#employment_email').val();
        var employment_contact_person = $('#employment_contact_person').val();
        var employment_work_on = $('#employment_work_on').val();
        $(".employment_company_error").text('');
        $(".employment_email_error").text('');
        $(".employment_contact_person_error").text('');
        $(".employment_work_on_error").text('');
        if(employment_company == ''){
          $(".employment_company_error").text('This field is required.');
          return false
        }
        if(employment_email == ''){
          $(".employment_email_error").text('This field is required.');
          return false
        }
        if(employment_contact_person == ''){
          $(".employment_contact_person_error").text('This field is required.');
          return false
        }
        if(employment_work_on == ''){
          $(".employment_work_on_error").text('This field is required.');
          return false
        }
    }

    var australian_citizen = $('input[name="australian_citizen"]:checked').val();
    if(australian_citizen == 0){
      $(".country_of_birth_error").text('');
      $(".visa_classification_error").text('');
      var country_of_birth = $('#country_of_birth').val()
      var visa_classification = $('#visa_classification').val()
      if(country_of_birth == ''){
        $(".country_of_birth_error").text('This field is required.');
        return false
      }
      if(visa_classification == ''){
        $(".visa_classification_error").text('This field is required.');
        return false
      }
    }
    var language_usually_speak = $('input[name="english_language"]:checked').val();
    if(language_usually_speak =="0"){
      $(".language_usually_speak_error").text('');
      var language_usually_speak = $('#language_usually_speak').val()
      if(language_usually_speak == ''){
        $(".language_usually_speak_error").text('This field is required.');
        return false
      }
    }

    $('.disability_indicate_error').text('');
    var disability_indicate = $('input[name="disability_status"]:checked').val();
    if(disability_indicate == 1){
      var checkedNum = $('.disability-indicate:checked').length;
      if(checkedNum <= 0){
        $('.disability_indicate_error').text('This field is required.')
        return false
      }
    }
    var language_usually_speak = $('input[name="additional_support"]:checked').val();
    $(".specify_support_required_error").text('');
    if(language_usually_speak =="1"){
      var specify_support_required = $('#specify_support_required').val();
      if(specify_support_required == '' ){
        $(".specify_support_required_error").text('This field is required.');
        return false
      }
    }

    var highest_level_education_completed = $('input[name="highest_level_education_completed"]:checked').val();
    if(highest_level_education_completed == "1"){
      var checkedEducation = $('.checked-qualification:checked').length;
      $('.qualification_error').text('');
      if(checkedEducation <= 0){
        $('.qualification_error').text('Please select one or more field.');
        return false
      }
    }
    var enrolling_reason = $('input[name="enrolling_reason"]:checked').val();
    $('.enrolling_other_reason_error').text('');
    if(enrolling_reason =="other_reason"){
      var enrolling_reason = $('#enrolling_reason').val();
      if(enrolling_reason == ''){
        $('.enrolling_other_reason_error').text('This field is required.');
        return false
      }
    } 
    // event.submit();
  })

  $('#usi').click(function() {
    if ($(this).is(':checked')) {
      $('.usi-no').removeClass('d-none');
    }else{
      $('.usi-no').addClass('d-none');
    }
  });

  $(".employee-status").change(function(){
      if($(this).val()=="seeking_full_time" || $(this).val()=="seeking_part_time" || $(this).val()=="not_seeking_employment"){
        $(".employment-detail").removeClass('d-none');
      }else{
        $(".employment-detail").addClass('d-none');
      }
  });

  $(".check-australian-citizen").change(function(){
    if($(this).val()=="0"){
      $(".australian-citizen").removeClass('d-none');
    }else{
      $(".australian-citizen").addClass('d-none');
    }
});

  $(".check-english-language").change(function(){
    if($(this).val()=="0"){
      $(".language-usually-speak").removeClass('d-none');
    }else{
      $(".language-usually-speak").addClass('d-none');
    }
  });

  $(".disability-status").change(function(){
    if($(this).val()=="1"){
      $(".disability-indicate-data").removeClass('d-none');
    }else{
      $(".disability-indicate-data").addClass('d-none');
    }
  });

  $(".additional-support").change(function(){
    if($(this).val()=="1"){
      $(".specify-support-required").removeClass('d-none');
    }else{
      $(".specify-support-required").addClass('d-none');
    }
  });

  $(".highest-level-education").change(function(){
    if($(this).val()=="1"){
      $(".qualification").removeClass('d-none');
    }else{
      $(".qualification").addClass('d-none');
    }
  });

  
  $(".enrolling-reason").change(function(){
    if($(this).val()=="other_reason"){
      $(".enrolling-other-reason").removeClass('d-none');
    }else{
      $(".enrolling-other-reason").addClass('d-none');
    }
  });



});
