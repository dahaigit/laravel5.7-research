@component('mail::message')
# 内容

小破孩

@component('mail::panel')
    重点内容
@endcomponent

@component('mail::table')
    | 时间            | 收入           | 说明       |
    | -------------   |:-------------:| --------: |
    | 2018-10-10      | 1.50          | 正常行情   |
    | 2018-10-11      | 3.5           | 行情不错   |
@endcomponent

@component('mail::button', ['url' => 'http://www.baidu.com', 'color' => 'success'])
百度
@endcomponent

谢谢,<br>
{{ config('app.name') }}
@endcomponent
