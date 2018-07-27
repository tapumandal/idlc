<?php

namespace App\Http\Controllers;

use App\IFARegistration;
use Illuminate\Http\Request;

class LiveValidation extends Controller {
	public function mobileNoValidate(Request $req) {
		if (empty($req->mobile_number)) {
			return [
				'type' => 'mobile_number',
				'status' => 'exists',
				'message' => 'Empty Value is not Allowed.',
			];
		}
		if (strlen($req->mobile_number) != 9) {
			return [
				'type' => 'mobile_number',
				'status' => 'exists',
				'message' => 'Only Nine Digit are allowed.',
			];
		}
		if (!is_numeric($req->mobile_number)) {
			return [
				'type' => 'mobile_number',
				'status' => 'exists',
				'message' => 'Only Number Is allowed.',
			];
		}
		$mobileNoCheck = IFARegistration::get()->where('mobile_no', $req->mobile_number)->count();
		if ($mobileNoCheck > 0) {
			return [
				'type' => 'mobile_number',
				'status' => 'exists',
				'message' => 'Mobile number is already exists.',
			];
		}
		return [
			'type' => 'mobile_number',
			'status' => 'unique',
		];
	}

	public function emailValidate(Request $req) {
		$emailCheck = IFARegistration::get()->where('email', $req->email)->count();
		if ($emailCheck > 0) {
			return [
				'type' => 'email',
				'status' => 'exists',
				'message' => 'Email address is already exists.',
			];
		}
		return [
			'type' => 'email',
			'status' => 'unique',
		];
	}

	public function nidValidate(Request $req) {
		$emailCheck = IFARegistration::get()->where('national_id_card_no', $req->national_id_card_no)->count();
		if ($emailCheck > 0) {
			return [
				'type' => 'nid',
				'status' => 'exists',
				'message' => 'National ID Card No is already exists.',
			];
		}
		return [
			'type' => 'email',
			'status' => 'unique',
		];
	}
}
