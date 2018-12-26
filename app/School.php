<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /*
     * 远程一对多获取数据
     */
    public function articles()
    {
        return $this->hasManyThrough(Article::class, User::class , 'school_id', 'user_id', 'id', 'id');
    }
}
