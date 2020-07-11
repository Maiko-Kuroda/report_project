<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    

    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(10);
    }


}
