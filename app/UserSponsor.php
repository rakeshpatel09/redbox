<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class UserSponsor extends Model
{
    //

    protected $table = 'user_sponsor';
    protected $fillable = ['user_id','sponsor_id'];

    /*function getUsers() {
    	return $this->hasMany('App\User', 'users_id','users_id');
    }*/

    public function user()
    {
        return $this->hasOne(User::class , 'users_id' , 'user_id');
    }
}
