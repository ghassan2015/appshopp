<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    /*protected $appends = [
        'profile_photo_url',
    ];*/


    public function getUserAvatar(){
        if($this->avatar==null)
            return url('images/default/logo.png');
        else
            return url('assets/images/users/'.$this->avatar);
    }

    public function scopeWithoutTimestamps()
    {
        $this->timestamps = false;
        return $this;
    }

    public function has_access_to($action , $item){
        /*
        create
        read
        update
        delete
        */

        if(!($item   instanceof \Illuminate\Database\Eloquent\Model )) return 0;

        if(auth()->user()->power == "ADMIN"){
            return 1 ;
        }elseif(auth()->user()->power == "EDITOR"){

            if($item->getTable()=="users")
                return 0;
            if($item->getTable()=="contacts")
                return 0;
            return 1;

        }elseif(auth()->user()->power == "CONTRIBUTOR"){

           if($item->getTable()=="users")
                return 0;
           if($item->user_id == auth()->user()->id)
                return 1;
           else
                return 0;
        }

    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasAbility($permissions)    //products  //mahoud -> admin can't see brands
    {
        $role = $this->role;

        if (!$role) {
            return false;
        }

        foreach ($role->permissions as $permission) {
            if (is_array($permissions) && in_array($permission, $permissions)) {
                return true;
            } else if (is_string($permissions) && strcmp($permissions, $permission) == 0) {
                return true;
            }
        }
        return false;
    }

    public function skill(){
     return $this->belongsToMany(Skill::class,'user_skills');
    }

    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();

    }

    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];

    }
}
