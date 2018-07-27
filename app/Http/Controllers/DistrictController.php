<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Model\Divisions;
use App\Model\District;
use Validator;
use Auth;
use DB;

class DistrictController extends Controller
{
    private const IS_DELETED = 1 ;
    private const CREATE = 'create' ;
    private const UPDATE = 'update' ;
    
    public function index(){
        $districtDetails = DB::table('tbl_bangladesh_districts as tbds')
                            ->select('tbds.district_id','tbds.division_id','tbds.district_name','tbds.is_active','tbdv.division_name')
                            ->join('tbl_bangladesh_divisions as tbdv','tbdv.division_id','tbds.division_id')
                            ->orderBy('district_id','DESC')
                            ->where('tbds.is_deleted',0)
                            ->paginate(15);
        return view('managment.district.index',compact('districtDetails'));
    }

    public function create(){
        $divisionDetails = DB::table('tbl_bangladesh_divisions')->select('division_id','division_name')->where('is_deleted',0)->get();
        return view('managment.district.create',compact('divisionDetails'));
    }

    
    public function store(Request $request){

        $validMessages = [
            'district_name.required' => 'District Name field is required.',
            'district_name.unique' => 'District Name all ready exit.',
            'division_id.required' => 'Division Name field is required.',
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'division_id' => 'required',
                'district_name' => [
                                'required',
                                Rule::unique('tbl_bangladesh_districts')->ignore(1, 'is_deleted')
                                ],
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $validationError = $validator->messages();
        $storeDistrict = new District();
        $storeDistrict->division_id = $request->division_id;
        $storeDistrict->district_name = $request->district_name;
        $storeDistrict->is_active = $request->isActive;
        // $storeDistrict->user_id = Auth::user()->user_id;
        $storeDistrict->last_action = self::CREATE;
        $storeDistrict->save();
        
         return \Redirect()->Route('districts.index');
    }

    
    public function show($id)
    {
          echo "show";
    }

    
    public function edit($id)
    {   
        $divisionDetails = DB::table('tbl_bangladesh_divisions')->select('division_id','division_name')->where('is_deleted',0)->get();
        $findDistrict = DB::table('tbl_bangladesh_districts as tbds')
                            ->select('tbds.district_id','tbds.division_id','tbds.district_name','tbds.is_active','tbdv.division_name','tbds.is_active')
                            ->join('tbl_bangladesh_divisions as tbdv','tbdv.division_id','tbds.division_id')
                            ->where('tbds.district_id',$id)
                            ->get();
        return view('managment.district.edit',compact('findDistrict','divisionDetails'));
    }

    
    public function update(Request $request, $id)
    {   
        $validMessages = [
            'district_name.required' => 'Division Name field is required.',
            'district_name.unique' => 'District Name all ready exit.',
            'division_id.required' => 'Division Name field is required.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'district_name' => [
                                'required',
                                Rule::unique('tbl_bangladesh_districts')->ignore(1, 'is_deleted')
                                ],
                'division_id' => 'required'
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $updateDistrict = District::find($id);
        $updateDistrict->division_id = $request->division_id;
        $updateDistrict->district_name = $request->district_name;
        $updateDistrict->is_active = $request->isActive;
        // $updateDistrict->user_id = Auth::user()->user_id;
        $updateDistrict->last_action = self::UPDATE;
        $updateDistrict->update();
        
        return \Redirect()->Route('districts.index');
    }

    
    public function destroy($id)
    {
        $deleteDivision = District::find($id);
        $deleteDivision->is_deleted = self::IS_DELETED;
        $deleteDivision->update();
        return \Redirect()->Route('districts.index');
    }
}
