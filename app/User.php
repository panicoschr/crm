<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    
    //the default type (type field) is for any user, the admin is for the admin
    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'entity', 'username', 'phone', 'url', 'logo', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
 
    public function isAdmin()    {        
    return $this->type === self::ADMIN_TYPE;    
}
 

public function children(){
  return $this->hasMany( 'App\User', 'company_id', 'id' );
}

public function parent(){
  return $this->hasOne( 'App\User', 'id', 'company_id' );
}

}
