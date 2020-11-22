<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function getComments(Int $report_id)
    {
        return $this->with('user')->where('report_id', $report_id)->get();
    }
}
