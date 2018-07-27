<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Bank;

class Branch extends Model
{
    protected $table = "tbl_bangladesh_bank_branch";
    protected $primaryKey = "branch_id";    

	protected $fillable = [
	'user_id','bank_id','branch_name', 'is_active', 'last_action'
    ];
}
