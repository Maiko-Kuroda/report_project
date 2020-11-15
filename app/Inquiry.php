<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    //
    public static $rules = array(
        'inquiry' => 'required',
        'user_id' => 'required',
        );
    
        //これでレポートを引っ張るときにユーザーIDと一致するものを
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}


