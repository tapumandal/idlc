<?php //echo public_path();exit;               ?>

@extends('layouts.idlc_aml.app')
@section('content')
<style type="text/css">
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

<div class="col-sm-10 col-sm-offset-1">
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active<?php echo isset($application_no) && isset($step) ? ($step == 1 ? ' active' : '') : '' ?> li_1"><a href="#personal_profile" aria-controls="personal_profile" role="tab" data-toggle="tab" style="color:#FFF;">Personal Profile</a></li>
        <li class="<?php echo isset($application_no) && isset($step) ? ($step == 2 && $application_no != 0 ? ' active' : '') : '' ?> "><a href="#educational_professional_information" style="color:#FFF;" aria-controls="educational_professional_information" role="tab" data-toggle="tab">Educational / Professional Information</a></li>
        <li class="<?php echo isset($application_no) && isset($step) ? ($step == 3 && $application_no != 0 ? ' active' : '') : '' ?> "><a href="#bank_alternate_channel_information" style="color:#FFF;" aria-controls="bank_alternate_channel_information" role="tab" data-toggle="tab">Bank / Alternate Channel Information</a></li>
    </ul>


</div>


<div class="col-sm-8 col-sm-offset-2">
    <!--<form method="post" action="{{ route('ifa_registration.store') }}" runat="server" enctype="multipart/form-data">-->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="application_no" value="{{ $application_no }}">
        <input type="hidden" name="step" value="{{ $step }}">

        <div class="col-sm-12 tab-content">
            <div role="tabpanel" id="personal_profile" class="tab-pane fade in active<?php echo isset($application_no) && isset($step) ? ($step == 1 ? ' active' : '') : '' ?>">
                <form method="post" action="{{ route('ifa_registration.store') }}" runat="server" enctype="multipart/form-data">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Basic Profile Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile No.</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">+88 01</span>
                                        <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="father_name">Father's Name</label>
                                    <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Father's Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mother_name">Mother's Name</label>
                                    <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Mother's Name">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
                                    <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" data-provide="datepicker">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="national_id_card_no">National ID Card No.</label>
                                    <input type="text" class="form-control" id="national_id_card_no" name="national_id_card_no" placeholder="National ID Card No.">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="upload_picture">Upload Picture</label>
                                    <input type="file" id="upload_picture" name="upload_picture">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <img id="uploaded_picture_preview" src="#" alt="Uploaded Picture Preview" width="100" />
                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Address Details</h3>
                    </div>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <h4>Present Address : </h4>
                                <div class="form-group">
                                    <label for="present_address_flat_no">Flat No.</label>
                                    <input type="text" class="form-control" id="present_address_flat_no" name="present_address_flat_no" placeholder="Flat No.">
                                </div>
                                <div class="form-group">
                                    <label for="present_address_house_no">House No.</label>
                                    <input type="text" class="form-control" id="present_address_house_no" name="present_address_house_no" placeholder="House No.">
                                </div>
                                <div class="form-group">
                                    <label for="present_address_road_no">Road No.</label>
                                    <input type="text" class="form-control" id="present_address_road_no" name="present_address_road_no" placeholder="Road No.">
                                </div>

                                <div class="form-group">
                                    <label for="present_address_division">Division</label>
                                    <select class="form-control" id="present_address_division" name="present_address_division">
                                        <option value="0">Select any</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="present_address_district">District</label>
                                    <select class="form-control" id="present_address_district" name="present_address_district">
                                        <option value="0">Select any</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="present_address_po">Thana</label>
                                    <select class="form-control" id="present_address_po" name="present_address_po">
                                        <option value="0">Select any</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="present_address_premise_ownership">Premise Ownership</label>
                                    <input type="text" class="form-control" id="present_address_premise_ownership" name="present_address_premise_ownership" placeholder="Premise Ownership">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4>Permanent Address : </h4>
                                <div class="form-group">
                                    <label for="permanent_address_flat_no">Flat No.</label>
                                    <input type="text" class="form-control" id="permanent_address_flat_no" name="permanent_address_flat_no" placeholder="Flat No.">
                                </div>
                                <div class="form-group">
                                    <label for="permanent_address_house_no">House No.</label>
                                    <input type="text" class="form-control" id="permanent_address_house_no" name="permanent_address_house_no" placeholder="House No.">
                                </div>
                                <div class="form-group">
                                    <label for="permanent_address_road_no">Road No.</label>
                                    <input type="text" class="form-control" id="permanent_address_road_no" name="permanent_address_road_no" placeholder="Road No.">
                                </div>

                                <div class="form-group">
                                    <label for="permanent_address_division">Division</label>
                                    <select class="form-control" id="permanent_address_division" name="permanent_address_division">
                                        <option value="0">Select any</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="permanent_address_district">District</label>
                                    <select class="form-control" id="permanent_address_district" name="permanent_address_district">
                                        <option value="0">Select any</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="permanent_address_po">Thana</label>
                                    <select class="form-control" id="permanent_address_po" name="permanent_address_po">
                                        <option value="0">Select any</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="permanent_address_premise_ownership">Premise Ownership</label>
                                    <input type="text" class="form-control" id="permanent_address_premise_ownership" name="permanent_address_premise_ownership" placeholder="Premise Ownership">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div role="tabpanel"  id="educational_professional_information" class="tab-pane fade in active<?php echo isset($application_no) && isset($step) ? ($step == 2 && $application_no != 0 ? ' in active' : '') : '' ?>">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="latest_degree">Latest Degree</label>
                            <input type="text" class="form-control" id="latest_degree" name="latest_degree" placeholder="Latest Degree">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="last_educational_institution">Last Educational Institution</label>
                            <input type="text" class="form-control" id="last_educational_institution" name="last_educational_institution" placeholder="Last Educational Institution">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="job_holder">Job Holder</label><br/>
                            <label class="radio-inline">
                                <input type="radio" id="job_holder_yes" name="job_holder" value="yes"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="job_holder_no" name="job_holder" value="no" checked="checked"> No
                            </label>
                        </div>

                        <div class="form-group job_holder_flag_yes" style="display: none">
                            <label for="organization_name">Organization Name</label>
                            <input type="text" class="form-control" id="organization_name" name="organization_name" placeholder="Organization Name">
                        </div>

                        <div class="form-group job_holder_flag_yes" style="display: none">
                            <label for="employee_id_no">Employee ID No.</label>
                            <input type="text" class="form-control" id="employee_id_no" name="employee_id_no" placeholder="Employee ID No.">
                        </div>
                        <div class="form-group job_holder_flag_yes" style="display: none">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                        </div>
                        <div class="form-group job_holder_flag_yes" style="display: none">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" id="department" name="department" placeholder="Department">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="student">Student</label><br/>
                            <label class="radio-inline">
                                <input type="radio" id="student_yes" name="student" value="yes"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="student_no" name="student" value="no" checked="checked"> No
                            </label>
                        </div>

                        <div class="form-group student_flag_yes" style="display: none">
                            <label for="institution_name">Institution Name</label>
                            <input type="text" class="form-control" id="institution_name" name="institution_name" placeholder="Institution Name">
                        </div>

                        <div class="form-group student_flag_yes" style="display: none">
                            <label for="student_id_card_no">Student ID Card No.</label>
                            <input type="text" class="form-control" id="student_id_card_no" name="student_id_card_no" placeholder="Student ID Card No.">
                        </div>
                    </div>
                </div>




            </div>
            <div role="tabpanel"  id="bank_alternate_channel_information" class="tab-pane fade in active<?php echo isset($application_no) && isset($step) ? ($step == 3 && $application_no != 0 ? ' in active' : '') : '' ?>">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="receive_sales_commission_by">Receive Sales Commission By</label><br/>
                            <label class="radio-inline">
                                <input type="radio" id="receive_sales_commission_by_Bank" name="receive_sales_commission_by" value="Bank" checked="checked"> Bank
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="receive_sales_commission_by_bKash" name="receive_sales_commission_by" value="bKash"> bKash
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row receive_sales_commission_by_flag_Bank">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="bank">Bank</label>
                            <select class="form-control" id="bank" name="bank">
                                <option value="">Select any</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="branch">Branch</label>
                            <select class="form-control" id="branch" name="branch">
                                <option value="">Select any</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="account_no">A/C No.</label>
                            <input type="text" class="form-control" id="account_no" name="account_no" placeholder="A/C No.">
                        </div>
                    </div>
                </div>

                <div class="row receive_sales_commission_by_flag_bKash" style="display: none">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="bKash_account_type">bKash A/C Type</label><br/>
                            <label class="radio-inline">
                                <input type="radio" id="bKash_account_type_Agent" name="bKash_account_type" value="Agent" checked="checked"> Agent
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="bKash_account_type_Personal" name="bKash_account_type" value="Personal"> Personal
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="bKash_mobile_no">bKash Mobile No.</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon2">+88 01</span>
                                <input type="number" class="form-control" id="bKash_mobile_no" name="bKash_mobile_no" placeholder="bKash Mobile No." aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-6" style="padding-bottom:5px;">
                    <input type="submit" id="btnFormSubmit" class="btn btn-danger btn-block" value="Partially save & proceed to next step" />
                </div>
                <div class="col-sm-6">
                    <input type="button" class="btn btn-success btn-block" value="Partially save & cancel" />
                </div>
            </div>
        </div>

    </form>


</div>


@endsection



@section("addscript")
<script>

    $(function () {
        
        var prevText = $('#btnFormSubmit').val();
        $(document).on({
            ajaxStart: function () {
                $('#btnFormSubmit').attr({value: 'Processing...', disabled: 'disabled'});
            },
            ajaxStop: function () {
                $('#btnFormSubmit').removeAttr("disabled");
                $('#btnFormSubmit').attr({value: prevText});
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#uploaded_picture_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

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

                    if (response.has_error === true) {

                        $.each(response.error_messages, function (key, value) {

                            $('#' + key).closest('div[class^="form-group"]').addClass('has-error');
                            var hasClassInputGroup = $('#' + key).closest('div').hasClass('input-group');
                            var after_append = hasClassInputGroup === true ? $('#' + key).closest('div') : $('#' + key);
                            after_append.after($('<span />', {class: 'help-block', text: value}));
                        });
                    }
                    
                },
                error: function () {
                
                }
            });

            return false;
        });

    });
</script>
@endsection
