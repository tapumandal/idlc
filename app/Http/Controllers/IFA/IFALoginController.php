<?php

namespace App\Http\Controllers\IFA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IFALoginController extends Controller
{
    public function logout(Request $request){

        $request->session()->forget('user_name');
        $request->session()->forget('ifausraccess');
        $request->session()->flush();

        return redirect()->route('ifa_registration.index');
    }
}
