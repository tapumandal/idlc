
function isIdlcEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

$('#mobile_no').focusout(function(e){
    var mobile_number = $('input[name=mobile_no]').val();
    var _token = $('input[name=_token]').val();
    if(!$.isNumeric(mobile_number)){
        $('.validation_error_msg').empty();
        $('.alert-danger').show();
        $('#unique_input_error').modal('show');
        $('.validation_error_msg').append("Only Number is allowed.");
        $("#mobile_no").val("").focus();
    }else if(mobile_number.length != 9){
        $('.validation_error_msg').empty();
        $('.alert-danger').show();
        $('#unique_input_error').modal('show');
        $('.validation_error_msg').append("Only allowed Nine Digit.");
        $("#mobile_no").val("").focus();
    }else if(mobile_number.length == 9){
        $.ajax({
            type: "POST",
            url: "/value/check/mobile",
            data: {mobile_number: mobile_number, _token:_token},
            datatype: 'json',
            cache: false,
            async: false,
            success: function (result) {
                if(result.status == 'exists' && $('.mobile_no_box .alert-danger').length == 0){
                    $('.validation_error_msg').empty();
                    $('.alert-danger').show();
                    $('#unique_input_error').modal('show');
                    $('.validation_error_msg').append(result.message);
                    $("#mobile_no").val("").focus();

                }else if(result.status == 'unique'){
                    // for input lebel
                    $('.mobile_no_box .alert-danger').remove();

                    // for modal
                    $('#unique_input_error').modal('hide');
                }
            },
            error: function (result) {
                $('.validation_error_msg').empty();
                $('.alert-danger').show();
                $('#unique_input_error').modal('show');
                $('.validation_error_msg').append("The Mobile Number Is Not Valid");
                $("#mobile_no").val("").focus();
            }
        });
    }else if(mobile_number == '') {
        $('.validation_error_msg').empty();
        $('.alert-danger').show();
        $('#unique_input_error').modal('show');
        $('.validation_error_msg').append("You can not leave with empty Value.");
        $('#mobile_no').val("").focus();
    }else{
        // for modal
        $('#unique_input_error').modal('hide');

        // for input lebel
        $('.mobile_no_box .alert-danger').remove();
    }
});




$('#email').focusout(function(e){
    var email = $('#email').val();
    var _token = $('input[name=_token]').val();

    if(isIdlcEmail(email))
    {
        $('#unique_input_error').modal('hide');
        $.ajax({
            type: "POST",
            url: "/value/check/email",
            data: {email: email, _token:_token},
            datatype: 'json',
            cache: false,
            async: false,
            success: function (result) {
                if(result.status == 'exists' && $('.email_box .alert-danger').length == 0){
                    $('.validation_error_msg').empty();
                    $('.alert-danger').show();
                    $('#unique_input_error').modal('show');
                    $('.validation_error_msg').append(result.message);
                    $('#email').val("").focus();

                }else if(result.status == 'unique'){
                    $('.email_box .alert-danger').remove();
                }
                
            },
            error: function (result) {
                $('.validation_error_msg').empty();
                $('.alert-danger').show();
                $('#unique_input_error').modal('show');
                $('.validation_error_msg').append("Please Input Valid Email Address.");
                $('#email').val("").focus();
            }
        });
    }else if(email == '') {
        $('.validation_error_msg').empty();
        $('.alert-danger').show();
        $('#unique_input_error').modal('show');
        $('.validation_error_msg').append("You can not leave with empty Value.");
        $('#email').val("").focus();
    }else{
        $('.validation_error_msg').empty();
        $('.alert-danger').show();
        $('#unique_input_error').modal('show');
        $('.validation_error_msg').append("Please Input Valid Email Address.");
        $('#email').val("").focus();
    }
});





$('#national_id_card_no').focusout(function(e){
    var national_id_card_no = $('#national_id_card_no').val();
    var _token = $('input[name=_token]').val();
    var valid_nid_len = [10,13,17];
    var nid_len = national_id_card_no.length;
    if(national_id_card_no == '') {
           $('.validation_error_msg').empty();
           $('.alert-danger').show();
           $('#unique_input_error').modal('show');
           $('.validation_error_msg').append("You can not leave with empty Value.");
           $('#national_id_card_no').val("").focus();
    }else if($.inArray(nid_len, valid_nid_len) == -1)
    {
        $('.validation_error_msg').empty();
        $('.alert-danger').show();
        $('#unique_input_error').modal('show');
        $('.validation_error_msg').append("Only allowed 10,13,17 digit.");
        $("#national_id_card_no").val("").focus();
    }else if(!$.isNumeric(national_id_card_no))
    {
        $('.validation_error_msg').empty();
        $('.alert-danger').show();
        $('#unique_input_error').modal('show');
        $('.validation_error_msg').append("Only Number is allowed.");
        $("#national_id_card_no").val("").focus();
    }else{
        // for modal
        $('#unique_input_error').modal('hide');

        $.ajax({
            type: "POST",
            url: "/value/check/national_id_card_no",
            data: {national_id_card_no: national_id_card_no, _token:_token},
            datatype: 'json',
            cache: false,
            async: false,
            success: function (result) {
                if(result.status == 'exists' && $('.nid_box .alert-danger').length == 0){              
                    // For Modal
                    $('.validation_error_msg').empty();
                    $('.alert-danger').show();
                    $('#unique_input_error').modal('show');
                    $('.validation_error_msg').append(result.message);
                    $('#national_id_card_no').val("").focus();            
                }else if(result.status == 'unique'){
                    $('.nid_box .alert-danger').remove();
                }
            },
            error: function (result) {
                $('.validation_error_msg').empty();
                $('.alert-danger').show();
                $('#unique_input_error').modal('show');
                $('.validation_error_msg').append("NID Is Not Valid");
                $('#national_id_card_no').val("").focus();  
            }
        });
    }
});


$(function () {
    var dt = new Date();
    dt.setFullYear(new Date().getFullYear()-18);

    $('#date_of_birth').datepicker(
        {
            viewMode: "years",
            // endDate : dt
        }
    );
});


$('#date_of_birth').focusout(function(e){
    var date_of_birth = $('#date_of_birth').val();
    var _token = $('input[name=_token]').val();
    if(date_of_birth != ''){
        if((typeof date_of_birth.split("/")[0] != "undefined") && (typeof date_of_birth.split("/")[1] != "undefined") && (typeof date_of_birth.split("/")[2] != "undefined")){
            var day = date_of_birth.split("/")[1];
            var month = date_of_birth.split("/")[0];
            var year = date_of_birth.split("/")[2];
            var age = 18;
            var mydate = new Date();
            mydate.setFullYear(year, month-1, day);
            var currdate = new Date();
            var setDate = new Date();        
            setDate.setFullYear(mydate.getFullYear() + age,month-1, day);
            if ((currdate - setDate) > 0){
                var avobe = '';
            }else{
                $('.validation_error_msg').empty();
                $('.alert-danger').show();
                $('#unique_input_error').modal('show');
                $('.validation_error_msg').append("You must have to be 18 Years Old.");
                $('#date_of_birth').val("").focus();
            }
        }
    }
});

$('#user_type').change(function(){
    // alert('changed');
    $('.user_type_input').css('display', 'none');
    var inputAppeard = $('select[name=user_type]').val();
    $('.'+inputAppeard).css('display', 'block');

});
