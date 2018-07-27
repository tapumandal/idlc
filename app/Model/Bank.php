<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Branch;

class Bank extends Model
{
    protected $table = "tbl_bangladesh_bank";
    protected $primaryKey = "bank_id";    

	protected $fillable = [
	'user_id','bank_name', 'is_active', 'last_action'
    ];
}
