<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Model\Divisions;
use App\Model\Thana;
use Validator;
use Auth;
use DB;

class ThanaController extends Controller
{
    private const IS_DELETED = 1 ;
    private const CREATE = 'create' ;
    private const UPDATE = 'update' ;
    
    public function index(){
        $thanaDetails = DB::table('tbl_bangladesh_thanas as tbtn')
                            ->select('tbtn.thana_id','tbtn.division_id','tbtn.district_id','tbtn.thana_name','tbds.district_name','tbdv.division_name','tbtn.is_active')
                            ->join('tbl_bangladesh_districts as tbds','tbds.district_id','tbtn.district_id')
                            ->join('tbl_bangladesh_divisions as tbdv','tbdv.division_id','tbtn.division_id')
                            ->where('tbtn.is_deleted',0)
                            ->orderBy('thana_id','DESC')
                            ->paginate(15);
        return view('managment.thana.index',compact('thanaDetails'));
    }

    public function create(){
        $divisionDetails = DB::table('tbl_bangladesh_divisions')
                            ->select('division_id','division_name')
                            ->where('is_deleted',0)
                            ->get();

        // $districtDetails = DB::table('tbl_bangladesh_districts')
        //                     ->select('district_id','district_name')
        //                     ->where('is_deleted',0)
        //                     ->get();

        return view('managment.thana.create',compact('divisionDetails'));
    }

    
    public function store(Request $request){
        $validMessages = [
            'thana_name.required'  => 'Thana Name field is required.',
            'thana_name.unique'    => 'Thana Name all ready exit.',
            'district_id.required' => 'District Name field is required.',
            'division_id.required' => 'Division Name field is required.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'thana_name'  => [
                                'required',
                                Rule::unique('tbl_bangladesh_thanas')->ignore(1, 'is_deleted')
                                ],
                'district_id' => 'required',
                'division_id' => 'required'
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $validationError = $validator->messages();
        $storeThana = new Thana();
        $storeThana->division_id = $request->division_id;
        $storeThana->district_id = $request->district_id;
        $storeThana->thana_name = $request->thana_name;
        $storeThana->is_active = $request->isActive;
        // $storeThana->user_id = Auth::user()->user_id;
        $storeThana->last_action = self::CREATE;
        $storeThana->save();
        
         return \Redirect()->Route('thanas.index');
    }

    
    public function show($id)
    {
          echo "show";
    }

    
    public function edit($id)
    {   
        $divisionDetails = DB::table('tbl_bangladesh_divisions')->select('division_id','division_name')->where('is_deleted',0)->get();
        $findThana = DB::table('tbl_bangladesh_thanas as tbtn')
                            ->select('tbtn.thana_id','tbtn.division_id','tbtn.district_id','tbtn.thana_name','tbds.district_name','tbtn.is_active','tbdv.division_name')
                            ->join('tbl_bangladesh_divisions as tbdv','tbdv.division_id','tbtn.division_id')
                            ->join('tbl_bangladesh_districts as tbds','tbds.district_id','tbtn.district_id')
                            ->where('tbtn.thana_id',$id)
                            ->get();
        return view('managment.thana.edit',compact('findThana','divisionDetails'));
    }

    
    public function update(Request $request, $id)
    {   
        $validMessages = [
            'thana_name.required' => 'Thana Name field is required.',
             'thana_name.unique'    => 'Thana Name all ready exit.',
            'district_id.required' => 'District Name field is required.',
            'division_id.required' => 'Division Name field is required.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'thana_name' => [
                                'required',
                                Rule::unique('tbl_bangladesh_thanas')->ignore(1, 'is_deleted')
                                ],
                'district_id' => 'required',
                'division_id' => 'required'
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $updateThana = Thana::find($id);
        $updateThana->division_id = $request->division_id;
        $updateThana->district_id = $request->district_id;
        $updateThana->thana_name = $request->thana_name;
        $updateThana->is_active = $request->isActive;
        // $updateThana->user_id = Auth::user()->user_id;
        $updateThana->last_action = self::UPDATE;
        $updateThana->update();
        
        return \Redirect()->Route('thanas.index');
    }

    
    public function destroy($id)
    {
        $deleteThana = Thana::find($id);
        $deleteThana->is_deleted = self::IS_DELETED;
        $deleteThana->update();
        return \Redirect()->Route('thanas.index');
    }

    public function showDivision(Request $request){
        return json_encode(
                DB::table('tbl_bangladesh_districts')
                ->select('district_id','district_name')
                ->where('division_id',$request->district_id)
                ->get());
    }
    
    public function getThanas(Request $request){
        $data = json_encode(
                DB::table('tbl_bangladesh_thanas as tbtn')
                ->select('tbtn.thana_id','tbtn.thana_name')
                ->join('tbl_bangladesh_divisions as tbdv','tbdv.division_id','tbtn.division_id')
                ->join('tbl_bangladesh_districts as tbds','tbds.district_id','tbtn.district_id')
                ->where([['tbtn.division_id',$request->division_id],['tbtn.district_id',$request->district_id]])
                ->get());

        return $data;
    }
}
