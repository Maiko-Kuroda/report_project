<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    public function getLikes(Int $report_id)
    {
        return $this->with('user')->where('report_id', $report_id)->get();
    }

    public function likeStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->report_id = $data['report_id'];
        $this->save();

        return;
    }

    //以下、コメントテーブルと同じ
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function report()
    {
        return $this->belongsTo('App\Report');
    }

}
