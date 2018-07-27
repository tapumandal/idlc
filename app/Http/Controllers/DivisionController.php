<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Model\Divisions;
use Validator;
use Auth;
use DB;

class DivisionController extends Controller
{
    private const IS_DELETED = 1;
    private const CREATE = 'create' ;
    private const UPDATE = 'update' ;
    
    public function index(){
        $divisionDetails = DB::table('tbl_bangladesh_divisions')
                            ->orderBy('division_id','DESC')
                            ->where('is_deleted',0)
                            ->paginate(15);

        return view('managment.division.index',compact('divisionDetails'));
    }

    public function create(){
        return view('managment.division.create');
    }

    
    public function store(Request $request){

        $validMessages = [
            'division_name.required' => 'Division Name field is required.',
            'division_name.unique' => 'Division Name all ready exit.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'division_name' => [
                                'required',
                                Rule::unique('tbl_bangladesh_divisions')->ignore(1, 'is_deleted')
                                ]
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $validationError = $validator->messages();
        $storeDivision = new Divisions();
        $storeDivision->division_name = $request->division_name;
        $storeDivision->is_active = $request->isActive;
        // $storeDivision->user_id = Auth::user()->user_id;
        $storeDivision->last_action = self::CREATE;
        $storeDivision->save();
        
         return \Redirect()->Route('divisions.index');
    }

    
    public function show($id)
    {
          echo "show";
    }

    
    public function edit($id)
    {   
        $findDivision = Divisions::where('division_id',$id)->get();
        return view('managment.division.edit',compact('findDivision'));
    }

    
    public function update(Request $request, $id)
    {   
        $validMessages = [
            'division_name.required' => 'Division Name field is required.',
            'division_name.unique' => 'Division Name all ready exit.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'division_name' => [
                                'required',
                                Rule::unique('tbl_bangladesh_divisions')->ignore(1, 'is_deleted')
                                ]
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $updateDivision = Divisions::find($id);
        $updateDivision->division_name = $request->division_name;
        $updateDivision->is_active = $request->isActive;
        // $updateDivision->user_id = Auth::user()->user_id;
        $updateDivision->last_action = self::UPDATE;
        $updateDivision->update();
        
        return \Redirect()->Route('divisions.index');
    }

    
    public function destroy($id)
    {
        $deleteDivision = Divisions::find($id);
        $deleteDivision->is_deleted = self::IS_DELETED;
        $deleteDivision->update();
        return \Redirect()->Route('divisions.index');
    }
}
