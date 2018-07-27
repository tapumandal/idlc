<?php //echo public_path();exit;                                                    ?>

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

    .required{
      color:red;
    }
</style>
<!-- Modal -->
  <div class="modal fade" id="unique_input_error" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        {{-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> --}}
        <div class="modal-body">
            <div class="alert-danger validation_error_msg" style="padding:10px; border-radius: 5px; text-align: center;" >
            </div>
            <div class="alert-success success_msg" style="padding:10px; border-radius: 5px; text-align: center;" >
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<div class="col-sm-12">
        <div class="create_validation_error alert alert-danger" role="alert" style="display: none;">

        </div>


    <div class="alert alert-success alert-dismissible" role="alert" style="display: none" id="success_message_alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong id="success_message_msg"></strong>
    </div>


    <ul class="nav nav-tabs">
        <li class="<?php echo isset($application_no) && isset($step) ? ($application_no == 0 && $step == 1 ? ' active' : '') : '' ?>"><a id="personal_profile_tab" <?php echo isset($application_no) && isset($step) ? ($step == 1 ? ' data-toggle="tab"' : '') : '' ?> href="#personal_profile">Personal Profile</a></li>
        <li class=""><a id="educational_professional_information_tab" href="#educational_professional_information" data-toggle="tab">Educational / Professional Information</a></li>
        <li class=""><a id="bank_alternate_channel_information_tab" href="#bank_alternate_channel_information" data-toggle="tab">Bank / Alternate Channel Information</a></li>
    </ul>

    <div class="tab-content">

        <div id="personal_profile" class="tab-pane fade <?php echo isset($application_no) && isset($step) ? ($application_no == 0 && $step == 1 ? ' in active' : '') : '' ?>">
            <form method="post" action="{{ route('ifa_registration.store') }}" runat="server" enctype="multipart/form-data" id="ifa_registration_form_step_1">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="application_no" value="{{ isset($application_no) ? $application_no : 0}}">
                <input type="hidden" name="step" value="{{ isset($step) ? $step : 1 }}">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Basic Profile Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group ">
                                    <label for="first_name ">First Name <span class="required">*</span></label>
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
                                    <label for="last_name">Last Name  <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile No.  <span class="required">*</span></label>
                                    <div class="input-group mobile_no_box">
                                        <span class="input-group-addon" id="basic-addon1">+88 01</span>
                                        <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." aria-describedby="basic-addon1" maxlength="9">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group email_box" >
                                    <label for="email">Email  <span class="required">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="father_name">Father's Name </label>
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
                                    <select class="form-control" id="nationality" name="nationality">
                                        <option value="0">Select any</option>
                                        <?php
if (isset($nationalities)) {
	foreach ($nationalities as $nt) {
		?>
                                                <option value="{{ $nt->id_nationality }}">{{ $nt->nationality }}</option>
                                                <?php
}
}
?>
<option value="-1">Others</option>
                                    </select>
                                </div>
                                <div class="form-group others_nationality_flag_yes" style="display: none;">
                                    <label for="others_nationality">Others Nationality</label>
                                    <input type="text" class="form-control" id="others_nationality" name="others_nationality" placeholder="Others Nationality">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth  <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth" data-provide="datepicker">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group nid_box">
                                    <label for="national_id_card_no">National ID Card No.  <span class="required">*</span></label>
                                    <input type="text" class="form-control" id="national_id_card_no" name="national_id_card_no" placeholder="National ID Card No.">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                        <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="user_type">User Type</label>
                                    <select class="form-control" id="user_type" name="user_type">
                                        <option value="">Select any</option>
                                        <?php
if (isset($user_types)) {
	foreach ($user_types as $nt) {
		?>
                                                <option value="{{ $nt->id_user_type }}">{{ $nt->user_type }}</option>
                                                <?php
}
}
?>
                                        <option value="-1">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group others_user_type_flag_yes" style="display: none;">
                                    <label for="others_user_type">Others User Type</label>
                                    <input type="text" class="form-control" id="others_user_type" name="others_user_type" placeholder="Others User Type">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="upload_picture">Upload Picture</label>
                                    <input type="file" id="upload_picture" name="upload_picture">
                                    <span class="help-block">Maximum file size 1024 kilobytes(1MB)</span>
                                </div>
                            </div>
                            <div class="col-sm-3 uploaded_picture_preview_div">
                                <!--<img id="uploaded_picture_preview" src="#" alt="Uploaded Picture Preview" width="100" />-->
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
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <h4>Present Address : </h4>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="present_address_premise_ownership">Premise Ownership</label>
                                                    <select class="form-control" id="present_address_premise_ownership" name="present_address_premise_ownership">
                                                        <option value="0">Select any</option>
                                                        <?php
