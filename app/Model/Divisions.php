<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\District;

class Divisions extends Model
{
    protected $table = "tbl_bangladesh_divisions";
    protected $primaryKey = "division_id";    

	protected $fillable = [
	'user_id','division_name', 'is_active', 'last_action'
    ];
}
