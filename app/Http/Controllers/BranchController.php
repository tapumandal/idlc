<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Model\Branch;
use Validator;
use Auth;
use DB;

class BranchController extends Controller
{
    private const IS_DELETED = 1 ;
    private const CREATE = 'create' ;
    private const UPADTE = 'update' ;
    
    public function index(){
        $branchDetails = DB::table('tbl_bangladesh_bank_branch as tbbb')
                            ->select('tbbb.bank_id','tbbb.branch_id','tbbb.branch_name','tbbb.is_active','tbb.bank_name')
                            ->join('tbl_bangladesh_bank as tbb','tbb.bank_id','tbbb.bank_id')
                            ->where('tbbb.is_deleted',0)
                            ->orderBy('branch_id','DESC')
                            ->paginate(15);
        return view('managment.branch.index',compact('branchDetails'));
    }

    public function create(){
        $bankDetails = DB::table('tbl_bangladesh_bank')->select('bank_id','bank_name')->where('is_deleted',0)->get();
        return view('managment.branch.create',compact('bankDetails'));
    }

    
    public function store(Request $request){

        $validMessages = [
            'branch_name.required' => 'Branch Name field is required.',
            'branch_name.unique' => 'Branch Name all ready exit.',
            'bank_id.required' => 'Bank Name field is required.',
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'branch_name' => [
                                'required',
                                Rule::unique('tbl_bangladesh_bank_branch')->ignore(1, 'is_deleted')
                                ],
                'bank_id' => 'required'
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $validationError = $validator->messages();
        $storeBranch = new Branch();
        $storeBranch->bank_id = $request->bank_id;
        $storeBranch->branch_name = $request->branch_name;
        $storeBranch->is_active = $request->isActive;
        // $storeBranch->user_id = Auth::user()->user_id;
        $storeBranch->last_action = self::CREATE;
        $storeBranch->save();
        
         return \Redirect()->Route('branchs.index');
    }

    
    public function show($id)
    {
          echo "show";
    }

    
    public function edit($id)
    {   
        $bankDetails = DB::table('tbl_bangladesh_bank')->select('bank_id','bank_name')->where('is_deleted',0)->get();
        $findBranch = DB::table('tbl_bangladesh_bank_branch as tbbb')
                            ->select('tbbb.bank_id','tbbb.branch_id','tbbb.branch_name','tbbb.is_active','tbb.bank_name')
                            ->join('tbl_bangladesh_bank as tbb','tbb.bank_id','tbbb.bank_id')
                            ->where('branch_id',$id)
                            ->get();
        return view('managment.branch.edit',compact('findBranch','bankDetails'));
    }

    
    public function update(Request $request, $id)
    {   
        $validMessages = [
            'branch_name.required' => 'Branch Name field is required.',
            'branch_name.unique' => 'Branch Name all ready exit.',
            'bank_id.required' => 'Bank Name field is required.'
            ];
        $datas = $request->all();
        $validator = Validator::make($datas, 
            [
                'branch_name' => [
                                'required',
                                Rule::unique('tbl_bangladesh_bank_branch')->ignore(1, 'is_deleted')
                                ],
                'bank_id' => 'required'
            ],
            $validMessages
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator->messages());
        }

        $updateBranch = Branch::find($id);
        $updateBranch->bank_id = $request->bank_id;
        $updateBranch->branch_name = $request->branch_name;
        $updateBranch->is_active = $request->isActive;
        // $updateBranch->user_id = Auth::user()->user_id;
        $updateBranch->last_action = self::UPADTE;
        $updateBranch->update();
        
        return \Redirect()->Route('branchs.index');
    }

    
    public function destroy($id)
    {
        $deleteBranch = Branch::find($id);
        $deleteBranch->is_deleted = self::IS_DELETED;
        $deleteBranch->update();
        return \Redirect()->Route('branchs.index');
    }
    
    public function getBranch(Request $request){
        $data = json_encode(
                DB::table('tbl_bangladesh_bank_branch')
                ->select('branch_id','branch_name')
                ->where('bank_id',$request->bank_id)
                ->get());

        return $data ;
    }
}
