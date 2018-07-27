<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Model\Bank;
use Validator;
use Auth;
use DB;

class BankController extends Controller
{
    private const IS_DELETED = 1 ;
    private const CREATE = 'create' ;
    private const UPADTE = 'update' ;

    private $isNotDeleted = 0;
    
    public function index(){
        $bankDetails = DB::table('tbl_bangladesh_bank')
                            ->orderBy('bank_id','DESC')
                            ->where('is_deleted',0)
                            ->paginate(15);
        return view('managment.bank.index',compact('bankDetails'));
    }

    public function create(){
        return view('managment.bank.create');
    }

    
    public function store(Request $request){

        $validMessages = [
            'bank_name.required' => 'Bank Name field is required.',
            'bank_name.unique' => 'Bank Name all ready exit.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'bank_name' => [
                                'required',
                                Rule::unique('tbl_bangladesh_bank')->ignore(1, 'is_deleted')
                                ]
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $validationError = $validator->messages();
        $storeBank = new Bank();
        $storeBank->bank_name = $request->bank_name;
        $storeBank->is_active = $request->isActive;
        // $storeBank->user_id = Auth::user()->user_id;
        $storeBank->last_action = self::CREATE;
        $storeBank->save();
        
         return \Redirect()->Route('banks.index');
    }

    
    public function show($id)
    {
          echo "show";
    }

    
    public function edit($id)
    {   
        $findBank = Bank::where('bank_id',$id)->get();
        return view('managment.bank.edit',compact('findBank'));
    }

    
    public function update(Request $request, $id)
    {   
        $validMessages = [
            'bank_name.required' => 'Bank Name field is required.',
            'bank_name.unique' => 'Bank Name all ready exit.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'bank_name' => [
                                'required',
                                Rule::unique('tbl_bangladesh_bank')->ignore(1, 'is_deleted')
                                ]
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $updateBank = Bank::find($id);
        $updateBank->bank_name = $request->bank_name;
        $updateBank->is_active = $request->isActive;
        // $updateBank->user_id = Auth::user()->user_id;
        $updateBank->last_action = self::UPADTE;
        $updateBank->update();
        
        return \Redirect()->Route('banks.index');
    }

    
    public function destroy($id)
    {
        $deleteBank = Bank::find($id);
        $deleteBank->is_deleted = self::IS_DELETED;
        $deleteBank->update();
        return \Redirect()->Route('banks.index');
    }
}
