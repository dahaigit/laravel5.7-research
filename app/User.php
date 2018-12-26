<?php

namespace App;

use App\Scopes\AgeScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public $rate_limit = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $casts = [
        'is_admin' => "boolean",
        'created_at' => "datetime:Y-m-d",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
     * 模型的启动方法
     */
    protected static function boot() {
        parent::boot();
    }

    public function getRealNameAttribute($value)
    {
        return 'wahaha';
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }

    /*
     * 用户接收广播的通道
     */
    public function receivesBroadcastNotifictionsOn()
    {
        return 'users.' . $this->id;
    }

    /*
     * 获取角色
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
