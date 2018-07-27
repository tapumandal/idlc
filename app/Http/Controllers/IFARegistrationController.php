<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\IFARegistration;
use DB;
use File;
use Hash;
use Illuminate\Http\Request;
use Validator;

class IFARegistrationController extends Controller {

	public function __construct() {

	}

	public function index() {
		return view('ifa_registration_form.index');
	}

	public function create($application_no = 0, $step = 1) {

		$data = [
			'application_no' => $application_no,
			'step' => $step,
//            'existing_application_details' => $existing_application_details,
			'divisions' => DB::table('tbl_bangladesh_divisions')
				->orderBy('division_id', 'DESC')
				->where('is_deleted', 0)->get(),
			'banks' => DB::table('tbl_bangladesh_bank')
				->orderBy('bank_id', 'DESC')
				->where('is_deleted', 0)->get(),
			'nationalities' => DB::table('tbl_nationalitys')
				->orderBy('id_nationality', 'DESC')
				->where('is_deleted', 0)->get(),
			'premise_ownerships' => DB::table('tbl_premise_ownership')
				->orderBy('id_premise_ownership', 'DESC')
				->where('is_deleted', 0)->get(),
			'user_types' => DB::table('tbl_user_type')
				->orderBy('id_user_type', 'DESC')
				->where('is_deleted', 0)->get(),
		];
		return view('ifa_registration_form.create', $data);
	}

