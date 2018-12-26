<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /*
     * 获取点赞数据
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'liketable');
    }

    /*
     * 获取标签
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
