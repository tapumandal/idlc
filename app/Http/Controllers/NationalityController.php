<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Message\ActionMessage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Model\Nationality;
use Validator;
use Auth;
use DB;

class NationalityController extends Controller
{
    
    public function index(){
        $nationalityDetails = DB::table('tbl_nationalitys')
                            ->orderBy('id_nationality','DESC')
                            ->where('is_deleted',0)
                            ->paginate(15);

        return view('managment.nationality.index',compact('nationalityDetails'));
    }

    public function create(){
        return view('managment.nationality.create');
    }

    
    public function store(Request $request){

        $validMessages = [
            'nationality.required' => 'Nationality field is required.',
            'nationality.unique' => 'Nationality all ready exit.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'nationality' => [
                                'required',
                                Rule::unique('tbl_nationalitys')->ignore(1, 'is_deleted')
                                ]
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $validationError = $validator->messages();
        $storeNationality = new Nationality();
        $storeNationality->nationality = $request->nationality;
        $storeNationality->is_active = $request->isActive;
        // $storeNationality->user_id = Auth::user()->user_id;
        $storeNationality->last_action = ActionMessage::CREATE;
        $storeNationality->save();
        
         return \Redirect()->Route('nationalitys.index');
    }

    
    public function show($id)
    {
          echo "show";
    }

    
    public function edit($id)
    {   
        $findNationality = Nationality::where('id_nationality',$id)->get();
        return view('managment.nationality.edit',compact('findNationality'));
    }

    
    public function update(Request $request, $id)
    {   
        $validMessages = [
            'nationality.required' => 'Nationality field is required.',
            'nationality.unique' => 'Nationality all ready exit.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'nationality' => [
                                'required',
                                Rule::unique('tbl_nationalitys')->ignore(1, 'is_deleted')
                                ]
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $updateNationality = Nationality::find($id);
        $updateNationality->nationality = $request->nationality;
        $updateNationality->is_active = $request->isActive;
        // $updateNationality->user_id = Auth::user()->user_id;
        $updateNationality->last_action = ActionMessage::UPDATE;
        $updateNationality->update();
        
        return \Redirect()->Route('nationalitys.index');
    }

    
    public function destroy($id)
    {
        $deleteNationality = Nationality::find($id);
        $deleteNationality->is_deleted = ActionMessage::IS_DELETED;
        $deleteNationality->last_action = ActionMessage::DELETE;
        $deleteNationality->update();
        return \Redirect()->Route('nationalitys.index');
    }
}
