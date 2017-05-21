<?php

namespace App;

use App\Models\UserProfile;
use Carbon\Carbon;
use Carbon\diffInDays;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->belongsTo(UserProfile::class, 'id', 'user_id' );
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function hasAccess()
    {
        if (!$this->isAdmin() )
        {
            if ($this->profile != null)
            {
                $profile = $this->profile;
                $end_plan = $profile->end_plan;
                $now = Carbon::now();

                return $now <= $end_plan;
            }
            return false;                
        }   
        return true;
    }
}
