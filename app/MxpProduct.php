<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MxpProduct extends Model {

	protected $table = 'mxp_product';
	protected $fillable = ['name', 'packing_id', 'product_group_id', 'company_id', 'com_group_id', 'user_id', 'is_active', 'is_deleted', 'group_id', 'comb_id'];
}
