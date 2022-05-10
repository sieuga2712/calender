<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;

class memberGroup extends Model
{
    //
    protected $member=[
        'email',
        'idGroup',
        'level'
    ];
  
}
