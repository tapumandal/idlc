<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IFARegistration extends Model
{
    //
    protected $table = "tbl_ifa_registrations";

    protected $primaryKey = 'application_no';

    protected $timestamp = FALSE;
}
