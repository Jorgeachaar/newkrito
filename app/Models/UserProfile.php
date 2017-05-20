<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
    	'user_id',
    	'start_plan', 
    	'end_plan', 
    	'plan',
    ];
}
