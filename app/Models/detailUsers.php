<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;

class detailUsers extends Model
{
    //
    protected $user=[
        'email',
        'name',
        'img',
        'birthday'

    ];

    
}
