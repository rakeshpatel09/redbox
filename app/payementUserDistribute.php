<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payementUserDistribute extends Model
{
    //
    protected $table = 'payment_user_distributed';
    protected $fillable = ['sender_user_id','receiver_user_id','payment_amount'];
}
