<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public static $rules = array(
        'content' => 'required',
        );


    public function getComments(Int $report_id)
    {
        return $this->with('user')->where('report_id', $report_id)->get();
    }

    public function commentStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->report_id = $data['report_id'];
        $this->content = $data['content'];
        $this->save();

        return;
    }

    //以下、likeテーブルと同じ
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function report()
    {
        return $this->belongsTo('App\Report');
    }

}
