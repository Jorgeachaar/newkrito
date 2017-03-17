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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function profile()
    {
        return $this->belongsTo(UserProfile::class, 'id', 'user_id' );
    }

    public function hasAccess()
    {
        // return false;
        if (!$this->isAdmin() )
        {
            if ($this->profile != null)
            {
                $profile = $this->profile;
                $IsActived = $profile->actived;
                $due_date = new Carbon($profile->FchVencimiento);
                $now = Carbon::now();
                $difference = $now->diffInDays($due_date, false);
                return  $difference >= 0;

                // $created = new Carbon($price->created_at);
                // $now = Carbon::now();
                // $difference = ($created->diff($now)->days < 1)
                //     ? 'today'
                //     : $created->diffForHumans($now);

                // $profileAccessFull = $IsActived && $difference >= 0;

                // if ($profileAccessFull)
                // {
                //     return true;
                // }
            }
            return false;                
        }   
        return true;
    }
}