if (isset($premise_ownerships)) {
	foreach ($premise_ownerships as $po) {
		?>
                                                                <option value="{{ $po->id_premise_ownership }}">{{ $po->premise_ownership }}</option>
                                                                <?php
}
}
?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="present_address_division">Division</label>
                                                    <select class="form-control division_id" id="present_address_division" name="present_address_division">
                                                        <option value="0">Select any</option>
                                                        <?php
if (isset($divisions)) {
	foreach ($divisions as $divs) {
		?>
                                                                <option value="{{ $divs->division_id }}">{{ $divs->division_name }}</option>
                                                                <?php
}
}
?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="present_address_district">District</label>
                                                    <select class="form-control district_id" id="present_address_district" name="present_address_district">
                                                        <option value="0">Select any</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="present_address_po">Thana</label>
                                                    <input type="text" class="form-control" id="present_address_po" name="present_address_po" placeholder="Thana">
                                                    {{-- <select class="form-control thana_id" id="present_address_po" name="present_address_po">
                                                        <option value="0">Select any</option>
                                                    </select> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="present_address_road_no">Road No.</label>
                                                    <input type="text" class="form-control" id="present_address_road_no" name="present_address_road_no" placeholder="Road No.">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="present_address_house_no">House No.</label>
                                                    <input type="text" class="form-control" id="present_address_house_no" name="present_address_house_no" placeholder="House No.">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="present_address_flat_no">Flat No.</label>
                                                    <input type="text" class="form-control" id="present_address_flat_no" name="present_address_flat_no" placeholder="Flat No.">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        <h4>Permanent Address : </h4>

                                        <div class="form-group">
                                            <label for="is_same_as_present_address">Same as present address?</label><br/>
                                            <label class="radio-inline">
                                                <input type="radio" id="is_same_as_present_address_yes" name="is_same_as_present_address" value="yes"> Yes
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" id="is_same_as_present_address_no" name="is_same_as_present_address" value="no" checked="checked"> No
                                            </label>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group is_same_as_present_address_flag_yes">
                                                    <label for="permanent_address_premise_ownership">Premise Ownership</label>
                                                    <select class="form-control" id="permanent_address_premise_ownership" name="permanent_address_premise_ownership">
                                                        <option value="0">Select any</option>
                                                        <?php
if (isset($premise_ownerships)) {
	foreach ($premise_ownerships as $po) {
		?>
                                                                <option value="{{ $po->id_premise_ownership }}">{{ $po->premise_ownership }}</option>
                                                                <?php
}
}
?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group is_same_as_present_address_flag_yes">
                                                    <label for="permanent_address_division">Division</label>
                                                    <select class="form-control division_id" id="permanent_address_division" name="permanent_address_division">
                                                        <option value="0">Select any</option>
                                                        <?php
if (isset($divisions)) {
	foreach ($divisions as $divs) {
		?>
                                                                <option value="{{ $divs->division_id }}">{{ $divs->division_name }}</option>
                                                                <?php
}
}
?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group is_same_as_present_address_flag_yes">
                                                    <label for="permanent_address_district">District</label>
                                                    <select class="form-control district_id" id="permanent_address_district" name="permanent_address_district">
                                                        <option value="0">Select any</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group is_same_as_present_address_flag_yes">
                                                    <label for="permanent_address_po">Thana</label>
                                                    <input type="text" class="form-control" id="permanent_address_po" name="permanent_address_po" placeholder="Thana">
                                                    {{-- <select class="form-control thana_id" id="permanent_address_po" name="permanent_address_po">
                                                        <option value="0">Select any</option>
                                                    </select> --}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group is_same_as_present_address_flag_yes">
                                                    <label for="permanent_address_road_no">Road No.</label>
                                                    <input type="text" class="form-control" id="permanent_address_road_no" name="permanent_address_road_no" placeholder="Road No.">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group is_same_as_present_address_flag_yes">
                                                    <label for="permanent_address_house_no">House No.</label>
                                                    <input type="text" class="form-control" id="permanent_address_house_no" name="permanent_address_house_no" placeholder="House No.">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group is_same_as_present_address_flag_yes">
                                                    <label for="permanent_address_flat_no">Flat No.</label>
                                                    <input type="text" class="form-control" id="permanent_address_flat_no" name="permanent_address_flat_no" placeholder="Flat No.">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group form-submit-buttons-div">
                    <div class="row">
                        <div class="col-sm-4" style="padding-bottom:5px;">
                            <input type="submit" data-txt="Save" class="btn btn-success btn-block btnFormSubmit save-btn" value="Save" />
                        </div>

                        <div class="col-sm-4">
                            <input type="submit" data-txt="Submit" class="btn btn-primary btn-block btnFormSubmit" value="Submit" />
                        </div>

                        <div class="col-sm-4">
                            <a href="{{ route('ifa_registration.index') }}" class="btn btn-danger btn-block" >Cancel</a>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div id="educational_professional_information" class="tab-pane fade">

            <form method="post" action="{{ route('ifa_registration.store') }}" runat="server" id="ifa_registration_form_step_2">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="application_no" value="{{ $application_no }}">
                <input type="hidden" name="step" value="{{ $step }}">

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
                            <label for="job_holder_department">Department</label>
                            <input type="text" class="form-control" id="job_holder_department" name="job_holder_department" placeholder="Job Holder Department">
                        </div>
                        <div class="form-group job_holder_flag_yes" style="display: none">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
                        </div>
                        <div class="form-group job_holder_flag_yes" style="display: none">
                            <label for="employee_id_no">Employee ID No.</label>
                            <input type="text" class="form-control" id="employee_id_no" name="employee_id_no" placeholder="Employee ID No.">
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
                            <label for="student_department">Department</label>
                            <input type="text" class="form-control" id="student_department" name="student_department" placeholder="Student's Department">
                        </div>
                        <div class="form-group student_flag_yes" style="display: none">
                            <label for="student_id_card_no">Student ID Card No.</label>
                            <input type="text" class="form-control" id="student_id_card_no" name="student_id_card_no" placeholder="Student ID Card No.">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="padding-bottom:5px;">
                            <input type="submit" data-txt="Save" class="btn btn-success btn-block btnFormSubmit" value="Save" />
                        </div>

                        <div class="col-sm-4">
                            <input type="submit" data-txt="Submit" class="btn btn-primary btn-block btnFormSubmit" value="Submit" />
                        </div>

                        <div class="col-sm-4">
                            <a href="{{ route('ifa_registration.index') }}" class="btn btn-danger btn-block" >Cancel</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div id="bank_alternate_channel_information" class="tab-pane fade">

            <form method="post" action="{{ route('ifa_registration.store') }}" runat="server" id="ifa_registration_form_step_3">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="application_no" value="{{ $application_no }}">
                <input type="hidden" name="step" value="{{ $step }}">

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
                                <?php
if (isset($banks)) {
	foreach ($banks as $bnks) {
		?>
                                        <option value="{{ $bnks->bank_id }}">{{ $bnks->bank_name }}</option>
                                        <?php
}
}
?>
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

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="padding-bottom:5px;">
                            <input type="submit" data-txt="Save" class="btn btn-success btn-block btnFormSubmit" value="Save" />
                        </div>

                        <div class="col-sm-4">
                            <input type="submit" data-txt="Submit" class="btn btn-primary btn-block btnFormSubmit" value="Submit" />
                        </div>

                        <div class="col-sm-4">
                            <a href="{{ route('ifa_registration.index') }}" class="btn btn-danger btn-block" >Cancel</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection


@section("addscript")
<script>

    $(function () {

        $("#personal_profile_tab").trigger("click");

        var prevText = '';
        var formId = '';
        var datatxt = '';
        var dataelm = '';
        $('.btnFormSubmit').click(function(){

            prevText = $(this).val();
            datatxt = $(this).data("txt");
            dataelm = $(this);
            formId = $(this).closest('form').attr('id');
        });

        $(document).on({
            ajaxStart: function () {
                if (typeof dataelm.attr !== "undefined") {
                    dataelm.attr({value: 'Processing...', disabled: 'disabled'});
                }
            },
            ajaxStop: function () {
                if (typeof dataelm.attr !== "undefined") {
                    dataelm.removeAttr("disabled");
                    dataelm.val(datatxt);
                }
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
            $('.is_same_as_present_address_flag_yes').css('display', (flag === 'yes' ? 'none' : 'block'));
        });

        $('input[type=radio][name=job_holder]').change(function () {
            var flag = this.value;
            $('.job_holder_flag_yes').css('display', (flag === 'yes' ? 'block' : 'none'));
        });

        $('input[type=radio][name=student]').change(function () {
            var flag = this.value;
            $('.student_flag_yes').css('display', (flag === 'yes' ? 'block' : 'none'));
        });

        $('input[type=radio][name=receive_sales_commission_by]').change(function () {
            var flag = this.value;
            if (flag === 'Bank') {
                $('.receive_sales_commission_by_flag_Bank').css('display', 'block');
                $('.receive_sales_commission_by_flag_bKash').css('display', 'none');
            } else if (flag === 'bKash') {
                $('.receive_sales_commission_by_flag_Bank').css('display', 'none');
                $('.receive_sales_commission_by_flag_bKash').css('display', 'block');
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

                    // console.log(response);
                    $('.create_validation_error').empty();
                    $('.create_validation_error').css('display','none');
                    $('body').scrollspy({target: '#myScrollspy'});

                    if (response.has_error === true) {
                        // console.log(response.error_messages);
                        $('.save-btn').on('click', function(){
                            $('#unique_input_error').modal('show');
                            $('.success_msg').append('Data is saved successfully');
                        });

                        $.each(response.error_messages, function (key, value) {

                            if(value == 'validation.uploaded'){
                                value = 'Please check your image size or type.';
                            }

                            $('.create_validation_error').css('display','block');
                            $('.create_validation_error').append(
                                '<li><span>'+value+'</span></li>'
                            );
                        });
                        // $.each(response.error_messages, function (key, value) {

                        //     $('#' + key).closest('div[class^="form-group"]').addClass('has-error');
                        //     var hasClassInputGroup = $('#' + key).closest('div').hasClass('input-group');
                        //     var after_append = hasClassInputGroup === true ? $('#' + key).closest('div') : $('#' + key);
                        //     after_append.after($('<span />', {class: 'help-block', text: value}));
                        // });
                    } else if (response.has_success === true) {

                        if (response.success_messages.enable_step == 1) {
                            <?php
                                session()->put('ifa_registration_success_message', 'Thank you for applying as IFA! Your application has been submitted, an email has been sent to your email address');
                                ?>
                            window.location.href = "{{ route('ifa_registration.edit') }}";
                        }


                        var application_no = response.success_messages.application_no;
                        var user_name = response.success_messages.user_name;
                        var application_password = response.success_messages.application_password;
                        var step = response.success_messages.enable_step;
                        var enable_steps_id = response.success_messages.enable_steps_id;
                        var disable_steps_id = response.success_messages.disable_steps_id;
                        var password = '{{ session("ifa_registration_password") }}';

                        $('#success_message_alert').css('display', 'block');
                        // $('#success_message_msg').html('Data successfully saved. Application no. : ' + application_no + ' & Password : ' + application_password);
                        $('#success_message_msg').html('Data successfully saved. User Name : ' + user_name + ' & Password : ' + application_password);
                        if(datatxt == 'Submit'){
                            $("#"+enable_steps_id[0]+"_tab").trigger("click");
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

        $('#user_type').change(function(){

            var val = $(this).val();
            $('.others_user_type_flag_yes').css('display', (val == -1 ? 'block' : 'none'));
        });
        $('#nationality').change(function(){

            var val = $(this).val();console.log(val);
            $('.others_nationality_flag_yes').css('display', (val == -1 ? 'block' : 'none'));
        });

        $("#mobile_no, #national_id_card_no, #account_no, #bKash_mobile_no").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
        $("#first_name, #middle_name, #last_name, #father_name, #mother_name, #present_address_po, #permanent_address_po, #others_nationality, #others_user_type").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 65 || e.keyCode > 90)) && (e.keyCode < 97 || e.keyCode > 122)) {
                        e.preventDefault();console.log(e.keyCode);
                    }else{
                        console.log(e.keyCode);
                    }
                });

    });

// $('#mobile_no').focusout(function(e){
//     var mobile_number = $('input[name=mobile_no]').val();
//     var _token = $('input[name=_token]').val();
//     if(mobile_number.length > 8){
//         $.ajax({
//             type: "POST",
//             url: "/value/check/mobile",
//             data: {mobile_number: mobile_number, _token:_token},
//             datatype: 'json',
//             cache: false,
//             async: false,
//             success: function (result) {

//             },
//             error: function (result) {
//                 alert("Error In value Check");
//             }
//         });
//     }
// });
</script>
<style type="text/css">
    .alert-success {
        display: none;
    }
    .alert-danger {
        display: none;
    }
</style>
@endsection
