<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

//Broadcast::channel('project', function() {
//   return true;
//});

Broadcast::channel('chat.{roomId}', function($user, $roomId){
//    if ($user->id == 1) {
        return ['id' => $user->id, 'name' => $user->name];
//    }
});

Broadcast::channel('priv-channel.{orderId}', function($user, $orderId) {
    return true;
});

Broadcast::channel('safe.{schoolId}', function($user, $schoolId) {
    // 判断用户用户是否在这个频道，防止有人手动监听这个频道
    $data = [
        1 => [1,2],
        2 => [3,4],
    ];
    if (in_array($schoolId, $data[$user->id])) {
        \Log::info('欢迎来到安防频道:' . $schoolId . '用户：' . $user->id . '成功');
        return true;
    } else {
        \Log::info('欢迎来到安防频道:' . $schoolId . '用户：' . $user->id . '失败');
    }
});
