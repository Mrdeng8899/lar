<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;
    protected $dates=['deleted_at'];
}
