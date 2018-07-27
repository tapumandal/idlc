<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $table = "tbl_nationalitys";
    protected $primaryKey = "id_nationality";    

	protected $fillable = [
	'user_id','nationality', 'is_active', 'last_action'
    ];
}
