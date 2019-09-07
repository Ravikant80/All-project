<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Searchable;

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

    //  public function searchableAs()
    // {
    //     return 'users_index';
    // }



  //       public function orders(){
  //       return $this->hasMany(Order::class);
  //   }

  //       public function account()
  //   {
  //       return $this->hasOne('App\Account');
  //       return $this->hasOne('App\Account', 'foreign_key');
  //   }

  // /**
  //    * Set the user's name.
  //    *
  //    * @param  string  $value
  //    * @return void
  //    */
  //   public function setNameAttribute($value)
  //   {
  //       return $this->attributes['name'] = ucfirst($value);
  //   }
    
  //   /**
  //    * Set the password
  //    * 
  //    * @param string $value
  //    * @return void
  //    */
  //   public function setPasswordAttribute($value)
  //   {
  //       return $this->attributes['password'] = Hash::make($value);
  //   }



}
