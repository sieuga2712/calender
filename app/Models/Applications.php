<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;

class Applications extends Model
{
    //
    protected $application=[
        'idgroup',
        'email'
    ];
   
}
