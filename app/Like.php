<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /*
     * 获取此点赞类型
     */
    public function liketable()
    {
        return $this->morphTo();
    }
}
