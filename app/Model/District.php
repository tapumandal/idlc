<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Divisions;

class District extends Model
{
    protected $table = "tbl_bangladesh_districts";
    protected $primaryKey = "district_id";
}
