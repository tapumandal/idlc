<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PremiseOwnership extends Model
{
    protected $table = "tbl_premise_ownership";
    protected $primaryKey = "id_premise_ownership";    

	protected $fillable = [
	'user_id','premise_ownership', 'is_active', 'last_action'
    ];
}
