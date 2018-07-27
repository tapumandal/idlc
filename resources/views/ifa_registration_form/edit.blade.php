<?php //echo public_path();exit;                                                     ?>

@extends('layouts.idlc_aml.app')
@section('content')
<style type="text/css">
    body {
        position: relative;
    }
    .nav-pills{
        border : 1px solid #DDD;
        background: #ce2327;
    }
    .nav > li >a{
        color:#fff;
        text-align: center;
    }
    .nav-pills > li.active > a,
    .nav-pills > li.active > a:focus,
    .nav-pills > li.active > a:hover {
        color: #fff;
        background-color: maroon;
    }

    .nav > li > a:focus,
    .nav > li > a:hover {
        text-decoration: none;
        background-color: maroon;
    }
    .nav .li_1{
        width: 31.3%;
    }

    @media(max-width: 580px){
        .nav .li_1{
            width: 100%;
        }
        .nav li{
            width: 100%;
        }
    }
</style>

<div class="col-sm-4 col-sm-offset-4">

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert"  id="">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong id="">{{ $errors->first() }}</strong>
    </div>
    @endif

        @if(session()->has('ifa_registration_success_message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>{{ session()->pull('ifa_registration_success_message') }}</strong>
            </div>
        @endif

    <form method="POST" action="{{route('ifa_registration.postEdit')}}" accept-charset="UTF-8" class="form-signin">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">

        <div class="form-group has-feedback{{ $errors->has('application_no') ? ' has-error' : ''}}">
            {{-- <input type="text" id="application_no" name="application_no" class="form-control" placeholder="Application No." value="" required autofocus/> --}}
            <input type="text" id="application_no" name="mobile_no" class="form-control" placeholder="Mobile No" value="" required autofocus/>
            <span class="glyphicon glyphicon-list form-control-feedback"></span>
            @if($errors->has('application_no'))
            <span class="help-block">{{ $errors->first('application_no') }}</span>
            @endif
        </div>

        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : ''}}">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if($errors->has('password'))
            <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="row">

            <div class="col-xs-12 text-center">
                <button type="submit" class="btn btn-danger btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
        </div>
    </form>

</div>


@endsection


