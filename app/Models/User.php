<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'poblacion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ads() {
        return $this->hasMany('App\Models\Ad');
    }

    public function hasRoles($roleNames):bool {
        if(!is_array($roleNames))
            $roleNames = [$roleNames];
        foreach($this->roles as $role) {
            if(in_array($role->role, $roleNames))
                return true;
        }
        return false;
    }

    public function isOwner(Ad $ad):bool {
        return $this->id == $ad->user_id;
    }

    public function roles() {
        return $this->belongsToMany('App\Models\Role');
    }

    public function remainingRoles() {
        $actualRoles = $this->roles;
        $allRoles = Role::all();
        return $allRoles->diff($actualRoles);
    }
}
