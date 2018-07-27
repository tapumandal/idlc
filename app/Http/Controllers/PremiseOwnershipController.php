<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Message\ActionMessage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Model\PremiseOwnership;
use Validator;
use Auth;
use DB;

class PremiseOwnershipController extends Controller
{
    
    public function index(){
        $premiseOwnershipDetails = DB::table('tbl_premise_ownership')
                            ->orderBy('id_premise_ownership','DESC')
                            ->where('is_deleted',0)
                            ->paginate(15);

        return view('managment.premise_ownership.index',compact('premiseOwnershipDetails'));
    }

    public function create(){
        return view('managment.premise_ownership.create');
    }

    
    public function store(Request $request){

        $validMessages = [
            'premise_ownership.required' => 'Premise Ownership Name field is required.',
            'premise_ownership.unique' => 'Premise Ownership Name all ready exit.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'premise_ownership' => [
                                'required',
                                Rule::unique('tbl_premise_ownership')->ignore(1, 'is_deleted')
                                ]
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $validationError = $validator->messages();
        $storePremiseOwnership = new PremiseOwnership();
        $storePremiseOwnership->premise_ownership = $request->premise_ownership;
        $storePremiseOwnership->is_active = $request->isActive;
        // $storePremiseOwnership->user_id = Auth::user()->user_id;
        $storePremiseOwnership->last_action = ActionMessage::CREATE;
        $storePremiseOwnership->save();
        
         return \Redirect()->Route('premiseOwnerships.index');
    }

    
    public function show($id)
    {
          echo "show";
    }

    
    public function edit($id)
    {   
        $findPremiseOwnership = PremiseOwnership::where('id_premise_ownership',$id)->get();
        return view('managment.premise_ownership.edit',compact('findPremiseOwnership'));
    }

    
    public function update(Request $request, $id)
    {   
        $validMessages = [
            'premise_ownership.required' => 'Premise Ownership Name field is required.',
            'premise_ownership.unique' => 'Premise Ownership Name all ready exit.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'premise_ownership' => [
                                'required',
                                Rule::unique('tbl_premise_ownership')->ignore(1, 'is_deleted')
                                ]
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $updatePremiseOwnership = PremiseOwnership::find($id);
        $updatePremiseOwnership->premise_ownership = $request->premise_ownership;
        $updatePremiseOwnership->is_active = $request->isActive;
        // $updatePremiseOwnership->user_id = Auth::user()->user_id;
        $updatePremiseOwnership->last_action = ActionMessage::UPDATE;
        $updatePremiseOwnership->update();
        
        return \Redirect()->Route('premiseOwnerships.index');
    }

    
    public function destroy($id)
    {
        $deletePremiseOwnership = PremiseOwnership::find($id);
        $deletePremiseOwnership->is_deleted = ActionMessage::IS_DELETED;
        $deletePremiseOwnership->last_action = ActionMessage::DELETE;
        $deletePremiseOwnership->update();
        return \Redirect()->Route('premiseOwnerships.index');
    }
}