@section("addscript")
<script>

    $(function () {

        var prevText = '';
        var formId = '';
        var datatxt = '';
        var dataelm = '';
        $('.btnFormSubmit').click(function () {
            prevText = $(this).val();
            datatxt = $(this).data("txt");
            dataelm = $(this);
            formId = $(this).closest('form').attr('id');
        });

        $(document).on({
            ajaxStart: function () {
                dataelm.attr({value: 'Processing...', disabled: 'disabled'});
            },
            ajaxStop: function () {
                dataelm.removeAttr("disabled");
                dataelm.val(datatxt);
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {

                    $('.uploaded_picture_preview_div').html('');
                    $('.uploaded_picture_preview_div').prepend($('<img>', {id: 'uploaded_picture_preview', src: e.target.result, alt: 'Uploaded Picture Preview', width: 100}));
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('input[type=radio][name=is_same_as_present_address]').change(function () {
            var flag = this.value;
            $('.is_same_as_present_address_flag_yes').css('display', (flag === 'yes' ? 'none' : ''));
        });

        $('input[type=radio][name=job_holder]').change(function () {
            var flag = this.value;
            $('.job_holder_flag_yes').css('display', (flag === 'yes' ? '' : 'none'));
        });

        $('input[type=radio][name=student]').change(function () {
            var flag = this.value;
            $('.student_flag_yes').css('display', (flag === 'yes' ? '' : 'none'));
        });

        $('input[type=radio][name=receive_sales_commission_by]').change(function () {
            var flag = this.value;
            if (flag === 'Bank') {
                $('.receive_sales_commission_by_flag_Bank').css('display', '');
                $('.receive_sales_commission_by_flag_bKash').css('display', 'none');
            } else if (flag === 'bKash') {
                $('.receive_sales_commission_by_flag_Bank').css('display', 'none');
                $('.receive_sales_commission_by_flag_bKash').css('display', '');
            }

        });
        $('#upload_picture').change(function () {
            readURL(this);
        });

        $('form').submit(function () {

            $(this).find('.form-group').removeClass('has-error');
            $(this).find('span[class*="help-block"]').remove();

            $('#success_message_alert').css('display', 'none');

            var form_action = $(this).attr('action');
            var form_method = $(this).attr('method');
            var form_data = new FormData(this);

            $.ajax({
                type: form_method,
                url: form_action,
                data: form_data,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {

                    $('body').scrollspy({target: '#myScrollspy'});

                    if (response.has_error === true) {

                        $.each(response.error_messages, function (key, value) {

                            $('#' + key).closest('div[class^="form-group"]').addClass('has-error');
                            var hasClassInputGroup = $('#' + key).closest('div').hasClass('input-group');
                            var after_append = hasClassInputGroup === true ? $('#' + key).closest('div') : $('#' + key);
                            after_append.after($('<span />', {class: 'help-block', text: value}));
                        });
                    } else if (response.has_success === true) {

                        if (response.success_messages.enable_step == 1) {
                            window.location.href = "{{ route('ifa_registration.edit') }}";
                        }

                        var application_no = response.success_messages.application_no;
                        var step = response.success_messages.enable_step;
                        var enable_steps_id = response.success_messages.enable_steps_id;
                        var disable_steps_id = response.success_messages.disable_steps_id;

                        $('#success_message_alert').css('display', '');
                        $('#success_message_msg').html('Data successfully saved. Application no. : ' + application_no);
                        if (datatxt == 'Submit') {
                            $('.nav-tabs').find('a[href="#' + enable_steps_id[0] + '"]').closest('li').addClass('active').removeClass('disabled');
                            $('.nav-tabs').find('a[href="#' + enable_steps_id[0] + '"]').attr('data-toggle', 'tab');
                            $('.tab-content').find('#' + enable_steps_id[0]).addClass('in').addClass('active');

                            for (var disable_step_count = 0; disable_step_count < disable_steps_id.length; disable_step_count++) {
                                $('.nav-tabs').find('a[href="#' + disable_steps_id[disable_step_count] + '"]').closest('li').removeClass('active').addClass('disabled');
                                $('.nav-tabs').find('a[href="#' + disable_steps_id[disable_step_count] + '"]').removeAttr('data-toggle', 'tab');
                                $('.tab-content').find('#' + disable_steps_id[disable_step_count]).removeClass('in').removeClass('active');
                            }
                        }
                        $('#ifa_registration_form_step_' + step).find('input[name="application_no"]').val(application_no);
                        $('#ifa_registration_form_step_' + step).find('input[name="step"]').val(step);
                    }
                },
                error: function () {

                }
            });

            return false;
        });


        var thanasDistrict = (function () {
            return {
                init: function () {
                    $('.division_id').on('change', function () {

                        var whereToAppend = $(this).closest('div').parent().next().find('.district_id');
//                        console.log($(this).closest('div').parent().next().attr('class'));

                        var selectedValue = $.trim($(this).find(":selected").val());
                        $.ajax({
                            type: "GET",
                            url: baseURL + "/get/division",
                            data: "district_id=" + selectedValue,
                            datatype: 'json',
                            cache: false,
                            async: false,
                            success: function (result) {
                                var data = JSON.parse(result);
                                if (data.length === 0)
                                {
                                    whereToAppend.html($('<option>', {
                                        value: '',
                                        text: 'Choose District'
                                    }));

                                } else {
                                    whereToAppend.html($('<option>', {
                                        value: "",
                                        text: "Select District"
                                    }));
                                    for (ik in data) {
                                        whereToAppend.append($('<option>', {
                                            value: data[ik].district_id,
                                            text: data[ik].district_name
                                        }));
                                    }
                                }
                            },
                            error: function (result) {
                                alert("Some thing is Wrong");
                            }
                        });
                    });
                }
            };
        })();

        var divDisThanas = (function () {

            return{
                init: function () {

                    var divisionValue = '';

                    $('.division_id').on('change', function () {
                        divisionValue = $.trim($(this).find(":selected").val());
                    });

                    $('.district_id').on('change', function () {

                        var whereToAppend = $(this).closest('div').parent().next().find('.thana_id');
                        var districtValue = $.trim($(this).find(":selected").val());

                        $.ajax({
                            type: "GET",
                            url: baseURL + "/get/div/dis/thanas",
                            data: {division_id: divisionValue, district_id: districtValue},
                            datatype: 'json',
                            cache: false,
                            async: false,
                            success: function (result) {
                                var data = JSON.parse(result);
                                if (data.length === 0)
                                {
                                    whereToAppend.html($('<option>', {
                                        value: '',
                                        text: 'Choose Thana'
                                    }));

                                } else {
                                    whereToAppend.html($('<option>', {
                                        value: "",
                                        text: "Select Thana"
                                    }));
                                    for (ik in data) {
                                        whereToAppend.append($('<option>', {
                                            value: data[ik].thana_id,
                                            text: data[ik].thana_name
                                        }));
                                    }
                                }
                            },
                            error: function (result) {
                                alert("Some thing is Wrong");
                            }
                        });
                    })
                }
            }
        })();

        var getBankBranch = (function () {

            return {
                init: function () {
                    $('#bank').on('change', function () {
                        var bankValue = $.trim($("#bank").find(":selected").val());

                        $.ajax({
                            type: "GET",
                            url: baseURL + "/get/bank/branch",
                            data: {bank_id: bankValue},
                            datatype: 'json',
                            cache: false,
                            async: false,
                            success: function (result) {
                                var data = JSON.parse(result);
                                if (data.length === 0)
                                {
                                    $('#branch').html($('<option>', {
                                        value: '',
                                        text: 'Choose Branch'
                                    }));

                                } else {
                                    $('#branch').html($('<option>', {
                                        value: "",
                                        text: "Select Branch"
                                    }));
                                    for (ik in data) {
                                        $('#branch').append($('<option>', {
                                            value: data[ik].branch_id,
                                            text: data[ik].branch_name
                                        }));
                                    }
                                }
                            },
                            error: function (result) {
                                alert("Some thing is Wrong");
                            }
                        });
                    });
                }
            }
        })();

        thanasDistrict.init();
        divDisThanas.init();
        getBankBranch.init();

    });
</script>
@endsection
