<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;


class Group extends Model
{
    //
    protected $group=[
        'name',
        'limitMember',
        'passwordGroup'
    ];
  
}