	public function store(Request $request) {

		$validator_arr = $return_data_arr = $insert_arr = [];
		$application_no = $request->input('application_no');
		$step = $request->input('step');
		$userName = '';

		if ($step == 1 && $application_no == 0) {

			$validMessage = [
				'first_name.required' => 'First Name is required.',
				'last_name.required' => 'Last Name is required.',
				'mobile_no.required' => 'Mobile No is required.',
				'mobile_no.unique' => 'Mobile No must be unique.',
				'email.required' => 'Email is required.',
				'email.unique' => 'Email Must be unique.',
				'date_of_birth.required' => 'Date of birth is required.',
				'national_id_card_no.required' => 'National ID card_no is required.',
				'national_id_card_no.unique' => 'National ID card_no must be unique.',
				'middle_name.required' => 'Middle Name is required.',
				'father_name.required' => 'Father Name is required.',
				'mother_name.required' => 'Mother Name is required.',
				// 'upload_picture.required' => 'Upload picture is required.',
				'validation.uploaded' => 'Please check your image size or type.',
				'upload_picture' => 'Please check your image size or type.',
				'present_address_flat_no.required' => 'Present Address flat_no input value is wrong.',
				'present_address_house_no.required' => 'Present address house_no input value is wrong.',
				'present_address_road_no.required' => 'Present address road_no input value is wrong.',
				'present_address_division.required' => 'Present address division input value is wrong.',
				'present_address_district.required' => 'Present address district input value is wrong.',
				'present_address_po.required' => 'Present address po input value is wrong.',
				'present_address_premise_ownership.required' => 'Present address premise_ownership input value is wrong.',
				'permanent_address_flat_no.required' => 'Permanent address_flat_no input value is wrong.',
				'permanent_address_house_no.required' => 'Permanent address_house_no input value is wrong.',
				'permanent_address_road_no.required' => 'Permanent address_road_no input value is wrong.',
				'permanent_address_division.required' => 'Permanent address_division input value is wrong.',
				'permanent_address_district.required' => 'Permanent address_district input value is wrong.',
				'permanent_address_po.required' => 'Permanent address_po input value is wrong.',
				'permanent_address_premise_ownership.required' => 'Permanent address_premise_ownership input value is wrong.',
				'others_user_type.required' => 'Others User Type is required.',
				'others_nationality.required' => 'Others Nationality is required.',
			];
			$datas = $request->all();
			// $validator_arr = [
			$validator = Validator::make($datas,
				['first_name' => 'required|max:70',
					'last_name' => 'required|max:70',
					'mobile_no' => 'required|digits:9|unique:tbl_ifa_registrations,mobile_no',
					'email' => 'required|email|max:200|unique:tbl_ifa_registrations,email',
					'date_of_birth' => 'required',
					'national_id_card_no' => 'required|max:25|unique:tbl_ifa_registrations,national_id_card_no',
					'middle_name' => 'sometimes|max:70',
					'father_name' => 'sometimes|max:254',
					'mother_name' => 'sometimes|max:254',
					'upload_picture' => 'sometimes|image|mimes:jpeg,jpg,png,gif|max:1024',
					'present_address_flat_no' => 'sometimes|max:254',
					'present_address_house_no' => 'sometimes|max:254',
					'present_address_road_no' => 'sometimes|max:254',
					'present_address_division' => 'sometimes|numeric',
					'present_address_district' => 'sometimes|numeric',
					'present_address_po' => 'sometimes',
					'present_address_premise_ownership' => 'sometimes|max:254',
					'permanent_address_flat_no' => 'sometimes|max:254',
					'permanent_address_house_no' => 'sometimes|max:254',
					'permanent_address_road_no' => 'sometimes|max:254',
					'permanent_address_division' => 'sometimes|numeric',
					'permanent_address_district' => 'sometimes|numeric',
					'permanent_address_po' => 'sometimes',
					'permanent_address_premise_ownership' => 'sometimes|max:254',
				],
				$validMessage
			);

			if ($validator->fails()) {
				$validationError = $validator->messages();
				$return_data_arr = [
					'has_error' => TRUE,
					'error_messages' => $validationError,
				];
				return $return_data_arr;
			}

			if ($request->input('user_type') == -1) {
				$validMessage = [
					'others_user_type.required' => 'Others User Type is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas, [
					'others_user_type' => 'required|max:254',
				], $validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			}
			if ($request->input('nationality') == -1) {
				$validMessage = [
					'others_nationality.required' => 'Others User Type is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas, [
					'others_nationality' => 'required|max:254',
				], $validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			}
			try {

				$digits = 5;
				$password = rand(pow(10, $digits - 1), pow(10, $digits) - 1);

				$insert_arr = [
					'first_name' => $request->input('first_name'),
					'middle_name' => $request->input('middle_name'),
					'last_name' => $request->input('last_name'),
					'mobile_no' => $request->input('mobile_no'),
					'email' => $request->input('email'),
					'date_of_birth' => date('Y-m-d', strtotime($request->input('date_of_birth'))),
					'national_id_card_no' => $request->input('national_id_card_no'),
					'father_name' => $request->input('father_name'),
					'mother_name' => $request->input('mother_name'),
					'nationality' => $request->input('nationality'),
					'others_nationality' => $request->input('others_nationality'),
					'user_type_id' => $request->input('user_type'),
					'others_user_type' => $request->input('others_user_type'),
					'pre_addr_flat_no' => $request->input('present_address_flat_no'),
					'pre_addr_house_no' => $request->input('present_address_house_no'),
					'pre_addr_road_no' => $request->input('present_address_road_no'),
					'pre_addr_division_id' => $request->input('present_address_division'),
					'pre_addr_district_id' => $request->input('present_address_district'),
					'pre_addr_ps_id' => $request->input('present_address_po'),
					'pre_addr_premise_ownership' => $request->input('present_address_premise_ownership'),
					'is_same_as_present_address' => $request->input('is_same_as_present_address') == 'yes' ? 1 : 0,
					'per_addr_flat_no' => $request->input('permanent_address_flat_no'),
					'per_addr_house_no' => $request->input('permanent_address_house_no'),
					'per_addr_road_no' => $request->input('permanent_address_road_no'),
					'per_addr_division_id' => $request->input('permanent_address_division'),
					'per_addr_district_id' => $request->input('permanent_address_district'),
					'per_addr_ps_id' => $request->input('permanent_address_po'),
					'per_addr_premise_ownership' => $request->input('permanent_address_premise_ownership'),
					'training_status' => 'Fail',
					// 'password' => $password,
					'password' => Hash::make($password),
				];

				$application_no = DB::table('tbl_ifa_registrations')->insertGetId($insert_arr);
				$userName = strtolower($request->input('first_name')) . $application_no;
				DB::table('tbl_ifa_registrations')->where('application_no', $application_no)->update(['user_name' => $userName]);
				//echo $application_no;exit;
				$request->session()->put('ifa_registration_password', $password);
				$request->session()->put('ifa_registration_user_name', $userName);

				if ($request->hasFile('upload_picture')) {
					if ($request->file('upload_picture')->isValid()) {
						$file = $request->file('upload_picture');
						$file->move(public_path('idlc_aml_images/ifa_registrations'), $file->getClientOriginalName());
						$oldfile = public_path('idlc_aml_images/ifa_registrations/' . $file->getClientOriginalName());
						$ext = explode('.', $file->getClientOriginalName());
						$newfile = $_SERVER['DOCUMENT_ROOT'] . '/idlc_aml_images/ifa_registrations/' . $application_no . '.' . $ext[1];
						File::copy($oldfile, $newfile);

						DB::table('tbl_ifa_registrations')->where('application_no', $application_no)->update(['image_ext' => $ext[1]]);
					}
				}

				$return_data_arr = [
					'has_success' => TRUE,
					'success_messages' => [
						'application_no' => $application_no,
						'user_name' => $userName,
						'application_password' => $password,
						'enable_step' => 2,
						'enable_steps_id' => [
							'educational_professional_information',
						],
						'disable_steps_id' => [
							'personal_profile',
							'bank_alternate_channel_information',
						],
					],
				];
				// echo '<pre>';
				// print_r($return_data_arr);exit;
				return response()->json($return_data_arr);

			} catch (\Exception $ex) {
				return response()->json($ex->getMessage());
			}

		}

		// $validator = Validator::make($request->all(), $validator_arr);

		else if ($step == 2 && $application_no != 0) {

			if ($request->job_holder === 'yes') {
				$validMessage = [
					'organization_name.required' => 'organization_name is required',
					'job_holder_department.required' => 'employee_id_no is required',
					'designation.required' => 'institution_name is required',
					'employee_id_no.required' => 'employee_id_no is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas,
					[
						'organization_name' => 'required|max:254',
						'job_holder_department' => 'required|max:254',
						'designation' => 'required|max:254',
						'employee_id_no' => 'required|max:30',
					],
					$validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			}

			if ($request->input('student') === 'yes') {

				$validMessage = [
					'institution_name.required' => 'Institution Name is required',
					'student_department.required' => 'Student Department is required',
					'student_id_card_no.required' => 'Student ID Card No. is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas,
					[
						'institution_name' => 'required|max:254',
						'student_department' => 'required|max:254',
						'student_id_card_no' => 'required|max:30',
					],
					$validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			}

			$insert_arr = [
				'latest_degree' => $request->input('latest_degree'),
				'last_educational_institution' => $request->input('last_educational_institution'),
				'is_job_holder' => $request->input('job_holder'),
				'organization_name' => $request->input('organization_name'),
				'employee_id_no' => $request->input('employee_id_no'),
				'designation' => $request->input('designation'),
				'job_holder_department' => $request->input('job_holder_department'),
				'is_student' => $request->input('student'),
				'institution_name' => $request->input('institution_name'),
				'student_department' => $request->input('student_department'),
				'student_id_card_no' => $request->input('student_id_card_no'),
			];

			DB::table('tbl_ifa_registrations')->where('application_no', $application_no)->update($insert_arr);

			$return_data_arr = [
				'has_success' => TRUE,
				'success_messages' => [
					'application_no' => $application_no,
					'user_name' => $request->session()->get('ifa_registration_user_name'),
					'application_password' => $request->session()->get('ifa_registration_password'),
					'enable_step' => 3,
					'enable_steps_id' => [
						'bank_alternate_channel_information',
					],
					'disable_steps_id' => [
						'personal_profile',
						'educational_professional_information',
					],
				],
			];

		} else if ($step == 3 && $application_no != 0) {

			if ($request->receive_sales_commission_by == 'Bank') {
				$validMessage = [
					'bank.required' => 'bank is required',
					'account_no.required' => 'account_no is required',
					'branch.required' => 'Branch is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas,
					[
						'bank' => 'required|max:254',
						'account_no' => 'required|max:254',
						'branch' => 'required|max:254',
					],
					$validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			} else if ($request->receive_sales_commission_by == 'bKash') {
				$validMessage = [
					'bKash_account_type.required' => 'bKash_account_type is required',
					'bKash_mobile_no.required' => 'bKash_mobile_no is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas,
					[
						'bKash_account_type' => 'required|max:254',
						'bKash_mobile_no' => 'required|max:9',
					],
					$validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}

			}
			$insert_arr = [
				'receive_sales_commission_by' => $request->input('receive_sales_commission_by'),
				'bank_id' => $request->input('bank'),
				'bank_branch_id' => $request->input('branch'),
				'bank_account_no' => $request->input('account_no'),
				'bKash_acc_type' => $request->input('bKash_account_type'),
				'bKash_mobile_no' => $request->input('bKash_mobile_no'),
			];
			DB::table('tbl_ifa_registrations')->where('application_no', $application_no)->update($insert_arr);
			$return_data_arr = [
				'has_success' => TRUE,
				'success_messages' => [
					'application_no' => $application_no,
					'user_name' => $request->session()->get('ifa_registration_user_name'),
					'application_password' => $request->session()->get('ifa_registration_password'),
					'enable_step' => 1,
				],
			];
		}

		return response()->json($return_data_arr);
	}

	public function edit(Request $request) {
//        echo 'Application no. : '  . session()->pull('application_no') . '<br />';
		//        echo 'Password : '  . session()->pull('password');
        if( $request->session()->get('user_name') !== null && $request->session()->get('ifausraccess') !== null ){
//            return'sdfsfsd';
            return redirect()->route('ifa_registration.postEdit');
        }
		return view('ifa_registration_form.edit');
	}

	public function postEdit(Request $request) {

            $data = [
                //'step' => 1,
                //            'existing_application_details' => $existing_application_details,
                'divisions' => DB::table('tbl_bangladesh_divisions')
                    ->orderBy('division_id', 'DESC')
                    ->where('is_deleted', 0)->get(),
                'banks' => DB::table('tbl_bangladesh_bank')
                    ->orderBy('bank_id', 'DESC')
                    ->where('is_deleted', 0)->get(),
                'nationalities' => DB::table('tbl_nationalitys')
                    ->orderBy('id_nationality', 'DESC')
                    ->where('is_deleted', 0)->get(),
                'premise_ownerships' => DB::table('tbl_premise_ownership')
                    ->orderBy('id_premise_ownership', 'DESC')
                    ->where('is_deleted', 0)->get(),
                'user_types' => DB::table('tbl_user_type')
                    ->orderBy('id_user_type', 'DESC')
                    ->where('is_deleted', 0)->get(),
            ];

//            $validator = Validator::make($request->all(), [
//                'user_name' => 'required',
//                'password' => 'required|string',
//            ])->validate();

            // $application_no = $request->input('application_no');
            if($request->session()->get('user_name') !== null && $request->session()->get('ifausraccess') !== null){
//                return 'IF';
                $userName = $request->session()->get('user_name');
                $password = $request->session()->get('ifausraccess');
            }else{
//                return 'else';
                $userName = $request->input('user_name');
                $password = $request->input('password');
            }


            // $existing_ifa_info = IFARegistration::where('application_no', $application_no)->first();
            $existing_ifa_info = IFARegistration::where('user_name', $userName)->first();

            if (!empty($existing_ifa_info)) {

                if (Hash::check($password, $existing_ifa_info->password)) {

                    $data['application_details'] = $existing_ifa_info;
                    $data['application_no'] = isset($existing_ifa_info->application_no) ? $existing_ifa_info->application_no : 0;
                } else {
                    return redirect()->route("ifa_registration.edit")->withErrors(['error_message' => 'Invalid application no. or password!']);
                }
            } else {

                return redirect()->route('ifa_registration.edit')->withErrors(['error_message' => 'Invalid application no. or password!']);
            }

            $request->session()->put('user_name', $userName);
            $request->session()->put('ifausraccess', $password);


//        echo '<pre>';print_r($data);exit;
            return view('ifa_registration_form.postEdit', $data);




	}

	public function update(Request $request, $application_no) {
		// echo '<pre>';
		// print_r($request->all());exit;

		$validator_arr = $return_data_arr = $insert_arr = [];

		$step = $request->input('step');
		if ($step == 1) {

			$validMessage = [
				'first_name.required' => 'First Name is required.',
				'last_name.required' => 'Last Name is required.',
				// 'mobile_no.required' => 'Mobile No is required.',
				// 'mobile_no.unique' => 'Mobile No must be unique.',
				// 'email.required' => 'Email is required.',
				// 'email.unique' => 'Email Must be unique.',
				// 'date_of_birth.required' => 'Date of birth is required.',
				// 'national_id_card_no.required' => 'National ID card_no is required.',
				// 'national_id_card_no.unique' => 'National ID card_no must be unique.',
				'middle_name.required' => 'Middle Name is required.',
				'father_name.required' => 'Father Name is required.',
				'mother_name.required' => 'Mother Name is required.',
				// 'upload_picture.required' => 'Upload picture is required.',
				'validation.uploaded' => 'Please check your image size or type.',
				'upload_picture' => 'Please check your image size or type.',
				'present_address_flat_no.required' => 'Present Address flat_no input value is wrong.',
				'present_address_house_no.required' => 'Present address house_no input value is wrong.',
				'present_address_road_no.required' => 'Present address road_no input value is wrong.',
				'present_address_division.required' => 'Present address division input value is wrong.',
				'present_address_district.required' => 'Present address district input value is wrong.',
				'present_address_po.required' => 'Present address po input value is wrong.',
				'present_address_premise_ownership.required' => 'Present address premise_ownership input value is wrong.',
				'permanent_address_flat_no.required' => 'Permanent address_flat_no input value is wrong.',
				'permanent_address_house_no.required' => 'Permanent address_house_no input value is wrong.',
				'permanent_address_road_no.required' => 'Permanent address_road_no input value is wrong.',
				'permanent_address_division.required' => 'Permanent address_division input value is wrong.',
				'permanent_address_district.required' => 'Permanent address_district input value is wrong.',
				'permanent_address_po.required' => 'Permanent address_po input value is wrong.',
				'permanent_address_premise_ownership.required' => 'Permanent address_premise_ownership input value is wrong.',
				'others_user_type.required' => 'Others User Type is required.',
				'others_nationality.required' => 'Others Nationality is required.',
				'new_password.required' => 'New Password is required.',
				'confirm_password.required' => 'Confirm Password is required.',
				'validation.confirmed' => 'New Password and Confirm Password does not match.',
				'validation.date_format' => 'Incorrect Date format.',
			];
			$datas = $request->all();
			// $validator_arr = [
			$validator = Validator::make($datas,
				['first_name' => 'required|max:70',
					'last_name' => 'required|max:70',
					// 'mobile_no' => 'required|digits:9|unique:tbl_ifa_registrations,mobile_no',
					// 'email' => 'required|email|max:200|unique:tbl_ifa_registrations,email',
					'date_of_birth' => 'required',
					'national_id_card_no' => 'required|max:25|unique:tbl_ifa_registrations,national_id_card_no,' . $application_no . ',application_no',
					'middle_name' => 'sometimes|max:70',
					'father_name' => 'sometimes|max:254',
					'mother_name' => 'sometimes|max:254',
					'upload_picture' => 'sometimes|image|mimes:jpeg,jpg,png,gif|max:1024',
					'present_address_flat_no' => 'sometimes|max:254',
					'present_address_house_no' => 'sometimes|max:254',
					'present_address_road_no' => 'sometimes|max:254',
					'present_address_division' => 'sometimes|numeric',
					'present_address_district' => 'sometimes|numeric',
					'present_address_po' => 'sometimes',
					'present_address_premise_ownership' => 'sometimes|max:254',
					'permanent_address_flat_no' => 'sometimes|max:254',
					'permanent_address_house_no' => 'sometimes|max:254',
					'permanent_address_road_no' => 'sometimes|max:254',
					'permanent_address_division' => 'sometimes|numeric',
					'permanent_address_district' => 'sometimes|numeric',
					'permanent_address_po' => 'sometimes',
					'permanent_address_premise_ownership' => 'sometimes|max:254',
				],
				$validMessage
			);

			if ($validator->fails()) {
				$validationError = $validator->messages();
				$return_data_arr = [
					'has_error' => TRUE,
					'error_messages' => $validationError,
				];
				return $return_data_arr;
			}

			if ($request->input('user_type') == -1) {
				$validMessage = [
					'others_user_type.required' => 'Others User Type is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas, [
					'others_user_type' => 'required|max:254',
				], $validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			}
			if ($request->input('nationality') == -1) {
				$validMessage = [
					'others_nationality.required' => 'Others User Type is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas, [
					'others_nationality' => 'required|max:254',
				], $validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			}

			if ($request->has('previous_password') && !is_null($request->input('previous_password'))) {

				$validMessage = [
					'password.required' => 'New Password is required',
					'confirm_password.required' => 'Confirm Password is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas, [
					'password' => 'required|min:6|max:20|confirmed',
//                            'confirm_password' => 'required|min:6|max:20',
				], $validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}

				$db_password = IFARegistration::select('password')->where('application_no', $application_no)->first();
				$is_match_prev_password = Hash::check($request->input('previous_password'), $db_password->password);
				if ($is_match_prev_password === FALSE) {
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => [
							'Current password does not match.',
						],
					];
					return $return_data_arr;
				}
			}

			try {

				$insert_arr = [
					'first_name' => $request->input('first_name'),
					'middle_name' => $request->input('middle_name'),
					'last_name' => $request->input('last_name'),
					// 'mobile_no' => $request->input('mobile_no'),
					// 'email' => $request->input('email'),
					'date_of_birth' => $request->input('date_of_birth'),
					'national_id_card_no' => $request->input('national_id_card_no'),
					'father_name' => $request->input('father_name'),
					'mother_name' => $request->input('mother_name'),
					'nationality' => $request->input('nationality'),
					'others_nationality' => $request->input('others_nationality'),
					'user_type_id' => $request->input('user_type'),
					'others_user_type' => $request->input('others_user_type'),
					'pre_addr_flat_no' => $request->input('present_address_flat_no'),
					'pre_addr_house_no' => $request->input('present_address_house_no'),
					'pre_addr_road_no' => $request->input('present_address_road_no'),
					'pre_addr_division_id' => $request->input('present_address_division'),
					'pre_addr_district_id' => $request->input('present_address_district'),
					'pre_addr_ps_id' => $request->input('present_address_po'),
					'pre_addr_premise_ownership' => $request->input('present_address_premise_ownership'),
					'is_same_as_present_address' => $request->input('is_same_as_present_address') == 'yes' ? 1 : 0,
					'per_addr_flat_no' => $request->input('permanent_address_flat_no'),
					'per_addr_house_no' => $request->input('permanent_address_house_no'),
					'per_addr_road_no' => $request->input('permanent_address_road_no'),
					'per_addr_division_id' => $request->input('permanent_address_division'),
					'per_addr_district_id' => $request->input('permanent_address_district'),
					'per_addr_ps_id' => $request->input('permanent_address_po'),
					'per_addr_premise_ownership' => $request->input('permanent_address_premise_ownership'),
				];

				if ($request->has('previous_password') && !is_null($request->input('previous_password'))) {

					$insert_arr['password'] = Hash::make($request->input('password'));
				}

				DB::table('tbl_ifa_registrations')->where('application_no', $application_no)->update($insert_arr);

				if ($request->hasFile('upload_picture')) {
					if ($request->file('upload_picture')->isValid()) {
						$file = $request->file('upload_picture');
						$file->move(public_path('idlc_aml_images/ifa_registrations'), $file->getClientOriginalName());
						$oldfile = public_path('idlc_aml_images/ifa_registrations/' . $file->getClientOriginalName());
						$ext = explode('.', $file->getClientOriginalName());
						$newfile = $_SERVER['DOCUMENT_ROOT'] . '/idlc_aml_images/ifa_registrations/' . $application_no . '.' . $ext[1];
						File::copy($oldfile, $newfile);

						DB::table('tbl_ifa_registrations')->where('application_no', $application_no)->update(['image_ext' => $ext[1]]);
					}
				}

				$return_data_arr = [
					'has_success' => TRUE,
					'success_messages' => [
						'application_no' => $application_no,
						'enable_step' => 2,
						'enable_steps_id' => [
							'educational_professional_information',
						],
						'disable_steps_id' => [
							'personal_profile',
							'bank_alternate_channel_information',
						],
					],
				];
				// echo '<pre>';
				// print_r($return_data_arr);exit;
				return response()->json($return_data_arr);

			} catch (\Exception $ex) {

				return response()->json($ex->getMessage());
			}
		} else if ($step == 2) {

			if ($request->job_holder === 'yes') {
				$validMessage = [
					'organization_name.required' => 'organization_name is required',
					'employee_id_no.required' => 'employee_id_no is required',
					'designation.required' => 'institution_name is required',
					'employee_id_no.required' => 'student_id_card_no is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas,
					[
						'organization_name' => 'required|max:254',
						'job_holder_department' => 'required|max:254',
						'designation' => 'required|max:254',
						'employee_id_no' => 'required|max:30',
					],
					$validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			}
			if ($request->input('student') === 'yes') {

				$validMessage = [
					'institution_name.required' => 'Institution Name is required',
					'student_department.required' => 'Student Department is required',
					'student_id_card_no.required' => 'Student ID Card No. is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas,
					[
						'institution_name' => 'required|max:254',
						'student_department' => 'required|max:254',
						'student_id_card_no' => 'required|max:30',
					],
					$validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			}

			$insert_arr = [
				'latest_degree' => $request->input('latest_degree'),
				'last_educational_institution' => $request->input('last_educational_institution'),
				'is_job_holder' => $request->input('job_holder') == 'yes' ? 1 : 0,
				'organization_name' => $request->input('organization_name'),
				'employee_id_no' => $request->input('employee_id_no'),
				'designation' => $request->input('designation'),
				'job_holder_department' => $request->input('job_holder_department'),
				'is_student' => $request->input('student') == 'on' ? 1 : 0,
				'institution_name' => $request->input('institution_name'),
				'student_department' => $request->input('student_department'),
				'student_id_card_no' => $request->input('student_id_card_no'),
			];
			// echo '<pre>';
			// print_r($insert_arr);exit;

			DB::table('tbl_ifa_registrations')->where('application_no', $application_no)->update($insert_arr);

			$return_data_arr = [
				'has_success' => TRUE,
				'success_messages' => [
					'application_no' => $application_no,
					'enable_step' => 3,
					'enable_steps_id' => [
						'bank_alternate_channel_information',
					],
					'disable_steps_id' => [
						'personal_profile',
						'educational_professional_information',
					],
				],
			];

		} else if ($step == 3) {

			if ($request->receive_sales_commission_by == 'Bank') {
				$validMessage = [
					'bank.required' => 'bank is required',
					'account_no.required' => 'account_no is required',
					'branch.required' => 'Branch is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas,
					[
						'bank' => 'required|max:254',
						'account_no' => 'required|max:254',
						'branch' => 'required|max:254',
					],
					$validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}
			} else if ($request->receive_sales_commission_by == 'bKash') {
				$validMessage = [
					'bKash_account_type.required' => 'bKash_account_type is required',
					'bKash_mobile_no.required' => 'bKash_mobile_no is required',
				];
				$datas = $request->all();
				// $validator_arr = [
				$validator = Validator::make($datas,
					[
						'bKash_account_type' => 'required|max:254',
						'bKash_mobile_no' => 'required|max:9',
					],
					$validMessage
				);

				if ($validator->fails()) {
					$validationError = $validator->messages();
					$return_data_arr = [
						'has_error' => TRUE,
						'error_messages' => $validationError,
					];
					return $return_data_arr;
				}

			}
			$insert_arr = [
				'receive_sales_commission_by' => $request->input('receive_sales_commission_by'),
				'bank_id' => $request->input('bank'),
				'bank_branch_id' => $request->input('branch'),
				'bank_account_no' => $request->input('account_no'),
				'bKash_acc_type' => $request->input('bKash_account_type'),
				'bKash_mobile_no' => $request->input('bKash_mobile_no'),
			];
			DB::table('tbl_ifa_registrations')->where('application_no', $application_no)->update($insert_arr);
			$return_data_arr = [
				'has_success' => TRUE,
				'success_messages' => [
					'application_no' => $application_no,
					'enable_step' => 1,
				],
			];
		}

		return response()->json($return_data_arr);
	}

}
